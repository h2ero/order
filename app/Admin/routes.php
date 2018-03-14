<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('/user', UserController::class);
    $router->resource('/product', ProductController::class);
    $router->get('/order/stats', 'OrderController@stats');
    $router->resource('/order', OrderController::class);

});
