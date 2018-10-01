<?php

namespace App\ACME\Admin\Report\Controllers;

use App\Models\Media;
use App\Models\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexReportController extends Controller
{
    public function run()
    {
        $reports = new Report();
        $reports = $reports->allReported(Media::class);
        
        return view('admin.report.index', compact('reports'));
    }
}
