<?php

namespace App\ACME\Api\V1\Collection\Resource;

use App\ACME\Api\V1\User\Resource\UserResource;
use App\ACME\Api\V1\User\Resource\UserResourceLimited;
use App\Traits\MediaTraits;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Vinkla\Hashids\Facades\Hashids;

class CollectionLimitedResource extends JsonResource
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
            'id'        => Hashids::encode($this->id),
            'title'     => $this->title,
            'time_period' => $this->time_period
        ];
    }
}
