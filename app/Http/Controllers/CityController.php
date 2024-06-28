<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\State;

class CityController extends Controller
{
    public function getCitiesByState(Request $request)
    {
        $stateId = $request->get('state_id');
        $stateName = State::where('name', $stateId)->first();
        $cities = City::where('state_id', $stateName->id)->get();        
        return response()->json($cities);
    }
}
