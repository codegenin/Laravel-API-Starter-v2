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
            'slug'           => isset($this->slug) ? $this->slug : '',
            'en_name'        => isset($this->translate('en')->name) ? $this->translate('en')->name : '',
            'fr_name'        => isset($this->translate('fr')->name) ? $this->translate('fr')->name : '',
            'en_description' => isset($this->translate('en')->description) ? $this->translate('en')->description : '',
            'fr_description' => isset($this->translate('fr')->description) ? $this->translate('fr')->description : '',
            'is_public'      => $this->is_public,
            'covers'         => $this->getMedialUrls($this, 'category'),
        ];
    }
}
