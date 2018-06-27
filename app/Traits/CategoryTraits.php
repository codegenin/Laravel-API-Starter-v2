<?php

namespace App\Traits;

use App\ACME\Admin\Category\Requests\StoreCategoryRequest;

trait CategoryTraits
{
    /**
     * Prepare category fields for storing
     *
     * @param StoreCategoryRequest $request
     * @return array
     */
    public function prepareFields(StoreCategoryRequest $request)
    {
        return [
            'name'        => $request->name,
            'slug'        => str_slug($request->name),
            'description' => $request->description,
            'is_public'   => $request->is_public,
            'parent_id'   => $request->parent_id
        ];
    }
}