<html>

<head>
    <meta name="_token" content="{{ csrf_token() }}">
    <title>Hotels Application</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Hotels Application</h3>
            </div>
            <div class="panel-body">
                <div class="form-inline">
                    <div class="form-group sm-2">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name : Media One Hotel"></input>
                        <input type="text" class="form-control" id="minPrice" name="minPrice" placeholder="Min Price : 50"></input>
                        <input type="text" class="form-control" id="maxPrice" name="maxPrice" placeholder=" Max Price : 200"></input>
                        <input type="text" class="form-control" id="city" name="city" placeholder=" Hotel City : dubai"></input>
                        <input type="text" class="form-control" id="dateFrom" name="dateFrom" placeholder=" Date From : 10-10-2020"></input>
                        <input type="text" class="form-control" id="dateTo" name="dateTo" placeholder=" Date To : 15-10-2020"></input>
                        <select class="form-control" name="sortby" id="sortby">
                            <option value="">Sort By . . . </option>
                            <option value="price">Price</option>
                            <option value="name">Hotel Name</option>
                        </select>
                        <input type="submit" class="form-control btn btn-primary" onclick="getHotelsData()" value="Search">
                    </div>
                </div>
            </br>
                <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Hotel Name</th>
                                <th>Price</th>
                                <th>City</th>
                                <th>Availability</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
    <script type="text/javascript">

        window.getHotelsData();

        function getHotelsData() {
            $name = document.getElementById('name').value;
            $minPrice = document.getElementById('minPrice').value;
            $maxPrice = document.getElementById('maxPrice').value;
            $city = document.getElementById('city').value;
            $dateFrom = document.getElementById('dateFrom').value;
            $dateTo = document.getElementById('dateTo').value;
            $sortby = document.getElementById('sortby').value;
            $price = '';
            $date = '';
            if ($minPrice && $maxPrice) {
                $price = $minPrice + '-' + $maxPrice;
            }
            if ($dateFrom && $dateTo) {
                $date = $dateFrom + ',' + $dateTo;
            }


            $.ajax({
                type: 'GET',
                url: "/hotels",
                async: false ,
                data: {
                    'name': $name,
                    'city': $city,
                    'price': $price,
                    'date': $date,
                    'sort_by':$sortby
                },
                success: function (data) {
                    console.log(data);
                    result = "";
                    if (data === undefined || data.length == 0) {
                        $('tbody').html('There is No Hotels Found');
                    }
                    if(typeof data === 'object' && data !== null)
                        data = Object.values(data);
                    data.forEach(function (hotel) {
                        result += '<tr>' +
                            '<td>' + hotel.name + '</td>' +
                            '<td>' + hotel.price + '</td>' +
                            '<td>' + hotel.city + '</td>' +
                            '<td>';
                        hotel.availability.forEach(function (date) {
                            result += '<span>from : ' + date.from + ' - to : ' + date.to +
                                '</span></br>';
                        });
                        result += '</td></tr>'
                        $('tbody').html(result);
                    })
                },
            });
        }
    </script>
</body>

</html>