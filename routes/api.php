<?php

use App\Part;
use App\BinLocation;
use Illuminate\Http\Request;
use App\Http\Controllers\PartsController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');


//routes for parts

//get all parts avail
Route::get('/parts', function(Request $request){
	$parts = Part::all();
	return $parts;
});

//get all parts by specific id
Route::get('/parts/{id}', function($id){
	$part = Part::findOrFail($id);
	$response = [
		'partNumber' => $part->part_number,
		'description' => $part->description,
		'price' => $part->price

	];
	return $response;
});

Route::delete('/parts/{id}', function($id){
	$part = Part::findOrFail($id);
	$part->delete();

	return response([
			"partNumber" => $part->part_number,
			"action" => "Part Number Removed",
		], 200);
});


Route::post('/parts', 'PartsController@store');

Route::patch('/parts/{id}','PartsController@update' );


Route::delete('/parts', function(Request $request){
	$parts = Parts::all();
	return $parts;


});
//routes for bins

Route::get('/binlocation', function(Request $request){
	$binlocation = BinLocation::all();
	return $binlocation;

});

Route::post('binlocation', function(Request $request){
	$binlocation= new Binlocation();
	$binlocation->saveLocation($request);
	return 'success';
});
