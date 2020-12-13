<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use Illuminate\Http\Request;
use App\Facility;

class FacilityController extends Controller
{
    
	public function create(Request $request) 
	{

    	try {
    		$user = auth()->userOrFail();
    	} catch(\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e){
    		return response()->json(['Error' => $e->getMessage()]);
    	}

     	$facility = new Facility;
     	$facility->company_id = $request->company_id;
	    $facility->name = $request->name;
	    $facility->address = $request->address;

	    $facility->save();

	    return response()->json([
	        "message" => $request->name,
	        'facility_id' => $facility->id
	    ], 201);
    }

}
