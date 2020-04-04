<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class WeatherController extends Controller
{
    private $weatherAPI;
    private $locationAPI;

    public function __construct(){
        config(['apiURL' => 'http://api.openweathermap.org']);
        config(['apiKey' => 'b1edaee2b692de3fb6cfa0b3fd542098']);

        config(['apiLocationURL' => 'https://api.foursquare.com']);
        config(['clientID' => 'MOHIKASIELIOQIYGNS3YW5Y12ZO1FCIPZ31R52GWGBZEMEQT']);
        config(['clientSecret' => '03NG4DMPZ13KCYS4PUEPYBAQUY5CDXG1SOQ4XGJKAAVXM0KJ']);
        config(['v' => date("Ymd")]);
        config(['limit' => 3]);

        $this->weatherAPI = new \GuzzleHttp\Client(['base_uri' => config('apiURL'), 'verify' => false]);
        $this->locationAPI = new \GuzzleHttp\Client(['base_uri' => config('apiLocationURL'), 'verify' => false]);
    }

    /**
     * @param string
     * @return results of weather api
     */
    public function searchWeather(Request $request){

        $response = '';
        $message = '';
        $status = 200;

        try{
            $response = $this->weatherAPI->get('data/2.5/weather/?q='.$request->searchField.'&appid='.config('apiKey'));
            $response = $response->getBody()->getContents();
            
            $response = json_decode($response);
            
        }catch(\Exception $e){
           $status = 500;
           $message = 'Oops something went wrong';
        }

        return response()->json([
            'message' => $message,
            'status'  => $status,
            'response' => $response
        ]);
    }

    /**
     * @param string
     * @return results of location api
     */
    public function searchLocation(Request $request){

        $response = '';
        $message = '';
        $status = 200;
        
        try{
            $response = $this->locationAPI->get('v2/venues/explore?client_id='.config('clientID').'&client_secret='.config('clientSecret').'&v='.config('v').'&limit='.config('limit').'&near='.$request->searchField);
            $response = $response->getBody()->getContents();
            
            $response = json_decode($response);
            
        }catch(\Exception $e){
           $status = 500;
           $message = 'Oops something went wrong';
        }

        return response()->json([
            'message' => $message,
            'status'  => $status,
            'response' => $response
        ]);
    }
}
