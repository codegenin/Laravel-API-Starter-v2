<?php

namespace App\Traits;

use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

trait MediaTraits
{
    /**
     * Associate media to a collection
     * @param $model
     * @param $request
     * @param $collection
     * @return bool
     */
    public function associateMedia($model, $request, $collection): bool
    {
        try {
            $model->addMedia($request->file)
                  ->toMediaCollection($collection);
        } catch (\Exception $e) {
            throw new FileException($e);
        }
        
        return true;
    }
}