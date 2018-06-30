<?php

namespace App\ACME\Admin\Tag\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Tags\Tag;

class IndexTagController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function run()
    {
        $tags = Tag::ordered()
                   ->get();
        
        return view('admin.tag.index', compact('tags'));
    }
}
