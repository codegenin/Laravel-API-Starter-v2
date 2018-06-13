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
            'score'    => $this->score,
            'images'   => [
                'original' => $this->getUrl(),
                'large'    => $this->getUrl('large'),
                'medium'   => $this->getUrl('medium'),
                'small'    => $this->getUrl('small'),
            ],
            'created'  => $this->created_at
        
        ];
    }
}
