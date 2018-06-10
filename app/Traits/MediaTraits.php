<?php

namespace App\Traits;

use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

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
                $covers['large']    = $media->getUrl('large');
                $covers['medium']   = $media->getUrl('medium');
                $covers['small']    = $media->getUrl('small');
            }
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
    public function addMediaInformation($media, $request) : bool
    {
        try {
            $media->title    = $request->title;
            $media->location = $request->location;
            $media->during   = $request->during;
            $media->user_id  = auth()->user()->id;
            $media->save();
        } catch (\Exception $e) {
            return false;
        }
        
        return true;
    }
}