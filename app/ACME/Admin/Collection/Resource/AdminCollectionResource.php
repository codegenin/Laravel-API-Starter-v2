<?php

namespace App\ACME\Admin\Collection\Resource;

use App\ACME\Api\V1\Collection\Resource\CollectionResource;
use App\Traits\MediaTraits;
use Illuminate\Http\Resources\Json\JsonResource;
use Vinkla\Hashids\Facades\Hashids;

class AdminCollectionResource extends JsonResource
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
            'category_id'    => $this->category_id,
            'slug'           => isset($this->slug) ? $this->slug : '',
            'en_title'       => isset($this->translate('en')->title) ? $this->translate('en')->title : '',
            'fr_title'       => isset($this->translate('fr')->title) ? $this->translate('fr')->title : '',
            'en_description' => isset($this->translate('en')->description) ? $this->translate('en')->description : '',
            'fr_description' => isset($this->translate('fr')->description) ? $this->translate('fr')->description : '',
            'is_public'      => $this->is_public,
            'time_period'    => $this->time_period,
            'artists'        => $this->artists,
            'points'         => $this->points,
            'covers'         => $this->getMedialUrls($this, 'category'),
        ];
    }
}
