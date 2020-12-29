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
    return view('login');
});

Route::get('/login', 'SessionsController@create');
Route::post('/login', 'SessionsController@store');

Route::get('/register', 'RegistrationController@create');
Route::post('/register', 'RegistrationController@store');

Route::group(['middleware'=>'roles','roles'=>['admin']], function(){
    Route::get('/home/users', 'pagesController@getUsers');

    Route::get('/home/createcategory', 'pagesController@createCategory');
    Route::post('/home/storecategory', 'pagesController@storeCategory');
    Route::get('/home/categories', 'pagesController@getCategories');
    Route::get('/home/editecategory/{id}', 'pagesController@editecategory');
    Route::post('/home/editecategory/{id}', 'pagesController@updatecategory');
    Route::get('/home/deletecategory/{id}', 'pagesController@deletecategory');

    Route::get('/home/createserials', 'pagesController@createSerials');
    Route::post('/home/storeserials', 'pagesController@storeSerials');
    Route::get('/home/serials', 'pagesController@getSerials');
    Route::post('/home/serials', 'pagesController@getSerials');
    Route::get('/home/deleteserial/{id}', 'pagesController@deleteSerial');
    
    // Route for view/blade file.
    Route::get('importExport', 'MaatwebsiteController@importExport');
    // Route for export/download tabledata to .csv, .xls or .xlsx
    Route::get('downloadExcel/{type}', 'MaatwebsiteController@downloadExcel');
    // Route for import excel data to database.
    Route::post('importExcel', 'MaatwebsiteController@importExcel');
    
    
    Route::post('/addrole', 'pagesController@addRole');

    Route::get('/home/addbalance/{id}', 'RegistrationController@editeBalance');
    Route::post('/home/addbalance/{id}', 'RegistrationController@updateBalance');

    Route::get('/home/editeuser/{id}', 'RegistrationController@edite');
    Route::post('/home/editeuser/{id}', 'RegistrationController@update');

    Route::get('/home/deleteuser/{id}', 'RegistrationController@delete');
    
});

Route::group(['middleware'=>'roles','roles'=>['admin','user']], function(){

    Route::get('/home', 'pagesController@home')->name('home');
    Route::get('/home/category:{category}', 'pagesController@showcategory');
       
    Route::post('/home/{category}/sendserial', 'serialController@sendSerial');
    
    Route::get('/logout', 'SessionsController@destroy');

    Route::get('/home/report:{sort}', 'pagesController@getReport');
    Route::post('/home/report:{sort}', 'pagesController@getReport');
   

});

/* Rout::get('home',[
    'uses'=>'pagesController@home',
    'as'=>'pages.home',
    'middleware'=>'roles',
    'roles'=>['admin','user']
]); */
