<?php

namespace App\ACME\Admin\Import\Controllers;

use App\ACME\Admin\Import\Requests\ImportFileRequest;
use App\Models\Import;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class IndexImportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function run()
    {
        $imports = Import::paginate();
        
        return view('admin.import.index', compact('imports'));
    }
}
