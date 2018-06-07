<?php

namespace App\ACME\Admin\Category\Controllers;

use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
}
