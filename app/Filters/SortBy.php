<?php 

namespace App\Filters;
use Illuminate\Database\Eloquent\Builder;

class SortBy implements Filter {
    
    public static function apply($builder, $filter){
        return collect($builder)->sortBy($filter)->values();
    }

}