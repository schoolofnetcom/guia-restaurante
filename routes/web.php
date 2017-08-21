<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

Dusterio\LumenPassport\LumenPassport::routes($app);

$app->get('/', function () use ($app) {
    //return $app->version();
    return view('teste');
});

$app->group(['prefix' => 'api/v1', 'namespace' => 'Api\V1', 'middleware'=>['auth']], function () use ($app) {
    $app->get('restaurants', 'RestaurantsController@index');
    $app->get('restaurants/{id}', 'RestaurantsController@show');
    $app->post('restaurants', 'RestaurantsController@store');
    $app->put('restaurants/{id}', 'RestaurantsController@update');
    $app->post('restaurants/{id}', 'RestaurantsController@update');
    $app->delete('restaurants/{id}', 'RestaurantsController@destroy');
});
