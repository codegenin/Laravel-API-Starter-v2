<?php

namespace App\ACME\Api\V1\Media\Resource;

use App\ACME\Api\V1\Collection\Resource\CollectionLimitedResource;
use App\ACME\Api\V1\User\Resource\UserResource;
use App\ACME\Api\V1\User\Resource\UserResourceLimited;
use App\Traits\MediaTraits;
use Illuminate\Http\Resources\Json\JsonResource;
use Vinkla\Hashids\Facades\Hashids;

class MediaRelatedResource extends JsonResource
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
            'id'                => Hashids::encode($this->id),
            'title'             => $this->title ?: '',
            'images'            => [
                'original' => $this->getUrl(),
                'zoom'     => $this->getUrl('zoom'),
                'cover'    => $this->getUrl('cover'),
                'large'    => $this->getUrl('large'),
                'medium'   => $this->getUrl('medium'),
                'small'    => $this->getUrl('small'),
            ],
        ];
    }
}