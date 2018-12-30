<?php

namespace App\ACME\Api\V1\Media\Resource;

use App\ACME\Api\V1\Collection\Resource\CollectionLimitedResource;
use App\ACME\Api\V1\User\Resource\UserResource;
use App\ACME\Api\V1\User\Resource\UserResourceLimited;
use App\ACME\Helpers\StringHelper;
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
            'id'                => Hashids::encode($this->id),
            'title'             => $this->title_short ?: '',
            'title_long'        => $this->title ?: '',
            'description'       => StringHelper::cleanString($this->description) ?: '',
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
            ],
            'belongs_to'        => ($this->model_type == "App\\Models\\Category") ? 'category' : 'collection',
            'collection'        => ($this->model_type == "App\\Models\\Collection") ?
                $this->whenLoaded('collection', new CollectionLimitedResource($this->collection)) : [],
            /*'is_purchased'      => (!empty($this->collection)) ?
                $this->whenLoaded('collection', auth()->user()->isPurchased($this->collection)) : false,
            'is_book'           => auth()->user()->isBooked($this),*/
            'created'           => $this->created_at->diffForHumans(),
            'updated'           => $this->updated_at->diffForHumans(),
            'created_timestamp' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_timestamp' => $this->updated_at->format('Y-m-d H:i:s')
        ];
    }
}
