<?php

namespace App\ACME\Web\Misc\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TermsOfUseController extends Controller
{
    public function show()
    {
        return view('web.misc.terms_of_use');
    }
}
