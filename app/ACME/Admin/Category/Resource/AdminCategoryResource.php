<?php

namespace App\ACME\Admin\Category\Resource;

use App\ACME\Api\V1\Collection\Resource\CollectionResource;
use App\Traits\MediaTraits;
use Illuminate\Http\Resources\Json\JsonResource;
use Vinkla\Hashids\Facades\Hashids;

class AdminCategoryResource extends JsonResource
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
            'id'             => $this->id,
            'parent_id'      => $this->parent_id,
            'slug'           => $this->slug ?: '',
            'en_name'        => $this->translate('en')->name ?: '',
            'fr_name'        => $this->translate('fr')->name ?: '',
            'en_description' => $this->translate('en')->description ?: '',
            'fr_description' => $this->translate('fr')->description ?: '',
            'is_public'      => $this->is_public,
            'covers'         => $this->getMedialUrls($this, 'category'),
        ];
    }
}
