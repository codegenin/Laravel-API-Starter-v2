<?php

namespace App\ACME\Web\Misc\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PrivacyPolicyController extends Controller
{
    public function show()
    {
        return view('web.misc.privacy_policy');
    }
}
