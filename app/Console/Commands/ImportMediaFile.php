<?php

namespace App\Console\Commands;

use App\Jobs\ProcessMediaImport;
use App\Models\Category;
use App\Models\Import;
use App\Models\ImportRecord;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ImportMediaFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'media:import';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import media from file';
    
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $import = Import::where('status', 0)
                        ->orWhere('status', 1)
                        ->first();
        if ($import) {
            
            $this->updateStatus($import, 1);
            
            $file = Storage::path($import->file);
            
            Excel::filter('chunk')
                 ->load($file)
                 ->chunk(20, function ($rows) use ($import) {
                
                     $importedCount = 0;
                
                     try {
                    
                         foreach ($rows as $row) {
                        
                             $record = new ImportRecord();
                        
                             $record->fr_title          = $row->titre_de_loeuvre_version_francaise;
                             $record->en_title          = $row->titre_de_loeuvre_version_anglaise;
                             $record->fr_complete_title = $row->titre_complet_de_loeuvreversion_francaise;
                             $record->en_complete_title = $row->titre_complet_de_loeuvreversion_anglaise;
                             $record->artist            = $row->artiste;
                             $record->fr_date           = $row->date_version_francaise;
                             $record->en_date           = $row->date_version_anglaise;
                             $record->fr_location       = $row->lieuversion_francaise;
                             $record->en_location       = $row->lieuversion_anglaise;
                             $record->fr_collection     = $row->nom_collection_version_francaise;
                             $record->en_collection     = $row->nom_collection_version_anglaise;
                             $record->fr_art_medium     = $row->mediumversion_francaise;
                             $record->en_art_medium     = $row->mediumversion_anglaise;
                             $record->credit_line       = $row->credit_line;
                             $record->museum            = $row->nom_du_musee;
                             $record->url               = $row->url;
                             $record->image_url         = $row->aws;
                             $record->fr_department     = $row->departement_version_francaise;
                             $record->en_department     = $row->departement_version_anglaise;
                             $record->save();
                        
                             ProcessMediaImport::dispatch($record);
                        
                             $importedCount++;
                         }
                    
                     } catch (\Exception $e) {
                         $import->status = 3;
                         $import->error  = $e;
                         $import->save();
                         throw  new \Exception($e);
                     }
                
                     $import->imported_count = $import->imported_count + $importedCount;
                     $import->save();
                 }
                 );
            
            $this->updateStatus($import, 2);
            
        }
    }
    
    
    public function updateStatus($import, $status)
    {
        $import->status = $status;
        $import->save();
        
        return $this;
    }
}
