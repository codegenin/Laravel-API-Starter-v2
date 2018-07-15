<?php

namespace App\ACME\Admin\Import\Controllers;

use App\ACME\Admin\Import\Requests\ImportFileRequest;
use App\Models\Import;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
            $fileName     = Carbon::now()
                                  ->format('Ymd-His');
            $path         = $request->file('file')
                                    ->storeAs('imports/', $fileName);
            $import->file = $path;
            $import->save();
        } catch (\Exception $e) {
            throw new \Exception($e);
        }
        
        
        return redirect()
            ->back()
            ->with('success', 'Request successfully processed!');
    }
    
}
