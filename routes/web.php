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


/*
 * Default Route For the System
 */
//Route::view('/', 'index');
Route::get('/', function () {
    return redirect()->route('admin.dashboard');
});





Auth::routes();
//Route::get('/home', 'HomeController@index')->name('home');

//Admin authentication routes
Route::name('admin.')->prefix('admin')->group (function () {
    //Route::get('/', 'DashboardController@admin')->name('index');
    Route::get('/', 'DashboardController@admin')->name('dashboard');
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('login.submit');
    Route::post('/logout', 'Auth\AdminLoginController@logout')->name('logout');
});
//Employee authentication routes
Route::name('employee.')->prefix('employee')->group (function () {
    Route::get('/', 'DashboardController@employee')->name('dashboard');
    Route::get('/login', 'Auth\EmployeeLoginController@showLoginForm')->name('login');
    Route::post('/login', 'Auth\EmployeeLoginController@login')->name('login.submit');
    Route::post('/logout', 'Auth\EmployeeLoginController@logout')->name('logout');
});

//Administrator routes
Route::prefix('admin')->group (function () {
    Route::get('index', 'AdminController@index')->name('admin.index');
    Route::post('store', 'AdminController@store')->name('admin.store');
    Route::get('edit/{admin}', 'AdminController@edit')->name('admin.edit');
    Route::put('update/{admin}', 'AdminController@update')->name('admin.update');
    Route::delete('delete/{admin}', 'AdminController@edit')->name('admin.destroy');
    Route::get('admin/reset/password/{id}', 'AdminController@resetPasswordForm')->name('admin.resetPasswordForm');
    Route::put('admin/reset/password/{id}', 'AdminController@reset_password')->name('admin.resetPassword');
});

//Users management routes
Route::prefix('users')->group (function () {
    Route::get('index', 'UserController@index')->name('users.index');
    Route::post('store', 'UserController@store')->name('users.store');
    Route::get('edit/{user}', 'UserController@edit')->name('users.edit');
    Route::put('update/{user}', 'UserController@update')->name('users.update');
    Route::delete('delete/{user}', 'UserController@edit')->name('users.destroy');
});

//User permissions routes
Route::prefix('permissions')->group (function () {
    Route::get('/', 'PermissionController@index')->name('permissions.index');
    Route::post('store', 'PermissionController@store')->name('permissions.store');
    Route::get('edit/{permission}', 'PermissionController@edit')->name('permissions.edit');
    Route::put('update/{permission}', 'PermissionController@update')->name('permissions.update');
    Route::delete('delete/{permission}', 'PermissionController@edit')->name('permissions.destroy');
});

//User roles routes
Route::prefix('roles')->group (function () {
    Route::get('/', 'RoleController@index')->name('roles.index');
    Route::post('store', 'RoleController@store')->name('roles.store');
    Route::get('edit/{role}', 'RoleController@edit')->name('roles.edit');
    Route::put('update/{role}', 'RoleController@update')->name('roles.update');
    Route::delete('delete/{role}', 'RoleController@edit')->name('roles.destroy');
});

//System users activity logs routes
Route::prefix('activity/logs')->group (function () {
    Route::get('/', 'ActivityLogController@index')->name('activityLogs.index');
});


/*
 * Store Management System
 */
Route::prefix('store/')->group (function () {
    Route::get('/dashboard','DashboardController@store')->name('store.dashboard');

    //Item Categories routes
    Route::prefix('item/categories')->group (function () {
        Route::get('/', 'ItemCategoryController@index')->name('itemCategories.index');
        Route::post('store', 'ItemCategoryController@store')->name('itemCategories.store');
        Route::get('edit/{id}', 'ItemCategoryController@edit')->name('itemCategories.edit');
        Route::put('update/{id}', 'ItemCategoryController@update')->name('itemCategories.update');
        Route::delete('delete/{id}', 'ItemCategoryController@edit')->name('itemCategories.destroy');
    });
    //Items routes
    Route::prefix('items')->group (function () {
        Route::get('/', 'ItemController@index')->name('items.index');
        Route::post('store', 'ItemController@store')->name('items.store');
        Route::get('edit/{id}', 'ItemController@edit')->name('items.edit');
        Route::put('update/{id}', 'ItemController@update')->name('items.update');
        Route::delete('delete/{id}', 'ItemCController@edit')->name('items.destroy');
        Route::post('items/import', 'ItemController@import')->name('items.import');
    });

    //Item Units routes
    Route::prefix('item/units')->group (function () {
        Route::get('/', 'ItemUnitController@index')->name('itemUnits.index');
        Route::post('store', 'ItemUnitController@store')->name('itemUnits.store');
        Route::get('edit/{id}', 'ItemUnitController@edit')->name('itemUnits.edit');
        Route::put('update/{id}', 'ItemUnitController@update')->name('itemUnits.update');
        Route::delete('delete/{id}', 'ItemUnitController@edit')->name('itemUnits.destroy');
    });

    //Received Items routes
    Route::prefix('received/items')->group (function () {
        Route::get('/', 'ItemReceivedController@index')->name('itemReceived.index');
        Route::get('create', 'ItemReceivedController@create')->name('itemReceived.create');
        Route::post('store', 'ItemReceivedController@store')->name('itemReceived.store');
        Route::get('edit/{id}', 'ItemReceivedController@edit')->name('itemReceived.edit');
        Route::put('update/{id}', 'ItemReceivedController@update')->name('itemReceived.update');
        Route::delete('delete/{id}', 'ItemReceivedController@edit')->name('itemReceived.destroy');
    });

    //Received Items routes
    Route::prefix('item/requests')->group (function () {
        Route::get('/', 'ItemRequestController@index')->name('itemRequests.index');
        Route::get('create', 'ItemRequestController@create')->name('itemRequests.create');
        Route::post('store', 'ItemRequestController@store')->name('itemRequests.store');
        Route::get('edit/{id}', 'ItemRequestController@edit')->name('itemRequests.edit');
        Route::put('update/{id}', 'ItemRequestController@update')->name('itemRequests.update');
        Route::delete('delete/{id}', 'ItemRequestController@edit')->name('itemRequests.destroy');
        Route::get('issued', 'ItemRequestController@itemIssued')->name('itemRequests.issued');
    });
});

/*
 * Location Management System
 */
Route::prefix('location/')->group (function () {

    Route::get('/','DashboardController@location')->name('location');

    //Countries routes
    Route::prefix('countries/')->group (function () {
        Route::get('/', 'CountryController@index')->name('countries.index');
        Route::post('store', 'CountryController@store')->name('countries.store');
        Route::get('edit/{id}', 'CountryController@edit')->name('countries.edit');
        Route::put('update/{id}', 'CountryController@update')->name('countries.update');
        Route::delete('delete/{id}', 'CountryController@edit')->name('countries.destroy');
        Route::post('countries/import', 'CountryController@import')->name('countries.import');
    });

    //Cities routes
    Route::prefix('cities/')->group (function () {
        Route::get('/', 'CityController@index')->name('cities.index');
        Route::post('store', 'CityController@store')->name('cities.store');
        Route::get('edit/{id}', 'CityController@edit')->name('cities.edit');
        Route::put('update/{id}', 'CityController@update')->name('cities.update');
        Route::delete('delete/{id}', 'CityController@edit')->name('cities.destroy');
        Route::post('cities/import', 'CityController@import')->name('cities.import');
    });

    //Districts routes
    Route::prefix('districts/')->group (function () {
        Route::get('/', 'DistrictController@index')->name('districts.index');
        Route::post('store', 'DistrictController@store')->name('districts.store');
        Route::get('edit/{id}', 'DistrictController@edit')->name('districts.edit');
        Route::put('update/{id}', 'DistrictController@update')->name('districts.update');
        Route::delete('delete/{id}', 'DistrictController@edit')->name('districts.destroy');
        Route::post('districts/import', 'DistrictController@import')->name('districts.import');
    });

    //Wards routes
    Route::prefix('wards/')->group (function () {
        Route::get('/', 'WardController@index')->name('wards.index');
        Route::post('store', 'WardController@store')->name('wards.store');
        Route::get('edit/{id}', 'WardController@edit')->name('wards.edit');
        Route::put('update/{id}', 'WardController@update')->name('wards.update');
        Route::delete('delete/{id}', 'WardController@edit')->name('wards.destroy');
        Route::post('wards/import', 'WardController@import')->name('wards.import');
    });

    //Streets routes
    Route::prefix('streets/')->group (function () {
        Route::get('/', 'StreetController@index')->name('streets.index');
        Route::post('store', 'StreetController@store')->name('streets.store');
        Route::get('edit/{id}', 'StreetController@edit')->name('streets.edit');
        Route::put('update/{id}', 'StreetController@update')->name('streets.update');
        Route::delete('delete/{id}', 'StreetController@edit')->name('streets.destroy');
        Route::post('streets/import', 'StreetController@import')->name('streets.import');
    });

    //Venues routes
    Route::prefix('venues/')->group (function () {
        Route::get('/', 'VenueController@index')->name('venues.index');
        Route::get('create', 'VenueController@create')->name('venues.create');
        Route::post('store', 'VenueController@store')->name('venues.store');
        Route::get('edit/{id}', 'VenueController@edit')->name('venues.edit');
        Route::put('update/{id}', 'VenueController@update')->name('venues.update');
        Route::delete('delete/{id}', 'VenueController@edit')->name('venues.destroy');
        Route::post('venues/import', 'VenueController@import')->name('venues.import');
    });

});



/*
 * Admin Web Guard Routes
 */
Route::namespace('Admin')->prefix('admin')->group (function () {

        // Human Resource Management
        Route::prefix('hr/')->group (function () {
            Route::get('/dashboard', function () {return redirect()->route('departments.index');})->name('hr.dashboard');
            Route::resource('departments','DepartmentController')->except('create','show');
            Route::resource('employee','EmployeeController');
            Route::resource('designations','DesignationController');
            Route::resource('employmentTypes','EmploymentTypeController');
            Route::resource('employmentHistories','EmploymentHistoryController')->except('show','create');
        });


    });

    // Organization Management
    Route::prefix('organization/')->group (function () {
        //Route::post('import', 'OrganizationController@import')->name('organizations.import');
        Route::resource('categories', 'OrganizationCategoryController')->except('create','show');
        Route::resource('sectors', 'SectorController')->except('create','show');
        Route::resource('sector/fields', 'FieldController')->except('create','show');
    });

    Route::post('import', 'OrganizationController@import')->name('organizations.import');
    Route::resource('organizations', 'OrganizationController');

    // Individual Data Management
    Route::prefix('individual/')->group (function () {
        Route::resource('educationLevels', 'EducationLevelController')->except('create','show');
        Route::resource('positions', 'PositionController')->except('show');
        Route::resource('groups', 'GroupController')->except('create','show');
        Route::post('titles/import', 'TitleController@import')->name('titles.import');
        Route::resource('titles', 'TitleController')->except('create','show');
    });

    Route::post('individuals/import', 'IndividualController@import')->name('individuals.import');
    Route::resource('individuals', 'IndividualController');

    //Event Management System
    Route::resource('eventCategories', 'EventCategoryController')->except('create','show');
    Route::resource('events', 'EventController');

    Route::prefix('event/')->group (function () {
        //Route::get('GDSS/participants/create/{gender}','GenderSeriesController@participant_create')->name('gender.participants.create');
        Route::resource('genderSeries', 'GenderSeriesController');

        Route::resource('participantRoles', 'ParticipantRoleController')->except('create','show');

        Route::post('GenderSeriesParticipant/import', 'GenderSeriesParticipantController@import')->name('genderSeriesParticipants.import');
        Route::resource('genderSeriesParticipants', 'GenderSeriesParticipantController');

        Route::resource('participants', 'ParticipantController');
    });


/*
 * Employee Web Guard Routes
 */
Route::namespace('Employee')->prefix('employee/')->name('employee.')->group (function () {

       //Item Store Request
        Route::resource('itemRequests', 'ItemRequestController')->except('create,show');

        //Events Management Routes
        Route::resource('eventCategories', 'EventCategoryController')->except('create','show','destroy');
        Route::resource('events', 'EventController')->except('show','destroy');

});









