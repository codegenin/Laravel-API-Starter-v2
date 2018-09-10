<?php

namespace App\Traits;

use Mockery\Exception;
use Psr\Log\InvalidArgumentException;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Vinkla\Hashids\Facades\Hashids;

trait MediaTraits
{
    /**
     * Get all media urls
     *
     * @param $model
     * @param $collection
     * @return array
     */
    public function getMedialUrls($model, $collection): array
    {
        $covers = [];
        
        if (count($model->getMedia($collection)) > 0) {
            foreach ($model->getMedia($collection) as $media) {
                $covers['original'] = $media->getUrl();
                $covers['cover']    = $media->getUrl('cover');
                $covers['large']    = $media->getUrl('large');
                $covers['medium']   = $media->getUrl('medium');
                $covers['small']    = $media->getUrl('small');
            }
        } else {
            $covers['original'] = asset('images/default-image.png');
            $covers['cover']    = asset('images/default-image.png');
            $covers['large']    = asset('images/default-image.png');
            $covers['medium']   = asset('images/default-image.png');
            $covers['small']    = asset('images/default-image.png');
        }
        
        return $covers;
    }
    
    /**
     * Associate media to a collection
     *
     * @param $model
     * @param $request
     * @param $collection
     * @return bool
     */
    public function associateMedia($model, $request, $collection)
    {
        try {
            $media = $model->addMedia($request->file)
                           ->toMediaCollection($collection);
        } catch (\Exception $e) {
            throw new FileException($e);
        }
        
        return $media;
    }
    
    /**
     * Insert additional media information
     * @param $media
     * @param $request
     * @return bool
     */
    public function addMediaInformation($media, $request, $categoryId = null): bool
    {
        try {
            $media->category_id                       = $categoryId;
            $media->user_id                           = auth()->user()->id;
            $media->translateOrNew('en')->title       = $request->title;
            $media->translateOrNew('fr')->title       = $request->fr_title;
            $media->translateOrNew('en')->description = $request->description;
            $media->translateOrNew('fr')->description = $request->fr_description;
            $media->translateOrNew('en')->location    = $request->location;
            $media->translateOrNew('fr')->location    = $request->fr_location;
            $media->translateOrNew('en')->medium      = $request->medium;
            $media->translateOrNew('fr')->medium      = $request->fr_medium;
            $media->syncTags($request->tags);
            $media->save();
        } catch (\Exception $e) {
            throw new InvalidArgumentException($e);
        }
        
        return true;
    }
}