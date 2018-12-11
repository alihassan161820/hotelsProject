<?php
 
namespace App\Repositories;

use App\Services\HotelsDataService;


class HotelsRepository 
{
	/**
	 * @var $hotelsData
	 */
	private $hotelsData;
 
	/**
	 *  create a new hotels repository instance.
	 *  Get hotels data from hotelDataService
	 * @param App\Services\HotelsDataService $hotelDataService
    */

	public function __construct(HotelsDataService $hotelDataService)
	{
		$this->hotelsData = $hotelDataService->getData();
    }
 
    public function searchHotelsData($name, $priceRange, $city, $date)
    {   
        $price = null;
        $availableDate = null ;
        if($priceRange){
            $price = explode ("-", $priceRange);  
        }
        if($date){
            $availableDate = explode (",", $date);  
        }
        
        if($name){
            if($price){
                if($availableDate){
                    if($city){
                        return $this->getHotelsByAll($name, $price, $availableDate, $city);
                    }
                    return $this->getHotelsByNamePriceAndDate($name, $price, $availableDate);   
                }
                elseif($city){
                    return $this->getHotelsByNamePriceAndCity($name, $price, $city);
                }
                return $this->getHotelsByNameAndPrice($name, $price);
            }
            elseif($availableDate){
                if($city){
                    return $this->getHotelsByNameDateAndCity($name, $availableDate, $city);
                }
                return $this->getHotelsByNameAndDate($name, $availableDate);
            }
            elseif($city){
                return $this->getHotelsByNameAndCity($name, $city);
            }
            return $this->getHotelsByName($name);
        }
        elseif($priceRange){
            if($availableDate){
                if($city){
                    return $this->getHotelsByPriceDateAndCity($price, $availableDate, $city);
                }
                return $this->getHotelsByPriceAndDate($price, $availableDate);
            }
            elseif($city){
                return $this->getHotelsByPriceAndCity($price, $city);
            }
            return $this->getHotelsByPrice($price);
        }
        elseif($availableDate){
            if($city){
                return $this->getHotelsByDateAndCity($availableDate, $city);
            }
            return $this->getHotelsByDate($availableDate);
        }
        elseif($city){
            return $this->getHotelsByCity($city);
        }
        else{
            return $this->hotelsData;
        }
    }

    private function getAvailableDate($hotelsData, $date)
    {
        $hotelsArray = [];
        foreach ($hotelsData as $hotelData) {
            $availability = collect($hotelData['availability'])->where('from','=',$date[0])
                                                                                                           ->where('to','=',$date[1]);
            if(!$availability->isEmpty()){
                array_push($hotelsArray, $hotelData);
            }
        }
        return $hotelsArray;
    }

    private function getHotelsByAll($name, $price, $availableDate, $city)
    {  
        $data = $this->hotelsData ->where('name', $name)
                                                            ->where('price','>',$price[0])
                                                            ->where('price','<',$price[1])
                                                            ->where('city', $city);
        return $this->getAvailableDate($data, $availableDate);                                              
    }


    private function getHotelsByNamePriceAndDate($name, $price, $availableDate)
    {
        $data = $this->hotelsData ->where('name', $name)
                                                            ->where('price','>',$price[0])
                                                            ->where('price','<',$price[1]);
        return $this->getAvailableDate($data, $availableDate);               
    }


    private function getHotelsByNamePriceAndCity($name, $price, $city)
    {
        return $this->hotelsData ->where('name', $name)
                                                          ->where('price','>',$price[0])
                                                          ->where('price','<',$price[1])
                                                          ->where('city', $city);   
    }


    private function getHotelsByNameAndPrice($name, $price)
    {
        return $this->hotelsData ->where('name', $name)
                                                          ->where('price','>',$price[0])
                                                          ->where('price','<',$price[1]);
    }


    private function getHotelsByNameDateAndCity($name, $availableDate, $city)
    {
        $data = $this->hotelsData ->where('name', $name)
                                                            ->where ('city', $city);
        return $this->getAvailableDate($data, $availableDate);          
    }


    private function getHotelsByNameAndDate($name, $availableDate)
    {
        $data = $this->hotelsData ->where('name', $name);
        return $this->getAvailableDate($data, $availableDate);          
    }


    private function getHotelsByNameAndCity($name, $city)
    {
        return $this->hotelsData ->where('name', $name)
                                                          ->where ('city', $city);
    }


    private function getHotelsByName($name)
    {
        return $this->hotelsData ->where('name', $name);
    }


    private function getHotelsByPriceDateAndCity($price, $availableDate, $city)
    {
        $data = $this->hotelsData ->where('price','>',$price[0])
                                                            ->where('price','<',$price[1])
                                                            ->where('city', $city);
        return $this->getAvailableDate($data, $availableDate);        
    }


    private function getHotelsByPriceAndDate($price, $availableDate)
    {
        $data = $this->hotelsData ->where('price','>',$price[0])
                                                            ->where('price','<',$price[1]);
        return $this->getAvailableDate($data, $availableDate);
    }


    private function getHotelsByPriceAndCity($price, $city)
    {
        return $this->hotelsData ->where('price','>',$price[0])
                                                            ->where('price','<',$price[1])
                                                            ->where('city', $city);
    }


    private function getHotelsByPrice($price)
    {
        return $this->hotelsData ->where('price','>',$price[0])
                                                          ->where('price','<',$price[1]);
    }


    private function getHotelsByDateAndCity($availableDate, $city)
    {
        $data = $this->hotelsData ->where('city', $city);
        return $this->getAvailableDate($data, $availableDate);        
    }


    private function getHotelsByDate($availableDate)
    {
        $data = $this->hotelsData;
        return $this->getAvailableDate($data, $availableDate);        
    }

    private function getHotelsByCity($city)
    {
        return $this->hotelsData ->where('city', $city);
    }
   
}
 