<?php
namespace App\Repositories;

use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;



class ServiceRepository
{
    public function paginate($items, $perPage = 6, $page = null) {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $total = count($items);
        $currentPage = $page;
        $offset = ($currentPage * $perPage) - $perPage;
        $itemsToShow = array_slice($items,$offset,$perPage);

        return new LengthAwarePaginator($itemsToShow, $total, $perPage);
    }
}
