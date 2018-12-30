<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Filters;
use App\Services\HotelsDataService;

class SearchController extends Controller
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
 
    public function search(Request $request){

        $hotels =$this->applyFilters($request, $this->hotelsData);
        return $hotels;

    }


    public function applyFilters($request, $hotels){

        $requestParams = $request->all();
        foreach ($requestParams as $requestParam => $value) {
            $className ='App\\Filters\\' . str_replace(' ', '', ucwords(str_replace('_', ' ', $requestParam)));
            if (class_exists($className) && $value!= null) {
                $hotels = $className::apply($hotels, $value);
            }
    
        }
        return $hotels;
    }

}
