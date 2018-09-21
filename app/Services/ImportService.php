<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Collection;
use Illuminate\Support\Facades\App;
use Mockery\Exception;

class ImportService
{
    public static function processImportedRecord($record)
    {
        try {
            // Check or create category
            $categoryId = self::createOrGetCategory($record);
            $collection = self::createOrGetCollection($record, $categoryId);
            
            // Add media
            $media                                    = $collection->addMediaFromUrl($record->image_url)
                                                                   ->toMediaCollection($collection->slug);
            $media->category_id                       = $categoryId;
            $media->user_id                           = 1;
            $media->museum                            = $record->museum;
            $media->translateOrNew('en')->title       = $record->en_complete_title;
            $media->translateOrNew('fr')->title       = $record->fr_complete_title;
            $media->translateOrNew('en')->location    = $record->en_location;
            $media->translateOrNew('fr')->location    = $record->fr_location;
            $media->translateOrNew('en')->medium      = $record->en_art_medium;
            $media->translateOrNew('fr')->medium      = $record->fr_art_medium;
            $media->translateOrNew('en')->description = $record->credit_line;
            $media->translateOrNew('fr')->description = $record->credit_line;
            $media->score                             = 0;
            $media->url                               = $record->url;
            $media->save();
        } catch (\Exception $e) {
            $record->imported     = 2;
            $record->import_error = $e;
            $record->save();
            throw new Exception($e);
        }
        
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
            $collection->translateOrNew('en')->time_period = $record->en_date;
            $collection->translateOrNew('fr')->time_period = $record->fr_date;
            
            $collection->category_id = $category;
            $collection->slug        = $record->en_collection;
            $collection->artist      = $record->artist;
            $collection->points      = 100;
            $collection->time_period = $record->en_date;
            $collection->save();
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
            $category                             = new Category();
            $category->translateOrNew('en')->name = $record->en_department;
            $category->translateOrNew('fr')->name = $record->fr_department;
            $category->slug                       = str_slug($record->en_department);
            $category->is_public                  = 0;
            $category->parent_id                  = 0;
            $category->save();
            $categoryId = $category->id;
        } else {
            $categoryId = $category[0]->id;
        }
        
        return $categoryId;
    }
    
}