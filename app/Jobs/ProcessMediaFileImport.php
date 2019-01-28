<?php

namespace App\Jobs;

use App\ACME\Helpers\CheckRemoteFileHelper;
use App\Models\Category;
use App\Models\Collection;
use App\Models\Import;
use App\Models\ImportRecord;
use App\Models\Media;
use App\Models\MediaTranslation;
use App\Services\ImportService;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class ProcessMediaFileImport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var
     */
    private $import;
    
    /**
     * Create a new job instance.
     *
     * @param $import
     */
    public function __construct($import)
    {
        $this->import = $import;
    }
    
    private static function createOrGetCollection($record, $category)
    {
        App::setLocale('en');
        
        $collection = Collection::whereTranslation('title', trim($record->en_collection), 'en')
            ->get();
        
        if ($collection->count() <= 0) {
            $collection = new Collection();
            
            $collection->translateOrNew('en')->title       = $record->en_collection;
            $collection->translateOrNew('fr')->title       = $record->fr_collection;
            $collection->translateOrNew('en')->description = $record->en_collection;
            $collection->translateOrNew('fr')->description = $record->fr_collection;
            $collection->translateOrNew('en')->time_period = $record->en_date;
            $collection->translateOrNew('fr')->time_period = $record->fr_date;
            
            $collection->category_id = $category;
            $collection->slug        = $record->en_collection;
            $collection->artist      = $record->artist;
            $collection->points      = 100;
            $collection->time_period = $record->en_date;
            $collection->save();
            
            // Add first image
            $collection->addMediaFromUrl($record->image_url)
                ->toMediaCollection('collection');
            
        } else {
            $collection = Collection::find($collection[0]->id);
        }
        
        return $collection;
    }
    
    private static function createOrGetCategory($record): int
    {
        App::setLocale('en');
        
        $category = Category::whereTranslation('name', trim($record->en_department), 'en')
            ->get();
        
        if ($category->count() <= 0) {
            // Create category
            $category = new Category();
            
            $category->translateOrNew('en')->name        = $record->en_department;
            $category->translateOrNew('fr')->name        = $record->fr_department;
            $category->translateOrNew('en')->description = $record->en_department;
            $category->translateOrNew('fr')->description = $record->fr_department;
            
            $category->slug      = str_slug($record->en_department);
            $category->is_public = 0;
            $category->parent_id = 0;
            
            $category->save();
            $categoryId = $category->id;
        } else {
            $categoryId = $category[0]->id;
        }
        
        return $categoryId;
    }
    
    /**
     * Determine if media exists
     *
     * @param $media
     * @return bool
     */
    public function mediaExist($media): bool
    {
        $media = Media::where('collection_name', str_slug($media->en_collection))
            ->whereHas('translations', function ($query) use ($media) {
                $query->where('title', $media->en_complete_title)
                    ->where('title_short', $media->en_title)->where('location', $media->en_location);
            })
            ->first();
        
        if (!$media) {
            return false;
        }
        
        return true;
    }
    
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $import      = Import::where('id', $this->import->id)->first();
        $failedCount = $import->failed_count;
        $totalRows   = $import->total_rows;
        
        foreach (ImportRecord::where('import_id', $import->id)
            ->where('imported', 0)->cursor() as $record) {
            
            $totalRows = $totalRows + 1;
            
            if (!$this->mediaExist($record)) {
                // Search if image already exists and image is valid
                if (CheckRemoteFileHelper::checkRemoteFile($record->image_url)) {
                    
                    // Check or create category
                    $categoryId = self::createOrGetCategory($record);
                    $collection = self::createOrGetCollection($record, $categoryId);
                    
                    // Add media if remote image file exists
                    try {
                        $media                                    = $collection->addMediaFromUrl($record->image_url)
                            ->toMediaCollection($collection->slug);
                        $media->category_id                       = $categoryId;
                        $media->user_id                           = 1;
                        $media->museum                            = $record->museum;
                        $media->translateOrNew('en')->title_short = $record->en_title;
                        $media->translateOrNew('fr')->title_short = $record->fr_title;
                        $media->translateOrNew('en')->title       = $record->en_complete_title;
                        $media->translateOrNew('fr')->title       = $record->fr_complete_title;
                        $media->translateOrNew('en')->location    = $record->en_location;
                        $media->translateOrNew('fr')->location    = $record->fr_location;
                        $media->translateOrNew('en')->medium      = $record->en_art_medium;
                        $media->translateOrNew('fr')->medium      = $record->fr_art_medium;
                        $media->translateOrNew('en')->description = $record->credit_line;
                        $media->translateOrNew('fr')->description = $record->credit_line;
                        $media->translateOrNew('en')->time_period = $record->en_date;
                        $media->translateOrNew('fr')->time_period = $record->fr_date;
                        $media->artist                            = $record->artist;
                        $media->score                             = 0;
                        $media->url                               = $record->url;
                        $media->visible                           = 0;
                        $media->save();
                        
                        // update record
                        $record->imported = 1;
                        
                    } catch (\Exception $e) {
                        // Save the record
                        $record->imported     = 2;
                        $record->import_error = $e;
                        
                        // Save import failed count
                        $failedCount = $failedCount + 1;
                    }
                    
                } else {
                    // error occurred
                    $record->imported     = 2;
                    $record->import_error = 'INVALID_IMAGE_URL_DETECTED';
                    
                    // Save import failed count
                    $failedCount = $failedCount + 1;
                    
                    Log::error('IMPORT_ERROR_NO_IMAGE ' . json_encode($record));
                }
                
            } else {
                // image already exists, set to imported
                $record->imported     = 2;
                $record->import_error = 'DUPLICATE_RECORD_DETECTED';
                $failedCount          = $failedCount + 1;
            }
            
            $record->save();
            
        }
        
        $import->failed_count = $failedCount;
        $import->total_rows   = $totalRows;
        $import->status       = 2; // completed
        $import->save();
    }
}
