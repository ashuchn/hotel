<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Http;
use DB;
use Session;
use Illuminate\Support\Facades\Cache;

class HotelController extends Controller
{
    //
    public function dashboard()
    {
        session()->put('showing', '');
        return view('dashboard');
        
        // $location = "mussorie";
        
    }
  

    public function showHotels(Request $request, $location = null)
    {

        if($request->isMethod('post')){
            $location = $request->location;
            //return redirect()->route('dashboard');
        }

        if($location == ''){
            return redirect()->route('dashboard');
        }



        if (Cache::has($location) && Cache::has($location."_sug")){
            $Cache = Cache::get($location);
            $hotels = $Cache;
            $citiesSuggestion = Cache::get($location."_sug");

            /**returns the suggestion according to user input */
            $suggestions = array();
            foreach($citiesSuggestion as $sug) {
                $object = new \stdClass();
                $object->geoId = $sug->geoId;
                $object->destinationId = $sug->destinationId;
                $object->name = $sug->name;

                array_push($suggestions, $object);
            }



         } else {
            $response = Http::withHeaders([
                'X-RapidAPI-Key' => env('RAPID_API_KEY'),
                'X-RapidAPI-Host' => env('RAPID_API_HOST')
            ])->get('https://hotels4.p.rapidapi.com/locations/v2/search', [
                'query' => $location
            ]);
    
            $hotels =  $response->json('suggestions')[1]['entities'];
            $citiesSuggestion = $response->json('suggestions')[0]['entities'];

            /**returns the suggestion according to user input */
            $suggestions = array();
            foreach($citiesSuggestion as $sug) {
                $object = new \stdClass();
                $object->geoId = $sug['geoId'];
                $object->destinationId = $sug['destinationId'];
                $object->name = $sug['name'];

                array_push($suggestions, $object);
            }

            $expiry = 300;
            Cache::put($location, $hotels, $expiry);
            Cache::put($location."_sug", $suggestions, $expiry);
    
            DB::table('cache')->insert([
                'key' => $location,
                'value' => json_encode($hotels),
                'expiration' => $expiry,
                'suggestion' => \json_encode($suggestions)
            ]);

         }
       
        $count = count($hotels);

        session()->put('showing', "Showing ".$count." Hotels in ".$location );
        

        $location = str_replace("+", " ", $location);
        
        return view('dashboard', ["hotels" => $hotels, "location"=>$location, "suggestions" => $suggestions ]);
    }

    public function listCache()
    {
        
    }

}
