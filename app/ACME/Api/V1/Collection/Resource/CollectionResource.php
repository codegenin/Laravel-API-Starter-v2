<?php

namespace App\ACME\Api\V1\Collection\Resource;

use App\ACME\Api\V1\User\Resource\UserResource;
use App\ACME\Api\V1\User\Resource\UserResourceLimited;
use App\Traits\MediaTraits;
use Illuminate\Http\Resources\Json\JsonResource;
use Vinkla\Hashids\Facades\Hashids;

class CollectionResource extends JsonResource
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
            'id'           => Hashids::encode($this->id),
            'slug'         => $this->slug,
            'title'        => $this->title,
            'description'  => isset($this->description) ? $this->description : '',
            'time_period'  => isset($this->time_period) ? $this->time_period : '',
            'score'        => isset($this->score) ? $this->score : 0,
            'points'       => isset($this->points) ? $this->points : 0,
            'artist'       => isset($this->artist) ? $this->artist : '',
            'user'         => new UserResourceLimited($this->user),
            'is_purchased' => auth()
                ->user()
                ->hasPurchased($this),
            'covers'       => $this->getMedialUrls($this, 'collection'),
        ];
    }
}
