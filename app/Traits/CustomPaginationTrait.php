<?php

namespace App\Traits;

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
        
        for ($i = 1; $i < $pages; $i++) {
            if (request('page') != $pages) {
                $next = url()->current() . '?page=' . ($i + 1);
            }
        }
        
        return $next;
    }
    
}