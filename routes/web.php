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
    return redirect()->route('admin.dashboard');
});


Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');


/**
 * Admin Auth routes
 */
Route::namespace('Admin')->prefix('admin')->name('admin.')->group (function () {
    Route::get('/', 'DashboardController@index');
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('/login', 'Auth\LoginController@login')->name('login.submit');
    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

});


/**
 * Administrator routes
 */
Route::namespace('Admin')->group (function () {
    Route::resource('admin', 'AdminController')->except('create','show');
    Route::resource('users', 'UserController')->except('create','show');
    Route::resource('permissions', 'PermissionController')->except('create','show');
    Route::resource('roles', 'RoleController')->except('create','show');
    Route::resource('activityLogs', 'ActivityLogController')->except('create','show','edit','update');



    /*
     * Store Management
     */
    Route::get('/store/manage','StoreController')->name('store.manage');
    Route::resource('items','ItemController')->except('create','show');
    Route::resource('itemUnits','ItemUnitController')->except('create','show');
    Route::resource('itemReceived','ItemReceivedController')->except('show');
    Route::resource('itemIssued','ItemIssuedController')->except('show');
    //Route::resource('itemRequest','ItemRequestController')->except('show');


});

/*
 * Human Resource Management
 */
Route::prefix('hr/')->namespace('Admin')->group (function () {
    Route::get('/dashboard', function () {
        return redirect()->route('departments.index');
    })->name('hr.dashboard');

    Route::resource('departments','DepartmentController')->except('create','show');

    Route::resource('employee','EmployeeController');
});


/*
 * Location Management
 */
Route::prefix('location/')->namespace('Admin')->group (function () {

    Route::get('/', function () {
        return redirect()->route('countries.index');
    })->name('location');

    Route::post('countries/import', 'CountryController@import')->name('countries.import');
    Route::resource('countries', 'CountryController')->except('create','show');

    Route::post('cities/import', 'CityController@import')->name('cities.import');
    Route::resource('cities', 'CityController')->except('create','show');
});




Route::resource('itemCategories','ItemCategoryController')->except('create','show');


