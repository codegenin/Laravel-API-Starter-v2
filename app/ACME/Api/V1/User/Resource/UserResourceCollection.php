<?php

namespace App\ACME\Api\V1\User\Resource;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'complete_name' => $this->name,
            'email_address' => $this->email,
            'group'         => $this->role,
            'active'        => $this->is_active
        ];
    }
}
