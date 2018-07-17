<?php

namespace App\ACME\Api\V1\Media\Resource;

use App\ACME\Api\V1\Collection\Resource\CollectionLimitedResource;
use App\ACME\Api\V1\User\Resource\UserResource;
use App\ACME\Api\V1\User\Resource\UserResourceLimited;
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
            'id'           => Hashids::encode($this->id),
            'title'        => $this->title ?: '',
            'description'  => $this->description ?: '',
            'location'     => $this->location ?: '',
            'medium'       => $this->medium ?: '',
            'score'        => $this->score ?: '',
            #'user'         => new UserResourceLimited($this->user),
            'images'       => [
                'original' => $this->getUrl(),
                'large'    => $this->getUrl('large'),
                'medium'   => $this->getUrl('medium'),
                'small'    => $this->getUrl('small'),
            ],
            'belongs_to'   => ($this->model_type == "App\\Models\\Category") ? 'category' : 'collection',
            'collection'   => ($this->model_type == "App\\Models\\Collection") ?
                new CollectionLimitedResource($this->collection) : [],
            'is_purchased' => ($this->model_type == "App\\Models\\Collection") ? auth()
                ->user()
                ->hasPurchased($this->collection) : false,
            'is_book'      => auth()
                ->user()
                ->isBooked($this),
            'created'      => $this->created_at->diffForHumans(),
            'updated'      => $this->updated_at
        ];
    }
}
