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

$router->group(['prefix' => 'v2'], function () use ($router) {

	$router->group(['middleware' => 'jwt.auth'], function () use ($router) {

	 # Project
       $router->post('/project', 'ProjectController@create');
       $router->get('/project/{projectId}', 'ProjectController@get');
       $router->get('/project', 'ProjectController@list');

       # Project Team
       $router->post('/project/{projectId}/team/{userId}', 'ProjectTeamController@add');
       $router->get('/project/{projectId}/team', 'ProjectTeamController@list');
       $router->delete('/project/{projectId}/team/{userId}', 'ProjectTeamController@remove');

       # Task
       $router->post('/project/{projectId}/task', 'TaskController@create');
       $router->get('/project/{projectId}/task', 'TaskController@list');
       $router->post('/project/{projectId}/task/{taskId}', 'TaskController@update');

	});


    # User
    $router->post('/user', 'UserController@create');

    # Login
    $router->get('/user/login', 'AuthController@authenticate');

});