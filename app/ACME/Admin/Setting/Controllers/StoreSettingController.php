<?php

namespace App\ACME\Admin\Setting\Controllers;

use App\ACME\Admin\Setting\Requests\StoreSettingRequest;
use App\ACME\Admin\Tag\Requests\StoreTagRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Tags\Tag;

class StoreSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function run(StoreSettingRequest $request)
    {
        $setting                = new Setting();
        $setting->setting_name  = $request->name;
        $setting->setting_value = $request->value;
        $setting->save();
        
        return redirect()
            ->back()
            ->with('success', 'Request successfully processed!');
    }
}
