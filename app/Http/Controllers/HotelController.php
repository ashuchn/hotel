<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Http;
use DB;
use Session;
use Illuminate\Support\Facades\Cache;

class HotelController extends Controller
{
    
    public function __construct()
    {
        $this->expiry = 6000;
    }

    public function dashboard()
    {
        session()->put('showing', '');
        return view('dashboard');
        
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

            $c = count($hotels);

            for($i = 0 ; $i< $c ; $i++) {
                $destinationId = $hotels[$i]['destinationId'];
                $link = $this->getHotelImages($destinationId);
                $hotels[$i]['hotelImg'] = $link;
                $data = $this->hotelDetails($destinationId);
                $hotels[$i]['ameneties'] = $data['overview'] ;
                $hotels[$i]['propertyDetails'] = $data['property_and_rating'] ;
                $hotels[$i]['transport'] = $data['transport'] ;
            }


            // return $hotels;
            

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


           $c = count($hotels);

            for($i = 0 ; $i< $c ; $i++) {
                $destinationId = $hotels[$i]['destinationId'];
                $link = $this->getHotelImages($destinationId);
                $hotels[$i]['hotelImg'] = $link;
                $data = $this->hotelDetails($destinationId);
                $hotels[$i]['ameneties'] = $data['overview'] ;
                $hotels[$i]['propertyDetails'] = $data['property_and_rating'] ;
                $hotels[$i]['transport'] = $data['transport'] ;
            }
            // return $hotels;
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

            // $expiry = 3000;
            Cache::put($location, $hotels, $this->expiry);
            Cache::put($location."_sug", $suggestions, $this->expiry);
    


            /**
             * removed db query due to heroku restrictions
             */
            /*
            DB::table('cache')->insert([
                'key' => $location,
                'value' => json_encode($hotels),
                'expiration' => $expiry,
                'suggestion' => \json_encode($suggestions)
            ]);
            */

         }
       
        $count = count($hotels);
        $location = str_replace("+", " ", $location);
        session()->put('showing', "Showing ".$count." Hotels in ".$location );
        

        
        // return $hotels;
        
        return view('dashboard', ["hotels" => $hotels, "location"=>$location, "suggestions" => $suggestions ]);
    }



    public function getHotelImages($hotelId)
    {

        if(Cache::has($hotelId."_hImages")  ) {
            $hotelImageLinks = Cache::get($hotelId."_hImages");
            return $hotelImageLinks;
        }

        $response = Http::withHeaders([
            'X-RapidAPI-Key' => env('RAPID_API_KEY'),
            'X-RapidAPI-Host' => env('RAPID_API_HOST')
        ])->get('https://hotels4.p.rapidapi.com/properties/get-hotel-photos', [
            'id' => $hotelId
        ]);

        $images =  $response->json('hotelImages');
        
        $hotelImageLinks = array();

        foreach($images as $image)
        {
            $link = str_replace("{size}", "b", $image['baseUrl']);
            array_push($hotelImageLinks, $link);
        }
        
        Cache::put($hotelId."_hImages", $hotelImageLinks, $this->expiry);

        return $hotelImageLinks;
    }



    public function hotelDetails($hotelId)
    {

        if(Cache::has($hotelId."_details"))
        {
            $data = Cache::get($hotelId."_details");
            $transport = $data['transport']['transportLocations']; //array of objects
            $overview = $data['body']['overview']['overviewSections']; //array of objects
            $property_and_rating = $data['body']['propertyDescription'];
            return [
                "overview" => $overview,
                "property_and_rating" => $property_and_rating,
                "transport" => $transport
            ];

        }

        $response = Http::withHeaders([
            'X-RapidAPI-Key' => env('RAPID_API_KEY'),
            'X-RapidAPI-Host' => env('RAPID_API_HOST')
        ])->get('https://hotels4.p.rapidapi.com/properties/get-details', [
            'id' => $hotelId
        ]);

        
        $data = $response->json('data');
        $transport = $response->json('transportation');
        $data['transport'] = $transport;
        Cache::put($hotelId."_details", $data, 6000);
        $overview = $data['body']['overview']['overviewSections'];
        $property_and_rating = $data['body']['propertyDescription'];
        
        return [
            "overview" => $overview,
            "property_and_rating" => $property_and_rating,
            "transport" => $transport
        ];
    }


}
