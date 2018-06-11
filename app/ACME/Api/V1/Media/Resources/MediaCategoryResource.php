<?php

namespace App\ACME\Api\V1\Media\Resource;

use App\Models\Category;
use App\Traits\MediaTraits;
use Illuminate\Http\Resources\Json\JsonResource;
use Vinkla\Hashids\Facades\Hashids;

class MediaCategoryResource extends JsonResource
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
            'id'       => Hashids::encode($this->id),
            'title'    => $this->title,
            'location' => $this->location,
            'year'     => $this->year,
            'images'   => $this->getMedialUrls(Category::find($this->model_id), $this->collection_name),
            'created'  => $this->created_at
        
        ];
    }
}
