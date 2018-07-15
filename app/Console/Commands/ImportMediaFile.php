<?php

namespace App\Console\Commands;

use App\Models\Import;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ImportMediaFile extends Command
{
    protected $chunkSize   = 50;
    
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
                      ->first();
        
        if($import) {
    
            $file = Storage::path($import->file);
    
            // let's first count the total number of rows
            Excel::load($file, function ($reader) use ($import) {
                $objWorksheet     = $reader->getActiveSheet();
                $import->total_rows = $objWorksheet->getHighestRow() - 1; //exclude the heading
                $import->save();
            });
            
            Excel::filter('chunk')
                 ->load($file)
                 ->chunk($this->chunkSize, function ($rows) use ($file) {
        
                     $importedCount  = 0;
            
                     
                 }
                 );
            
        }
    }
}
