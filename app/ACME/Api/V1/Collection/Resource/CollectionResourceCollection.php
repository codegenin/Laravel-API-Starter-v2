<?php

namespace App\ACME\Api\V1\Collection\Resource;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CollectionResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return ['data' => $this->collection];
    }
    
    public function with($request)
    {
        return [
            'status' => 'ok'
        ];
    }
}
