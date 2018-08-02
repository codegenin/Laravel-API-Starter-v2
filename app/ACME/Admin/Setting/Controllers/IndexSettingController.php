<?php

namespace App\ACME\Admin\Setting\Controllers;

use App\Models\Setting;
use App\Http\Controllers\Controller;

class IndexSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function run()
    {
        $settings = Setting::paginate();
        
        return view('admin.setting.index', compact('settings'));
    }
}
