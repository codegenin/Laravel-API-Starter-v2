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
            'status' => 'ok',
            'data'   => [
                'identification' => Hashids::encode($this->id),
                'complete_name'  => $this->name,
                'email_address'  => $this->email,
                'group'          => $this->role,
                'active'         => ($this->is_active == 1) ? 'YES' : 'NO'
            ]
        ];
    }
}
