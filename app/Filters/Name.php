<?php 

namespace App\Filters;
use Illuminate\Database\Eloquent\Builder;

class Name implements Filter {

    public static function apply($builder, $filter){
        return $builder->where('name', $filter);
    }

}