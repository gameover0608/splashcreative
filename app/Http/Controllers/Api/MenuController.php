<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use Illuminate\Http\Request;
use App\Menu;

class MenuController extends Controller
{
    
	public function create(Request $request) 
	{

    	try {
    		$user = auth()->userOrFail();
    	} catch(\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e){
    		return response()->json(['Error' => $e->getMessage()]);
    	}

     	$menu = new Menu;
     	$menu->facility_id = $request->facility_id;
	    $menu->name = $request->name;
	    $menu->price = $request->price;

		if (Menu::where('facility_id',  $request->facility_id)->exists()) {
		  
			return response()->json([
		        "message" => "Menu already exists for this facility. Please update.",
		        //'user' => $user
		    ], 501);

		}

	    $menu->save();

	    return response()->json([
	        "message" => "Menu created",
	        //'user' => $user
	    ], 201);
    }

    public function update(Request $request, $facility_id)
    {

    	try {
    		$user = auth()->userOrFail();
    	} catch(\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e){
    		return response()->json(['Error' => $e->getMessage()]);
    	}

    	if (Menu::where('facility_id', $facility_id)->exists()) {
	        $menu = Menu::where('facility_id', $facility_id)->first();
	        $menu->name = is_null($request->name) ? $menu->name : $request->name;
	        $menu->price = is_null($request->price) ? $menu->price : $request->price;
	        $menu->save();

	        return response()->json([
	            "message" => "menu updated successfully"
	        ], 200);
        } else {
	        return response()->json([
	            "message" => "menu not found"
	        ], 404);
	        
	    }

    }

    public function delete ($facility_id) 
    {

    	try {
    		$user = auth()->userOrFail();
    	} catch(\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e){
    		return response()->json(['Error' => $e->getMessage()]);
    	}
    	
    	if(Menu::where('facility_id', $facility_id)->exists()) {
	        $menu = Menu::where('facility_id', $facility_id);
	        $menu->delete();

	        return response()->json([
	          "message" => "menu deleted"
	        ], 202);
      	} else {
	        return response()->json([
	          "message" => "menu not found"
	        ], 404);
      	}

    }

}
