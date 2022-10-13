<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Players;


class PlayerController extends Controller
{
    public function players()
    {
        $data = Players::all();
        return view('player.index', ['data' => $data]);
    }

    public function fetchPlayers(Request $request)
    {
        // return $request->all();
        if(!$request->has('start')) {
            $offset = 0;
        } else {
            $offset = $request->start;
        }
        
        if(!$request->has('length')) {
            $limit = 10;
        } else {
            $limit = $request->length;
        }

        $orderDetails = $request->order;
        $orderByColNum = $orderDetails[0]['column'];
        $orderType = $orderDetails[0]['dir'];
        $orderByColName = '';
        switch($orderByColNum) {
            case 0 : $orderByColName = "team";
                    break;
            
            case 1 : $orderByColName = "firstName";
                    break;
            
            case 2 : $orderByColName = "lastName";
                    break;

            case 3 : $orderByColName = "position";
                    break;
        }



        // echo $offset;exit;
        $data = Players::offset($offset)->limit($limit)->orderBy($orderByColName, $orderType)->get(['team','firstName', 'lastName', 'position']); 
        $mainArr = array();
        
        foreach($data as $value) {
            //return $value;exit;
            $tempArr = array();
            $tempArr[] = $value['team'];
            $tempArr[] = $value['firstName'];
            $tempArr[] = $value['lastName'];
            $tempArr[] = $value['position'];
            

            array_push($mainArr,$tempArr);
        }
        
        $response = new \StdClass();
        $response->draw = (int)$request->draw;
        $response->recordsTotal = count(Players::all());
        // $response->recordsFiltered = count($data);
        $response->recordsFiltered =  count(Players::all());
        $response->data = $mainArr;
        
        return $response;
    }

}
