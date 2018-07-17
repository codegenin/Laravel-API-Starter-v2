<?php

namespace App\ACME\Api\V1\Category\Resource;

use App\ACME\Api\V1\Collection\Resource\CollectionResource;
use App\Traits\MediaTraits;
use Illuminate\Http\Resources\Json\JsonResource;
use Vinkla\Hashids\Facades\Hashids;

class CategoryLimitedResource extends JsonResource
{
    use MediaTraits;
    
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'          => $this->id,
           /* 'slug'        => $this->slug ?: '',
            'name'        => $this->name ?: '',
            'description' => $this->description ?: '',
            'public'      => ($this->is_public == 1) ? 'Yes' : 'No',
            'covers'      => $this->getMedialUrls($this, 'category'),
            #'collections' => CollectionResource::collection($this->whenLoaded('collections'))*/
        ];
    }
}
