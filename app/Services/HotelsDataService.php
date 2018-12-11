<?php


namespace App\Services;

use Illuminate\Http\Request;

/*
| This file is for getting hotels json data from the external API  and return it as collection 
| Guzzle is a PHP HTTP client that makes it easy to send HTTP requests 
|   and trivial to integrate with web services. 
*/

class HotelsDataService {

    private $api = 'https://api.myjson.com/bins/pq0f6';

    public function getData() 
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->get($this->api);
        $response = $request->getBody()->getContents();
        $data = json_decode($response, true);
        $result = collect($data['hotels']);
        return $result;
    }

} 
