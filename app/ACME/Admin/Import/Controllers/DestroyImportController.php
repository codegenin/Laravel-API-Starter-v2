<?php

namespace App\ACME\Admin\Import\Controllers;

use App\Models\Import;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class DestroyImportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function run()
    {
        try {
            $import = Import::find(request()->id);
            $import->delete();
            Storage::delete($import->file);
        } catch (\Exception $e) {
            throw new \Exception($e);
        }
    
        return redirect()
            ->back()
            ->with('success', 'Request successfully processed!');
    }
}
