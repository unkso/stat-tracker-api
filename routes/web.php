<?php
/**
 * @var \Laravel\Lumen\Routing\Router $router
 */

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
    return new \Illuminate\Http\Response(["error" => "👻 This is not the page you're looking for."], 404);
});

$router->post('stats', [
    'as' => 'stats_upload',
    'uses' => 'GameStatsController@uploadStats'
]);

$router->get('stats', [
    'as' => 'get_stats',
    'uses' => 'GameStatsController@getStats'
]);