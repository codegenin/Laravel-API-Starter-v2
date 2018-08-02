<?php

namespace App\ACME\Admin\Setting\Controllers;

use App\ACME\Admin\Setting\Requests\DeleteSettingRequest;
use App\Http\Controllers\Controller;
use App\Models\Setting;

class DestroySettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function run(DeleteSettingRequest $request)
    {
        $setting = Setting::find($request->id);
        $setting->delete();
        
        return redirect()
            ->back()
            ->with('success', 'Request successfully processed!');
    }
}
