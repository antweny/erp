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
     * Human Resource and Administration
     */
    Route::resource('departments','DepartmentController')->except('create','show');




    /*
     * Store Management
     */
    Route::get('/store/manage', function () {
        return redirect()->route('items.index');
    })->name('store.manage');
    Route::resource('items','ItemController')->except('create','show');
    Route::resource('itemUnits','ItemUnitController')->except('create','show');
    Route::resource('itemReceived','ItemReceivedController')->except('show');
    Route::resource('itemIssued','ItemIssuedController')->except('show');



});

/*
 * Human Resource Management
 */
Route::prefix('hr/')->namespace('Admin')->group (function () {

    Route::get('/dashboard', function () {
        return redirect()->route('departments.index');
    })->name('hr.dashboard');

    Route::resource('employee','EmployeeController');

});



Route::resource('itemCategories','ItemCategoryController')->except('create','show');


