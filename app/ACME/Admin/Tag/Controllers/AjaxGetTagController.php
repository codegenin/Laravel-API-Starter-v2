<?php

namespace App\ACME\Admin\Tag\Controllers;

use App\ACME\Admin\Collection\Requests\StoreCollectionRequest;
use App\ACME\Admin\Collection\Resource\AdminCollectionResource;
use App\ACME\Api\V1\Collection\Repositories\CollectionRepository;
use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Traits\MediaTraits;
use Spatie\Tags\Tag;

class AjaxGetTagController extends Controller
{
    public function run($id)
    {
        $tag = Tag::find($id);
        
        return response()->json([
            'status' => true,
            'tag'    => [
                'id'      => $tag->id,
                'en_name' => $tag->getTranslation('name', 'en'),
                'fr_name' => $tag->getTranslation('name', 'fr'),
            ]
        ]);
    }
}
