<?php


Route::get('/', function () {
    return view('app');
});

//Restful api services
Route::group(['prefix' => 'api/v1'], function(){

	Route::get('contacts', 'Api\ContactsController@index');
	Route::get('contacts/{uid}', 'Api\ContactsController@show')->where('uid', '[0-9]+');
	Route::post('contacts', 'Api\ContactsController@store');
	Route::patch('contacts', 'Api\ContactsController@update');
	Route::delete('contacts/{uid}', 'Api\ContactsController@delete')->where('uid', '[0-9]+');
	Route::get('contacts/refresh', 'Api\ContactsController@refresh');


});
