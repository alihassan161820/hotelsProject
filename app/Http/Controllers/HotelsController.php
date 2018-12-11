<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\HotelsRepository;

class HotelsController extends Controller
{
    /**
     * The repository which contain data queries 
     *
     * @var hotels
     */
    private $hotels;

    /**
     * TaskController constructor.
	 *
	 * @param App\Repositories\HotelsRepository $hotels
	 */

    public function __construct(HotelsRepository $hotels)
    {
        $this->hotels = $hotels;
    }

    /**
	 * Get  hotels according  to  user's search critria .
	 *
	 * @return hotels data which user search for 
	 */

    public function index (Request $request)
    {
        $name = $request->input('name');
        $priceRange = $request->input('price');
        $city = $request->input('city');
        $date = $request->input('date');
        $sortBy = $request->input('sortby');

        if($sortBy){
            $unsortedHotels = $this->hotels->searchHotelsData($name, $priceRange, $city, $date);
            $sortedHotels = $unsortedHotels->sortBy($sortBy);
            return $sortedHotels->values();
        }else{
            return $this->hotels->searchHotelsData($name, $priceRange, $city, $date);
        }
    }
}
