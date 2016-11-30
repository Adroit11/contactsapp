<?php


Route::get('/', function () {
    return view('app');
});

//Restful api services
Route::group(['prefix' => 'api/v1'], function(){

	Route::get('contacts', 'Api\ContactsController@index');


});
