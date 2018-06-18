<?php

namespace App\ACME\Admin\Tag\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Tags\Tag;

class AjaxForOptionTagsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function run()
    {
        $tags = Tag::ordered()->get();
        
        $data = [];
    }
}
