<?php

namespace App\ACME\Admin\Media\Controllers;

use App\ACME\Admin\Media\Requests\DeleteMediaRequest;
use App\ACME\Admin\Media\Resources\MediaResource;
use App\ACME\Admin\Tag\Resource\TagAjaxResource;
use App\ACME\Admin\Tag\Resource\TagAjaxSelectedResource;
use App\ACME\Admin\Tag\Resource\TagResource;
use App\Models\Media;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Psr\Log\InvalidArgumentException;
use Spatie\Tags\Tag;

class AjaxGetImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function run($id)
    {
        try {
            $media = Media::find($id);
        } catch (\Exception $e) {
            throw new InvalidArgumentException($e);
        }
        
        $allTags       = Tag::ordered()
                            ->get();
        $tags          = [];
        $tagCollection = collect($media->tags);
        
        foreach ($allTags as $key => $tag) {
            $tags[$key]['id']       = $tag->id;
            $tags[$key]['text']     = $tag->name;
            $tags[$key]['selected'] = false;
            
            if ($tagCollection->contains('id', $tag->id)) {
                $tags[$key]['selected'] = true;
            }
        }
        
        return response()->json([
            'status' => true,
            'media'  => new MediaResource($media),
            'tags'   => $tags
        ]);
    }
}
