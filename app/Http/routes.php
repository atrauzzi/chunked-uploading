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

/** @var $router \Illuminate\Routing\Router */

$router->get('', 'WelcomeController@index');

$router->post('chunk', ['as' => 'chunk', 'uses' => 'WelcomeController@receiveChunk']);
$router->get('chunk', ['as' => 'chunk-check', 'uses' => 'WelcomeController@checkChunk']);