<?php

namespace App\ACME\Api\V1\Media\Resource;

use App\Traits\MediaTraits;
use Illuminate\Http\Resources\Json\JsonResource;
use Vinkla\Hashids\Facades\Hashids;

class MediaResource extends JsonResource
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
            'id'       => Hashids::encode($this->id),
            'title'    => $this->title,
            'location' => $this->location,
            'during'   => $this->during,
            'images'   => $this->getMedialUrls($this, $this->collection_name),
            'created'  => $this->created_at
        
        ];
    }
}
