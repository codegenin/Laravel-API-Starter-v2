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
            'id'          => Hashids::encode($this->id),
            'slug'        => $this->slug,
            'title'       => $this->title,
            'description' => $this->description,
            'years'        => $this->year_start . '-' . $this->year_end,
            'score'       => $this->score,
            'user'        => new UserResourceLimited($this->user),
            'covers'      => $this->getMedialUrls($this, $this->slug),
        ];
    }
}
