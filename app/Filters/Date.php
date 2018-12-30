<?php 

namespace App\Filters;
use Illuminate\Database\Eloquent\Builder;

class Date implements Filter {
    
    public static function apply($builder, $filter){
        $date = explode (",", $filter);  
        $hotelsArray = [];
        foreach ($builder as $hotelData) {
            $availability = collect($hotelData['availability'])->where('from','=',$date[0])
                                                                                                           ->where('to','=',$date[1]);
            if(!$availability->isEmpty()){
                array_push($hotelsArray, $hotelData);
            }
        }
        return $hotelsArray;
    }

}