<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use Illuminate\Http\Request;
use App\Company;
use App\Facility;
use App\Menu;

class CompanyController extends Controller
{

	public function getReportByPrice()
	{

		try {
    		$user = auth()->userOrFail();
    	} catch(\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e){
    		return response()->json(['Error' => $e->getMessage()]);
    	}

		$companies = Company::with('facilities1.menu')
		->get();

   		return response($companies, 200);

	}

	public function getReportByName()
	{

		try {
    		$user = auth()->userOrFail();
    	} catch(\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e){
    		return response()->json(['Error' => $e->getMessage()]);
    	}

		$companies = Company::with('facilities2.menu')
		->get();

   		return response($companies, 200);

	}

    public function getAll() {

    	try {
    		$user = auth()->userOrFail();
    	} catch(\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e){
    		return response()->json(['Error' => $e->getMessage()]);
    	}

      	$companies = Company::all();

   		return response($companies, 200);
    }

    public function create(Request $request) {

    	try {
    		$user = auth()->userOrFail();
    	} catch(\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e){
    		return response()->json(['Error' => $e->getMessage()]);
    	}

     	$company = new Company;
	    $company->name = $request->name;
	    $company->cif = $request->cif;
	    $company->save();

	    return response()->json([
	        "message" => "Company created",
	        'company_id' => $company->id
	    ], 201);
    }

    public function get($id) {
   		
    	try {
    		$user = auth()->userOrFail();
    	} catch(\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e){
    		return response()->json(['Error' => $e->getMessage()]);
    	}

    	if (Company::where('id', $id)->exists()) {

	        $Company = Company::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
	        return response($Company, 200);

  		} else {
	        return response()->json([
	          "message" => "Company not found"
	        ], 404);
  		}

    }

    public function update(Request $request, $id) {
    	
    	try {
    		$user = auth()->userOrFail();
    	} catch(\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e){
    		return response()->json(['Error' => $e->getMessage()]);
    	}

    	if (Company::where('id', $id)->exists()) {
	        $Company = Company::find($id);
	        $Company->name = is_null($request->name) ? $Company->name : $request->name;
	        $Company->cif = is_null($request->cif) ? $Company->cif : $request->cif;
	        $Company->save();

	        return response()->json([
	            "message" => "Company updated successfully"
	        ], 200);
        } else {
	        return response()->json([
	            "message" => "Company not found"
	        ], 404);
	        
	    }

    }

    public function delete ($id) 
    {

    	try {
    		$user = auth()->userOrFail();
    	} catch(\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e){
    		return response()->json(['Error' => $e->getMessage()]);
    	}
    	
    	if(Company::where('id', $id)->exists()) {
	        $Company = Company::find($id);
	        $Company->delete();

	        return response()->json([
	          "message" => "Company deleted"
	        ], 202);
      	} else {
	        return response()->json([
	          "message" => "Company not found"
	        ], 404);
      	}

    }
}
