<?php

namespace App\ACME\Admin\Setting\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Spatie\Tags\Tag;

class AjaxGetSettingController extends Controller
{
    public function run($id)
    {
        $setting = Setting::find($id);
        
        return response()->json([
            'status'  => true,
            'setting' => [
                'id'            => $setting->id,
                'setting_name'  => $setting->setting_name,
                'setting_value' => $setting->setting_value,
            ]
        ]);
    }
}
