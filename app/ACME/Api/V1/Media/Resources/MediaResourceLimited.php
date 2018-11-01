<?php

namespace App\ACME\Api\V1\Media\Resource;

use App\ACME\Api\V1\Collection\Resource\CollectionLimitedResource;
use App\ACME\Api\V1\User\Resource\UserResource;
use App\ACME\Api\V1\User\Resource\UserResourceLimited;
use App\Traits\MediaTraits;
use Illuminate\Http\Resources\Json\JsonResource;
use Vinkla\Hashids\Facades\Hashids;

class MediaResourceLimited extends JsonResource
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
            'title'             => $this->title_short ?: '',
            'title_long'        => $this->title ?: '',
            'description'       => $this->description ?: '',
            'location'          => $this->location ?: '',
            'medium'            => $this->medium ?: '',
            'museum'            => $this->museum ?: '',
            'museum_url'        => $this->url ?: '',
            'score'             => $this->score ?: '',
            #'user'         => new UserResourceLimited($this->user),
            'images'            => [
                'original' => $this->getUrl(),
                'zoom'     => $this->getUrl('zoom'),
                'cover'    => $this->getUrl('cover'),
                'large'    => $this->getUrl('large'),
                'medium'   => $this->getUrl('medium'),
                'small'    => $this->getUrl('small'),
            ]
        ];
    }
}
