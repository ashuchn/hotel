<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Http;
use Session;

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
        
        // return $request->location;
        $response = Http::withHeaders([
            'X-RapidAPI-Key' => '2396fecf8bmshddf5c8ca5c98440p1bce64jsnd00b2f16e362',
            'X-RapidAPI-Host' => 'hotels4.p.rapidapi.com'
        ])->get('https://hotels4.p.rapidapi.com/locations/v2/search', [
            'query' => $location
        ]);

        // if($request->status() != 200) {
        //     session()->put('status', 'error with api');
        //     return view('dashboard');
        // } else {
        //     session()->put('status', '');
        // }

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
       
        $count = count($hotels);
        // $landmark = $response->json('suggestions')[2]['entities'];
        session()->put('showing', "Showing ".$count." Hotels in ".$location );
        
        return view('dashboard', ["hotels" => $hotels, "location"=>$location, "suggestions" => $suggestions ]);
    }

}
