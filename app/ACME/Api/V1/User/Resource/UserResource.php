<?php

namespace App\ACME\Api\V1\User\Resource;

use App\Traits\MediaTraits;
use Illuminate\Http\Resources\Json\JsonResource;
use Vinkla\Hashids\Facades\Hashids;

class UserResource extends JsonResource
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
            'id'            => Hashids::encode($this->id),
            'name'          => $this->name ?: '',
            'email'         => $this->email ?: '',
            'role'          => $this->role ?: '',
            'contact_email' => isset($this->details['contact_email']) ? $this->details['contact_email'] : '',
            'about'         => isset($this->details['about']) ? $this->details['about'] : '',
            'birthday'      => isset($this->details['birthday']) ? $this->details['birthday'] : '',
            'website'       => isset($this->details['website']) ? $this->details['website'] : '',
            'phone'         => isset($this->details['phone']) ? $this->details['phone'] : '',
            'location'      => isset($this->details['location']) ? $this->details['location'] : '',
            'remarks'       => isset($this->details['remarks']) ? $this->details['remarks'] : '',
            'avatar'        => $this->getMedialUrls($this, 'avatar'),
            'points'        => $this->points
        ];
    }
}
