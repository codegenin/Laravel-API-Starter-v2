<?php

namespace App\ACME\Admin\Media\Resources;

use App\ACME\Admin\Tag\Resource\TagAjaxResource;
use App\ACME\Admin\Tag\Resource\TagAjaxSelectedResource;
use App\ACME\Admin\Tag\Resource\TagResource;
use App\Traits\MediaTraits;
use Illuminate\Http\Resources\Json\JsonResource;
use Vinkla\Hashids\Facades\Hashids;

class MediaResource extends JsonResource
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
            'en_title'        => $this->translate('en')->title ?: '',
            'fr_title'        => $this->translate('fr')->title ?: '',
            'en_description' => $this->translate('en')->description ?: '',
            'fr_description' => $this->translate('fr')->description ?: '',
            'location'       => $this->location ?: '',
            'score'          => $this->score ?: '',
            'images'         => [
                'original' => $this->getUrl(),
                'large'    => $this->getUrl('large'),
                'medium'   => $this->getUrl('medium'),
                'small'    => $this->getUrl('small'),
            ],
            'created'        => $this->created_at
        
        ];
    }
}
