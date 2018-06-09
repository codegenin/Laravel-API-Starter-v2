<?php

namespace App\ACME\Api\V1\Collection\Resource;

use Illuminate\Http\Resources\Json\JsonResource;
use Vinkla\Hashids\Facades\Hashids;

class CollectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'slug'        => $this->slug,
            'title'       => $this->title,
            'description' => $this->description,
            'cover'      => $this->getMedia($this->slug)->first()->getUrl('large')
        ];
    }
}
