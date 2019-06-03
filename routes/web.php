<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

route::get('fetch', 'RequestController@make_request');

route::post('make-it', 'RequestController@add');

route::post('edit-it', 'RequestController@edit');

route::post('del-it', 'RequestController@delete');

route::get('pincode', function(){
    return view('pincode');
});

route::get('paginate', 'PaginateController@index');
route::post('pasginate-insert', 'PaginateController@insert');
route::get('/read', 'PaginateController@read');
