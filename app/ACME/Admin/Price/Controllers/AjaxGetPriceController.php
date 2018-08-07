<?php

namespace App\ACME\Admin\Price\Controllers;

use App\ACME\Admin\Collection\Requests\StoreCollectionRequest;
use App\ACME\Admin\Collection\Resource\AdminCollectionResource;
use App\ACME\Api\V1\Collection\Repositories\CollectionRepository;
use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Models\Price;
use App\Traits\MediaTraits;
use Spatie\Tags\Tag;

class AjaxGetPriceController extends Controller
{
    public function run($id)
    {
        $price = Price::find($id);
        
        return response()->json([
            'status' => true,
            'price'  => [
                'id'        => $price->id,
                'points'    => $price->points,
                'price'     => $price->price,
                'google_id' => $price->google_id
            ]
        ]);
    }
}
