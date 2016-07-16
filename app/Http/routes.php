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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix'=>'admin', 'as'=>'admin.', 'middleware'=>'auth.checkrole:admin'], function () {

    Route::get('categories',         ['uses'=>'CategoriesController@index',  'as'=>'categories']);
    Route::get('categories/create',  ['uses'=>'CategoriesController@create', 'as'=>'categories.create']);
    Route::post('categories/store',  ['uses'=>'CategoriesController@store', 'as'=>'categories.store']);
    Route::post('categories/update/{id}',  ['uses'=>'CategoriesController@update', 'as'=>'categories.update']);
    Route::get('categories/edit/{id}',  ['uses'=>'CategoriesController@edit', 'as'=>'categories.edit']);

    Route::get('clients',         ['uses'=>'ClientsController@index',  'as'=>'clients']);
    Route::get('clients/create',  ['uses'=>'ClientsController@create', 'as'=>'clients.create']);
    Route::post('clients/store',  ['uses'=>'ClientsController@store', 'as'=>'clients.store']);
    Route::post('clients/update/{id}',  ['uses'=>'ClientsController@update', 'as'=>'clients.update']);
    Route::get('clients/edit/{id}',  ['uses'=>'ClientsController@edit', 'as'=>'clients.edit']);


    Route::get('products',         ['uses'=>'ProductsController@index',  'as'=>'products']);
    Route::get('products/create',  ['uses'=>'ProductsController@create', 'as'=>'products.create']);
    Route::post('products/store',  ['uses'=>'ProductsController@store', 'as'=>'products.store']);
    Route::post('products/update/{id}',  ['uses'=>'ProductsController@update', 'as'=>'admin.products.update']);
    Route::get('products/edit/{id}',  ['uses'=>'ProductsController@edit', 'as'=>'products.edit']);
    Route::get('products/destroy/{id}',  ['uses'=>'ProductsController@destroy', 'as'=>'products.destroy']);

    Route::get('orders',         ['uses'=>'OrdersController@index',  'as'=>'orders']);
    Route::get('orders/{id}',  ['uses'=>'OrdersController@edit', 'as'=>'orders.edit']);
    Route::post('orders/update/{id}',  ['uses'=>'OrdersController@update', 'as'=>'orders.update']);

    Route::get('cupoms',         ['uses'=>'CupomsController@index',  'as'=>'cupoms']);
    Route::get('cupoms/create',  ['uses'=>'CupomsController@create', 'as'=>'cupoms.create']);
    Route::get('cupoms/{id}',  ['uses'=>'CupomsController@edit', 'as'=>'cupoms.edit']);
    Route::post('cupoms/update/{id}',  ['uses'=>'CupomsController@update', 'as'=>'cupoms.update']);
    Route::post('cupoms/store/{id}',  ['uses'=>'CupomsController@store', 'as'=>'cupoms.store']);


});

Route::group(['prefix'=>'customer', 'as'=>'customer.', 'middleware'=>'auth.checkrole:client'], function () {
    Route::get('order', ['uses'=>'CheckoutController@index', 'as'=>'order']);
    Route::get('order/create', ['uses'=>'CheckoutController@create', 'as'=>'order.create']);
    Route::post('order/store', ['uses'=>'CheckoutController@store', 'as'=>'order.store']);

});

Route::group(['prefix'=>'api', 'as'=>'api.', 'middleware'=>'oauth'], function () {
    Route::get('pedidos', function() {
       return ['id' => 1, 'client' => 'luiz carlos', 'total'=>'10,00'];
    });
    Route::get('teste', function() {
        return ['id' => 1, 'client' => 'luiz carlos', 'total'=>'10,00'];
    });
});


Route::post('oauth/access_token', function() {
    return Response::json(Authorizer::issueAccessToken());
});