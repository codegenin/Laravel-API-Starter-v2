<?php

namespace App\ACME\Admin\Import\Controllers;

use App\Models\ImportRecord;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FailedImportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function __invoke()
    {
        $imports = ImportRecord::where([
            'import_id' => request('id'),
            ['imported', '=', 2]
        ])->paginate();
    
        return view('admin.import.records.records', compact('imports'));
    }
}
