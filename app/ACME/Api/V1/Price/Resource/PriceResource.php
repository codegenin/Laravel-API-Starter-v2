<?php

namespace App\ACME\Api\V1\Price\Resource;

use Illuminate\Http\Resources\Json\JsonResource;

class PriceResource extends JsonResource
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
            'points' => $this->points,
            'price'  => $this->price
        ];
    }
}
