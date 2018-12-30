<?php 

namespace App\Filters;
use Illuminate\Database\Eloquent\Builder;

class City implements Filter {

    public static function apply($builder, $filter){
        return $builder->where('city', $filter);
    }

}