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
            'artist'         => $this->artist,
            'en_title'       => isset($this->translate('en')->title) ? $this->translate('en')->title : '',
            'fr_title'       => isset($this->translate('fr')->title) ? $this->translate('fr')->title : '',
            'en_description' => isset($this->translate('en')->description) ? $this->translate('en')->description : '',
            'fr_description' => isset($this->translate('fr')->description) ? $this->translate('fr')->description : '',
            'location'       => isset($this->translate('en')->location) ? $this->translate('en')->location : '',
            'fr_location'    => isset($this->translate('fr')->location) ? $this->translate('fr')->location : '',
            'en_time_period' => isset($this->translate('en')->time_period) ? $this->translate('en')->time_period : '',
            'fr_time_period' => isset($this->translate('fr')->time_period) ? $this->translate('fr')->time_period : '',
            'medium'         => isset($this->translate('en')->medium) ? $this->translate('en')->medium : '',
            'fr_medium'      => isset($this->translate('fr')->medium) ? $this->translate('fr')->medium : '',
            'score'          => isset($this->score) ? $this->score : '',
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
