<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



/*

Route::get('/home', 'PostsController@index');

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',

]);
*/
Route::get('/', 'ClientController@index');

    Route::group(['prefix' => 'clients'], function () {
        Route::get('',                  ['as' => 'clients.index',           'uses' => 'ClientController@index']);
        Route::post('',                 ['as' => 'clients.store',           'uses' => 'ClientController@store']);
        Route::get('/{id}',             ['as' => 'clients.show',            'uses' => 'ClientController@show']);
        Route::delete('/{id}',          ['as' => 'clients.delete',          'uses' => 'ClientController@destroy']);
        Route::put('/{id}',             ['as' => 'clients.update',          'uses' => 'ClientController@update']);
    });

    Route::group(['prefix' => 'project'], function () {
        Route::get('',                  ['as' => 'project.index',           'uses' => 'ProjectController@index']);
        Route::post('',                 ['as' => 'project.store',           'uses' => 'ProjectController@store']);
        Route::get('/{id}',             ['as' => 'project.show',            'uses' => 'ProjectController@show']);
        Route::delete('/{id}',          ['as' => 'project.delete',          'uses' => 'ProjectController@destroy']);
        Route::put('/{id}',             ['as' => 'project.update',          'uses' => 'ProjectController@update']);

    });