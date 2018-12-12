<?php

namespace App\ACME\Api\V1\Category\Resource;

use App\ACME\Api\V1\Collection\Resource\CollectionResource;
use App\ACME\Helpers\StringHelper;
use App\Traits\MediaTraits;
use Illuminate\Http\Resources\Json\JsonResource;
use Vinkla\Hashids\Facades\Hashids;

class CategoryResource extends JsonResource
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
            'id'          => Hashids::encode($this->id),
            'slug'        => $this->slug ?: '',
            'name'        => $this->name ?: '',
            'description' => StringHelper::cleanString($this->description) ?: '',
            'public'      => ($this->is_public == 1) ? 'Yes' : 'No',
            'covers'      => $this->getMedialUrls($this, 'category'),
            'created'     => $this->created_at->diffForHumans(),
            'updated_at'  => $this->updated_at->format('Y-m-d H:i:s'),
            'days_ago'    => ($this->created_at->diffInDays() == 0) ? 1 . ' j' : $this->created_at->diffInDays() . ' j',
            #'collections' => CollectionResource::collection($this->whenLoaded('collections'))
        ];
    }
}
