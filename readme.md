## Hotels Task

**Hotels application** is (REST API using laravel Fraamework) to allow search in this inventory  by any of the following :

- Hotel Name
- Destination [paris]
- Price range [ex: 60-200]
- Date range [ex: 22-10-2020,22-11-2020]

and allow sorting by:

- Hotel Name 
- Price

## Installation 
* `git clone https://github.com/alihassan161820/hotelsProject.git`
* `cd hotelsProject-master`
* `composer install`
* `rename .env.example file to .env`
* `php artisan key:generate`
* `php artisan serve` to start the app on http://127.0.0.1:8000

## Using App
 - You Can get json data dirctly using endpoints 
   * http://127.0.0.1:8000/hotels 
 - search data by passing search keywords as a parameters 
   * http://127.0.0.1:8000/hotels?name=Rotana Hotel&city=cairo&price=50-200&date=10-10-2020,12-10-2020&sortby=price

 
![alt text](https://github.com/alihassan161820/hotelsProject/blob/master/public/a.png)

