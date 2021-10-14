<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router) {

    /* product route */
    $router->group(['prefix' => 'products', 'middleware' => 'auth'], function () use ($router) {

        $router->get('', ['uses' => 'ProductController@index']);
        $router->get('/search', ['uses' => 'ProductController@search']);
        $router->get('/{id}', ['uses' => 'ProductController@show']);
        $router->get('/{id}/restore', ['uses' => 'ProductController@restore']);
        $router->put('/{id}', 'ProductController@update');
        $router->delete('/{id}', 'ProductController@delete');
        $router->delete('/{id}/purge', 'ProductController@destroy');
        $router->post('', ['uses' => 'ProductController@store']);
    });

    /* auth route */
    $router->group(['prefix' => 'auth'], function () use ($router) {
        $router->post('/login', ['uses' => 'AuthController@login']);
        $router->post('/register', ['uses' => 'AuthController@register']);
    });
});
