<?php

namespace App\ACME\Api\V1\Category\Resource;

use Illuminate\Http\Resources\Json\JsonResource;
use Vinkla\Hashids\Facades\Hashids;

class CategoryResource extends JsonResource
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
            'status'      => 'ok',
            'slug'        => $this->slug,
            'name'        => $this->name,
            'description' => $this->description,
            'public'      => ($this->is_public == 1) ? 'Yes' : 'No',
            'cover_image' => $this->image_path
        ];
    }
}
