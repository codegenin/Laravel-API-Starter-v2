<?php

namespace App\ACME\Api\V1\Collection\Resource;

use App\ACME\Api\V1\User\Resource\UserResource;
use App\ACME\Api\V1\User\Resource\UserResourceLimited;
use App\ACME\Helpers\StringHelper;
use App\Traits\MediaTraits;
use Carbon\Carbon;
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
            'description'  => isset($this->description) ? StringHelper::cleanString($this->description) : '',
            'time_period'  => isset($this->time_period) ? $this->time_period : '',
            'score'        => isset($this->score) ? $this->score : 0,
            'points'       => isset($this->points) ? $this->points : 0,
            'public'       => ($this->is_public == 1) ? 'Yes' : 'No',
            'artist'       => isset($this->artist) ? $this->artist : '',
            'user'         => $this->whenLoaded('user', new UserResourceLimited($this->user)),
            'image_count'  => $this->getMedia($this->slug)
                                   ->count(),
            /*'is_purchased' => auth()
                ->user()
                ->hasPurchased($this),*/
            'created'      => $this->created_at->diffForHumans(),
            'days_ago'     => ($this->created_at->diffInDays() == 0) ? 1 . ' j' :
                $this->created_at->diffInDays() . ' j',
            'covers'       => $this->getMedialUrls($this, 'collection'),
        ];
    }
}
