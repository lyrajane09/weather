<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Weather</title>
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    </head>
    <body>
        <div class="flex-center position-ref full-height"  id="app">
            <div class="content">
                <div class="container">
                    <section class="row mt-5" id="search">
                        <div class="col-md-6  m-auto col-sm-12">
                            <div>
                                <input type="text" @keyup.enter="search()" v-model="searchField" placeholder="Search Location">
                                <svg class="bi bi-search" @click="search()" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor">
                                <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 011.415 0l3.85 3.85a1 1 0 01-1.414 1.415l-3.85-3.85a1 1 0 010-1.415z" clip-rule="evenodd"/>
                                <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 100-11 5.5 5.5 0 000 11zM13 6.5a6.5 6.5 0 11-13 0 6.5 6.5 0 0113 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                    </section>
                    <section class="row" id="weather-container" v-if="finalResults > 0 && weather != '' && location != ''">
                        <div class="col-md-4 mb-5 col-sm-12 text-center">
                            <span>{{ date("g:i A") }}</span>
                            <h5>{{ date("D, M j, Y") }}</h5>
                            <h2>@{{ weather.sys.country }}</h2>
                        </div>
                        <div class="col-md-4 mb-5 col-sm-12">
                            <h4>Details</h4>
                            <ul>
                                <li>Country: @{{ weather.sys.country }}</li>
                                <li>Wind: @{{ weather.wind.speed }} m/s</li>
                                <li v-for="w in weather.weather">Cloudiness: @{{ w.description }}</li>
                                <li>Humidity: @{{ weather.main.humidity }}</li>
                                <li>Geo coords: [@{{ weather.coord.lat }}, @{{ weather.coord.lon }}]</li>
                            </ul>
                        </div>
                        <div class="col-md-4 mb-5 col-sm-12">
                            <h4>Recommended Places</h4>
                            <ul>
                                <li v-for="recommendation in location.items">
                                    Venue: @{{recommendation.venue.name}}<br>
                                    Location: @{{recommendation.venue.location.address}}<br>
                                    Category: @{{recommendation.venue.categories[0].name}}<br>
                                </li>
                            </ul>
                        </div>
                    </section>
                    <section v-if="finalResults == 0" class="mt-5">
                        <center>No results found</center>
                    </section>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
