<?php

namespace App\ACME\Admin\Category\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;

class MoveCategoryController extends Controller
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
    
    /**
     * Move record up
     *
     * @param Category $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function up($id)
    {
        Category::find($id)
                ->up();
        
        return redirect()->route('admin.category.index');
    }
    
    /**
     * @param Category $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function down($id)
    {
        Category::find($id)
                ->down();
    
        return redirect()->route('admin.category.index');
    }
}
