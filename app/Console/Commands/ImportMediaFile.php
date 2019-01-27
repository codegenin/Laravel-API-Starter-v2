<?php

namespace App\Console\Commands;

use App\Jobs\ProcessMediaImport;
use App\Models\Category;
use App\Models\Import;
use App\Models\ImportRecord;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
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
        exit();
        $import = Import::where('status', 0)
            ->first();
        
        if (!empty($import)) {
            
            
            $file = Storage::path($import->file);
            
            Excel::filter('chunk')
                ->load($file)
                ->chunk(10, function ($rows) use ($import) {
                    
                    $imported = $import->imported_count;
                    
                    try {
                        
                        foreach ($rows as $row) {
    
                            $record = new ImportRecord();
                            
                            if (!empty($row->departement_version_anglaise) AND
                                !empty($row->nom_collection_version_anglaise)) {
                                
                                $record->import_id         = $import->id;
                                $record->fr_title          = trim($row->titre_de_loeuvre_version_francaise);
                                $record->en_title          = trim($row->titre_de_loeuvre_version_anglaise);
                                $record->fr_complete_title = trim($row->titre_complet_de_loeuvreversion_francaise);
                                $record->en_complete_title = trim($row->titre_complet_de_loeuvreversion_anglaise);
                                $record->artist            = trim($row->artiste);
                                $record->fr_date           = trim($row->date_version_francaise);
                                $record->en_date           = trim($row->date_version_anglaise);
                                $record->fr_location       = trim($row->lieuversion_francaise);
                                $record->en_location       = trim($row->lieuversion_anglaise);
                                $record->fr_collection     = trim($row->nom_collection_version_francaise);
                                $record->en_collection     = trim($row->nom_collection_version_anglaise);
                                $record->fr_art_medium     = trim($row->mediumversion_francaise);
                                $record->en_art_medium     = trim($row->mediumversion_anglaise);
                                $record->credit_line       = trim($row->credit_line);
                                $record->museum            = trim($row->nom_du_musee);
                                $record->url               = trim($row->url);
                                $record->image_url         = trim($row->aws);
                                $record->fr_department     = trim($row->departement_version_francaise);
                                $record->en_department     = trim($row->departement_version_anglaise);
                                $record->save();
                                
                                $imported++;
                                
                                ProcessMediaImport::dispatch($record)->delay(1);
                            } else {
                                $record->imported = 2;
                                $record->save();
                            }
                            
                        }
                        
                    } catch (\Exception $e) {
                        $import->status = 2;
                        $import->error  = $e;
                        $import->save();
                        
                        Log::error('IMPORT_FILE_ERROR ' . json_encode($e->getMessage()));
                        
                        throw  new \Exception($e);
                    }
                }
                );
            
           //$this->updateStatus($import, 2);
            
        }
    }
    
    
    public function updateStatus($import, $status)
    {
        $import->imported_count = $import->total_rows;
        $import->status         = $status;
        $import->save();
        
        return $this;
    }
}
