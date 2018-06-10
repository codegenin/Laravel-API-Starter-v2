<?php

namespace App\ACME\Api\V1\Media\Resource;

use Illuminate\Http\Resources\Json\ResourceCollection;

class MediaResourceCollection extends ResourceCollection
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
