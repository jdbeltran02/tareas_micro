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
$router->group(['prefix' => 'web'], function () use ($router) {
   
    $router->get('/empleados', 'EmpleadoController@index');
    $router->post('/empleados', 'EmpleadoController@store');
    $router->get('/empleados/{id}', 'EmpleadoController@show');
    $router->put('/empleados/{id}', 'EmpleadoController@update');
    $router->delete('/empleados/{id}', 'EmpleadoController@destroy');

    $router->get('/estados', 'EstadoController@index');
    $router->post('/estados', 'EstadoController@store');
    $router->get('/estados/{id}', 'EstadoController@show');
    $router->put('/estados/{id}', 'EstadoController@update');
    $router->delete('/estados/{id}', 'EstadoController@destroy');

    $router->get('/prioridades', 'PrioridadController@index');
    $router->post('/prioridades', 'PrioridadController@store');
    $router->get('/prioridades/{id}', 'PrioridadController@show');
    $router->put('/prioridades/{id}', 'PrioridadController@update');
    $router->delete('/prioridades/{id}', 'PrioridadController@destroy');

    $router->get('/tareas', 'TareaController@index');
    $router->post('/tareas', 'TareaController@store');
    $router->get('/tareas/{id}', 'TareaController@show');
    $router->put('/tareas/{id}', 'TareaController@update');
    $router->delete('/tareas/{id}', 'TareaController@destroy');
   
});

