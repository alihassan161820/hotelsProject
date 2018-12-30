<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\HotelsRepository;
use App\Services\HotelsDataService;

class HotelsController extends Controller
{

    public function __construct(HotelsDataService $hotelsDataService)
    {
    }


}
