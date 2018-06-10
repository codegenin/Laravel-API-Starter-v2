<?php

namespace App\ACME\Api\V1\Category\Resource;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryResourceCollection extends ResourceCollection
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
