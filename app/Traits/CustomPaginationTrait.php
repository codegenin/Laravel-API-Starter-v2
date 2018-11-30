<?php

namespace App\Traits;

use Illuminate\Pagination\LengthAwarePaginator;
use Mockery\Exception;
use Psr\Log\InvalidArgumentException;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Vinkla\Hashids\Facades\Hashids;

trait CustomPaginationTrait
{
    /**
     * Generate next url
     *
     * @param $total
     * @return null|string
     */
    public function nextPageUrl($total, $perPage = 10)
    {
        $next  = null;
        $pages = ceil($total / $perPage);
        $page  = !request('page') ? 1 : request('page');
        
        if (request('page') != $pages) {
            $next = url()->current() . '?page=' . ($page + 1);
        }
        
        return $next;
    }
    
    /**
     * Generate page meta
     *
     * @param $paginatedItems
     * @return array
     */
    public function metaPage($paginatedItems)
    {
        return [
            'current_page' => $paginatedItems->toArray()['current_page'],
            'from'         => $paginatedItems->toArray()['from'],
            'last_page'    => $paginatedItems->toArray()['last_page'],
            'path'         => $paginatedItems->toArray()['path'],
            'per_page'     => $paginatedItems->toArray()['per_page'],
            'to'           => $paginatedItems->toArray()['to'],
            'total'        => $paginatedItems->toArray()['total'],
        ];
    }
    
}