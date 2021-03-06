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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'user'], function() use ($router) {
    
    $router->get('login',[
        'uses' => 'UserController@login',
        'as' => 'user.login'
    ]);

    $router->put('store',[
        'uses' => 'UserController@store',
        'as' => 'user.store',
        'middleware' => 'register'
    ]);

    $router->get('list', [
        'uses' => 'UserController@list',
        'as' => 'user.list',
        'middleware' => ['auth','asAdmin']
    ]);

});

$router->group(['prefix' => 'management'], function() use($router) {

    $router->group(['prefix' => 'user-role'], function() use($router) {
        
        $router->put('add', [
            'uses' => 'Admin\RoleController@addUserRole',
            'as' => 'management.user_role.addUserRole',
            'middleware' => [ 'auth', 'asAdmin']
        ]);

    });

});

$router->group(['prefix' => 'register'], function() use ($router) {
    
    $router->get('confirm',[
        'uses' => 'RegisterController@confirm',
        'as' => 'register.confirm'
    ]);

});
