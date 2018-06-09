<?php

namespace App\ACME\Api\V1\User\Resource;

use Illuminate\Http\Resources\Json\JsonResource;
use Vinkla\Hashids\Facades\Hashids;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'identification' => Hashids::encode($this->id),
            'complete_name'  => $this->name,
            'email_address'  => $this->email,
            'role'           => $this->role,
            'about'          => $this->about,
            'birthday'       => $this->birthday,
            'website'        => $this->website,
            'location'       => $this->location
        ];
    }
}
