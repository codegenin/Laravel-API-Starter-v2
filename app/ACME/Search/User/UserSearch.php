<?php

namespace App\ACME\Search\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class UserSearch
{
    public static function apply(Request $request)
    {
        $query = static::applyDecoratorsFromRequest($request, (new User)->newQuery());
        
        return static::getResults($query);
    }
    
    private static function applyDecoratorsFromRequest(Request $request, Builder $query)
    {
        foreach ($request->all() as $filterName => $value) {
            
            $decorator = static::createFilterDecorator($filterName);
            
            if (static::isValidDecorator($decorator)) {
                $query = $decorator::apply($query, $value);
            }
            
        }
        return $query;
    }
    
    private static function createFilterDecorator($name)
    {
        return __NAMESPACE__ . '\\Filters\\' .
        str_replace(' ', '',
            ucwords(str_replace('_', ' ', $name.'Filter')));
    }
    
    private static function isValidDecorator($decorator)
    {
        return class_exists($decorator);
    }
    
    private static function getResults(Builder $query)
    {
        return $query->paginate();
    }
}