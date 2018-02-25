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
    return "Hello world";
});

$router->get('/debug', function () use ($router) {
    return phpinfo();
});


$router->post('stats', [
    'as' => 'stats_upload',
    'uses' => 'GameStatsController@uploadStats'
]);