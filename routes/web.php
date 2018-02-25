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

$router->get('stats/bf1/latest', [
    'as' => 'get_latest_stats_bf1',
    'uses' => 'Bf1StatsController@getLatestStats'
]);

$router->get('stats/bf4/latest', [
    'as' => 'get_latest_stats_bf4',
    'uses' => 'Bf4StatsController@getLatestStats'
]);

$router->get('stats/r6siege/latest', [
    'as' => 'get_latest_stats_r6siege',
    'uses' => 'R6SiegeStatsController@getLatestStats'
]);