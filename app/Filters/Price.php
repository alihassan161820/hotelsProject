<?php 

namespace App\Filters;
use Illuminate\Database\Eloquent\Builder;

class Price implements Filter {
    
    public static function apply($builder, $filter){
        $price = explode ("-", $filter);  
        return $builder->where('price','>',$price[0])
                                      ->where('price','<',$price[1]);
    }

}