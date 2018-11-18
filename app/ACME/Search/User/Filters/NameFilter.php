<?php

namespace App\ACME\Search\User\Filters;

use App\ACME\Search\User\FilterInterface;
use Illuminate\Database\Eloquent\Builder;

class NameFilter implements FilterInterface
{
    /**
     * Apply a given search value to the builder instance.
     *
     * @param Builder $builder
     * @param mixed   $value
     * @return Builder $builder
     */
    public static function apply(Builder $builder, $value)
    {
        return $builder->where('name', 'like', "%$value%")
                       ->orWhere('email', $value);
    }
}

