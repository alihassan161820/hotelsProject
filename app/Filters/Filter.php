<?php 

namespace App\Filters;
use Illuminate\Database\Eloquent\Builder;

interface Filter {
    
    public static function apply($builder, $data);

}