<?php

namespace App\ACME\Admin\Import\Controllers;

use App\ACME\Admin\Import\Requests\ImportFileRequest;
use App\Imports\RecordsImport;
use App\Jobs\ProcessMediaFileImport;
use App\Jobs\ProcessMediaImport;
use App\Models\Import;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ImportFileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    
    public function run(ImportFileRequest $request)
    {
        try {
            
            $import       = new Import();
            $fileName     = $request->file->getClientOriginalName();
            $path         = $request->file('file')
                ->storeAs('imports', $fileName);
            $import->file = $path;
            $import->save();
            
            #$file = Storage::path($import->file);
            
            // let's first count the total number of rows
            /*Excel::load($file, function ($reader) use ($import) {
                $objWorksheet       = $reader->getActiveSheet();
                $import->total_rows = $objWorksheet->getHighestRow() - 1; //exclude the heading
                $import->save();
            });*/
            
            try {
                
                Excel::import(new RecordsImport($import), "imports/{$fileName}");
                $import->status = 1;
                $import->save();
                
                ProcessMediaFileImport::dispatch($import)->delay(1);
                
            } catch (\Exception $e) {
                $import->status = 3;
                $import->error  = $e->getMessage() . ' - ' . $e->getLine() . ' - ' . $e->getFile();
                $import->save();
            }
            
            
        } catch (\Exception $e) {
            throw new \Exception($e);
        }
        
        
        return redirect()
            ->back()
            ->with('success', 'Request successfully processed!');
    }
    
}
