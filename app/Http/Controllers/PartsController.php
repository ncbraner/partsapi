<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Part;
use Validator;

class PartsController extends Controller
{
    public function update(Request $request, $id)
    {

    // validates required fields for modifying part data
    
    if( $this->validatePart($request) != 'True'){
     	return $this->validatePart($request);
     }

     //  Saves part if validation passes
	$part = Part::findOrFail($id);
	$part->part_number = $request->input("partNumber");
	$part->description = $request->input("description");
	$part->price = $request->input("price");
	$part->save();
	return response([
			"partNumber" => $part->part_number,
			"action" => "Part Number Updated ",
			"id" => $part->id 
		], 200);
    }

	public function store(Request $request)
	{
		
    if( $this->validatePart($request) != 'True'){
     	return $this->validatePart($request);
     }
		$part = new Part();
		$part->part_number = $request->input("partNumber");
		$part->description = $request->input("description");
		$part->price = $request->input("price");
		$part->save();
		return response([
				"partNumber" => $part->part_number,
				"action" => "Part Number Created",
			], 201);



	}

	protected function validatePart($request)
	{
		$validate = Validator::make($request->all(), [
     		'partNumber'=>'required',
     		'description'=> 'required'
		]); 
     // handles validation failure

	    if($validate->fails()){
	   		$errors = $validate->errors()->all();

	    	return response([
				"errors" => $errors
			], 422);
	     }

     	return 'True';
	}

}


