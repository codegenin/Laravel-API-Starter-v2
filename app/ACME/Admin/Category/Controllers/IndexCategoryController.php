<?php

namespace App\ACME\Admin\Category\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexCategoryController extends Controller
{
    /**
     * @return $this
     */
    public function run()
    {
        $categories    = Category::orderBy('seq', 'desc')
                                 ->paginate();
        $allCategories = Category::orderBy('seq')
                                 ->where('parent_id', 0)
                                 ->get();
        
        return view('admin.category.index')->with([
            'categories'         => $categories,
            'categoriesDropDown' => $allCategories
        ]);
    }
}
