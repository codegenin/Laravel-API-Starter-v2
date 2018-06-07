<?php

namespace App\ACME\Admin\Category\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;

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
    
    public function index()
    {
        $categories = Category::orderBy('seq')->renderAsArray();
        
        return view('admin.category.index')->with([
            'categories' => $categories
        ]);
    }
}
