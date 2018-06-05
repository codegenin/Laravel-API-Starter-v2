<?php

namespace App\ACME\Api\V1\Category\Resource;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryResourceCollection extends ResourceCollection
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
            'slug'        => $this->slug,
            'name'        => $this->name,
            'description' => $this->description,
            'public'      => ($this->is_public == 1) ? 'Yes' : 'No',
            'cover_image' => $this->image_path
        ];
    }
}
