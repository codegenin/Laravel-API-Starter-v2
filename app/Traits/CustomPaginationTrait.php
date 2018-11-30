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
     * @param $items
     * @param $total
     * @param $perPage
     * @param $page
     * @param $request
     * @return array
     */
    public function metaPage($items, $total, $perPage, $page, $request)
    {
        $paginator = new LengthAwarePaginator($items, $total, $perPage, $page,
            ['path' => $request->url(), 'query' => $request->query()]);
        
        return [
            'current_page' => $paginator->currentPage(),
            'from'         => $paginator->firstItem(),
            'last_page'    => $paginator->lastPage(),
            'per_page'     => $paginator->perPage(),
            'to'           => $paginator->lastItem(),
            'total'        => $paginator->total(),
        ];
    }
    
}