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


/*
 * Store Management System
 */
Route::prefix('store/')->group (function () {
    Route::get('/','DashboardController@store')->name('store');

    //Item Categories routes
    Route::prefix('item/categories')->group (function () {
        Route::get('/', 'ItemCategoryController@index')->name('itemCategories.index');
        Route::post('store', 'ItemCategoryController@store')->name('itemCategories.store');
        Route::get('edit/{id}', 'ItemCategoryController@edit')->name('itemCategories.edit');
        Route::put('update/{id}', 'ItemCategoryController@update')->name('itemCategories.update');
        Route::delete('delete/{id}', 'ItemCategoryController@destroy')->name('itemCategories.destroy');
    });
    //Items routes
    Route::prefix('items')->group (function () {
        Route::get('/', 'ItemController@index')->name('items.index');
        Route::post('store', 'ItemController@store')->name('items.store');
        Route::get('edit/{id}', 'ItemController@edit')->name('items.edit');
        Route::put('update/{id}', 'ItemController@update')->name('items.update');
        Route::delete('delete/{id}', 'ItemCController@destroy')->name('items.destroy');
        Route::post('items/import', 'ItemController@import')->name('items.import');
    });

    //Item Units routes
    Route::prefix('item/units')->group (function () {
        Route::get('/', 'ItemUnitController@index')->name('itemUnits.index');
        Route::post('store', 'ItemUnitController@store')->name('itemUnits.store');
        Route::get('edit/{id}', 'ItemUnitController@edit')->name('itemUnits.edit');
        Route::put('update/{id}', 'ItemUnitController@update')->name('itemUnits.update');
        Route::delete('delete/{id}', 'ItemUnitController@destroy')->name('itemUnits.destroy');
    });

    //Received Items routes
    Route::prefix('received/items')->group (function () {
        Route::get('/', 'ItemReceivedController@index')->name('itemReceived.index');
        Route::get('create', 'ItemReceivedController@create')->name('itemReceived.create');
        Route::post('store', 'ItemReceivedController@store')->name('itemReceived.store');
        Route::get('edit/{id}', 'ItemReceivedController@edit')->name('itemReceived.edit');
        Route::put('update/{id}', 'ItemReceivedController@update')->name('itemReceived.update');
        Route::delete('delete/{id}', 'ItemReceivedController@destroy')->name('itemReceived.destroy');
    });

    //Received Items routes
    Route::prefix('item/requests')->group (function () {
        Route::get('/', 'ItemRequestController@index')->name('itemRequests.index');
        Route::get('create', 'ItemRequestController@create')->name('itemRequests.create');
        Route::post('store', 'ItemRequestController@store')->name('itemRequests.store');
        Route::get('edit/{id}', 'ItemRequestController@edit')->name('itemRequests.edit');
        Route::put('update/{id}', 'ItemRequestController@update')->name('itemRequests.update');
        Route::delete('delete/{id}', 'ItemRequestController@destroy')->name('itemRequests.destroy');
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
        Route::delete('delete/{id}', 'CountryController@destroy')->name('countries.destroy');
        Route::post('countries/import', 'CountryController@import')->name('countries.import');
    });

    //Cities routes
    Route::prefix('cities/')->group (function () {
        Route::get('/', 'CityController@index')->name('cities.index');
        Route::post('store', 'CityController@store')->name('cities.store');
        Route::get('edit/{id}', 'CityController@edit')->name('cities.edit');
        Route::put('update/{id}', 'CityController@update')->name('cities.update');
        Route::delete('delete/{id}', 'CityController@destroy')->name('cities.destroy');
        Route::post('cities/import', 'CityController@import')->name('cities.import');
    });

    //Districts routes
    Route::prefix('districts/')->group (function () {
        Route::get('/', 'DistrictController@index')->name('districts.index');
        Route::post('store', 'DistrictController@store')->name('districts.store');
        Route::get('edit/{id}', 'DistrictController@edit')->name('districts.edit');
        Route::put('update/{id}', 'DistrictController@update')->name('districts.update');
        Route::delete('delete/{id}', 'DistrictController@destroy')->name('districts.destroy');
        Route::post('districts/import', 'DistrictController@import')->name('districts.import');
    });

    //Wards routes
    Route::prefix('wards/')->group (function () {
        Route::get('/', 'WardController@index')->name('wards.index');
        Route::post('store', 'WardController@store')->name('wards.store');
        Route::get('edit/{id}', 'WardController@edit')->name('wards.edit');
        Route::put('update/{id}', 'WardController@update')->name('wards.update');
        Route::delete('delete/{id}', 'WardController@destroy')->name('wards.destroy');
        Route::post('wards/import', 'WardController@import')->name('wards.import');
    });

    //Streets routes
    Route::prefix('streets/')->group (function () {
        Route::get('/', 'StreetController@index')->name('streets.index');
        Route::post('store', 'StreetController@store')->name('streets.store');
        Route::get('edit/{id}', 'StreetController@edit')->name('streets.edit');
        Route::put('update/{id}', 'StreetController@update')->name('streets.update');
        Route::delete('delete/{id}', 'StreetController@destroy')->name('streets.destroy');
        Route::post('streets/import', 'StreetController@import')->name('streets.import');
    });

    //Venues routes
    Route::prefix('venues/')->group (function () {
        Route::get('/', 'VenueController@index')->name('venues.index');
        Route::get('create', 'VenueController@create')->name('venues.create');
        Route::post('store', 'VenueController@store')->name('venues.store');
        Route::get('edit/{id}', 'VenueController@edit')->name('venues.edit');
        Route::put('update/{id}', 'VenueController@update')->name('venues.update');
        Route::delete('delete/{id}', 'VenueController@destroy')->name('venues.destroy');
        Route::post('venues/import', 'VenueController@import')->name('venues.import');
    });

});


/*
 * Events Management System
 */
Route::prefix('events/')->group(function () {

    //Events Routes
    Route::get('/','DashboardController@event')->name('event');

    //Event categories routes
    Route::prefix('categories/')->group(function () {
        Route::get('/', 'EventCategoryController@index')->name('eventCategories.index');
        Route::post('store', 'EventCategoryController@store')->name('eventCategories.store');
        Route::get('edit/{id}', 'EventCategoryController@edit')->name('eventCategories.edit');
        Route::put('update/{id}', 'EventCategoryController@update')->name('eventCategories.update');
        Route::delete('delete/{id}', 'EventCategoryController@destroy')->name('eventCategories.destroy');
    });

    // Events routes
    Route::get('index', 'EventController@index')->name('events.index');
    Route::get('create', 'EventController@create')->name('events.create');
    Route::post('store', 'EventController@store')->name('events.store');
    Route::get('edit/{id}', 'EventController@edit')->name('events.edit');
    Route::put('update/{id}', 'EventController@update')->name('events.update');
    Route::delete('delete/{id}', 'EventController@destroy')->name('events.destroy');

    // Gender series topics (GDSS) routes
    Route::prefix('GDSS/')->group(function () {
        Route::get('/', 'GenderSeriesController@index')->name('genderSeries.index');
        Route::get('create', 'GenderSeriesController@create')->name('genderSeries.create');
        Route::post('store', 'GenderSeriesController@store')->name('genderSeries.store');
        Route::get('edit/{id}', 'GenderSeriesController@edit')->name('genderSeries.edit');
        Route::put('update/{id}', 'GenderSeriesController@update')->name('genderSeries.update');
        Route::delete('delete/{id}', 'GenderSeriesController@destroy')->name('genderSeries.destroy');
    });

    // Gender series topics (GDSS) participants routes
    Route::prefix('GDSS/participants/')->group(function () {
        Route::get('/', 'GenderSeriesParticipantController@index')->name('genderSeriesParticipants.index');
        Route::get('create', 'GenderSeriesParticipantController@create')->name('genderSeriesParticipants.create');
        Route::post('store', 'GenderSeriesParticipantController@store')->name('genderSeriesParticipants.store');
        Route::get('edit/{id}', 'GenderSeriesParticipantController@edit')->name('genderSeriesParticipants.edit');
        Route::put('update/{id}', 'GenderSeriesParticipantController@update')->name('genderSeriesParticipants.update');
        Route::delete('delete/{id}', 'GenderSeriesParticipantController@destroy')->name('genderSeriesParticipants.destroy');
    });

    // Event participant Roles routes
    Route::prefix('participant/roles/')->group(function () {
        Route::get('/', 'ParticipantRoleController@index')->name('participantRoles.index');
        Route::post('store', 'ParticipantRoleController@store')->name('participantRoles.store');
        Route::get('edit/{id}', 'ParticipantRoleController@edit')->name('participantRoles.edit');
        Route::put('update/{id}', 'ParticipantRoleController@update')->name('participantRoles.update');
        Route::delete('delete/{id}', 'ParticipantRoleController@destroy')->name('participantRoles.destroy');
        Route::post('GenderSeriesParticipant/import', 'GenderSeriesParticipantController@import')->name('genderSeriesParticipants.import');
    });

    // Event participants routes
    Route::prefix('participants/')->group(function () {
        Route::get('/', 'ParticipantController@index')->name('participants.index');
        Route::get('create', 'ParticipantController@create')->name('participants.create');
        Route::post('store', 'ParticipantController@store')->name('participants.store');
        Route::get('edit/{id}', 'ParticipantController@edit')->name('participants.edit');
        Route::put('update/{id}', 'ParticipantController@update')->name('participants.update');
        Route::delete('delete/{id}', 'ParticipantController@destroy')->name('participants.destroy');
    });
    
});

/*
 * Human Resource Management
 */
Route::prefix('hr/')->group (function () {
    //Events Routes
    Route::get('/','DashboardController@hrm')->name('hrm');

    // Departments routes
    Route::prefix('departments/')->group(function () {
        Route::get('/', 'DepartmentController@index')->name('departments.index');
        Route::post('store', 'DepartmentController@store')->name('departments.store');
        Route::get('edit/{id}', 'DepartmentController@edit')->name('departments.edit');
        Route::put('update/{id}', 'DepartmentController@update')->name('departments.update');
        Route::delete('delete/{id}', 'DepartmentController@destroy')->name('departments.destroy');
    });

    // Designations routes
    Route::prefix('designations/')->group(function () {
        Route::get('/', 'DesignationController@index')->name('designations.index');
        Route::post('store', 'DesignationController@store')->name('designations.store');
        Route::get('edit/{id}', 'DesignationController@edit')->name('designations.edit');
        Route::put('update/{id}', 'DesignationController@update')->name('designations.update');
        Route::delete('delete/{id}', 'DesignationController@destroy')->name('designations.destroy');
    });

    // Designations routes
    Route::prefix('job/types')->group(function () {
        Route::get('/', 'JobTypeController@index')->name('jobTypes.index');
        Route::post('store', 'JobTypeController@store')->name('jobTypes.store');
        Route::get('edit/{id}', 'JobTypeController@edit')->name('jobTypes.edit');
        Route::put('update/{id}', 'JobTypeController@update')->name('jobTypes.update');
        Route::delete('delete/{id}', 'JobTypeController@destroy')->name('jobTypes.destroy');
    });

    // Event participants routes
    Route::prefix('employee/')->group(function () {
        Route::get('/', 'EmployeeController@index')->name('employee.index');
        Route::get('create', 'EmployeeController@create')->name('employee.create');
        Route::post('store', 'EmployeeController@store')->name('employee.store');
        Route::get('edit/{id}', 'EmployeeController@edit')->name('employee.edit');
        Route::put('update/{id}', 'EmployeeController@update')->name('employee.update');
        Route::delete('delete/{id}', 'EmployeeController@destroy')->name('employee.destroy');
    });

    // Designations routes
    Route::prefix('job/histories')->group(function () {
        Route::get('/', 'JobHistoryController@index')->name('jobHistories.index');
        Route::post('store', 'JobHistoryController@store')->name('jobHistories.store');
        Route::get('edit/{id}', 'JobHistoryController@edit')->name('jobHistories.edit');
        Route::put('update/{id}', 'JobHistoryController@update')->name('jobHistories.update');
        Route::delete('delete/{id}', 'JobHistoryController@destroy')->name('jobHistories.destroy');
    });

});


/*
 * System Settings routes
 */
Route::prefix('setting/')->group(function () {
    //Events Routes
    Route::get('/','DashboardController@setting')->name('settings');

    Route::prefix('activity/logs')->group (function () {
        Route::get('/', 'ActivityLogController@index')->name('activityLogs.index');
    });
});


/*
 * System Security routes
 */
Route::prefix('security/')->group(function () {
    //Events Routes
    Route::get('/','DashboardController@security')->name('security');

    //Administrator routes
    Route::prefix('admin')->group (function () {
        Route::get('index', 'AdminController@index')->name('admin.index');
        Route::post('store', 'AdminController@store')->name('admin.store');
        Route::get('edit/{admin}', 'AdminController@edit')->name('admin.edit');
        Route::put('update/{admin}', 'AdminController@update')->name('admin.update');
        Route::delete('delete/{admin}', 'AdminController@destroy')->name('admin.destroy');
        Route::get('reset/password/{id}', 'AdminController@resetPasswordForm')->name('admin.resetPasswordForm');
        Route::put('reset/password/{id}', 'AdminController@reset_password')->name('admin.resetPassword');
    });

    //Users management routes
    Route::prefix('users')->group (function () {
        Route::get('index', 'UserController@index')->name('users.index');
        Route::post('store', 'UserController@store')->name('users.store');
        Route::get('edit/{user}', 'UserController@edit')->name('users.edit');
        Route::put('update/{user}', 'UserController@update')->name('users.update');
        Route::delete('delete/{user}', 'UserController@destroy')->name('users.destroy');
    });

    //Employee Login management routes
    Route::prefix('employee')->group (function () {
        Route::get('login/index', 'EmployeeController@employeeLogin')->name('employeeLogin');
        Route::get('reset/password/{id}', 'EmployeeController@resetPasswordForm')->name('employee.resetPasswordForm');
        Route::put('reset/password/{id}', 'EmployeeController@reset_password')->name('employee.resetPassword');
    });

    //Permissions routes
    Route::prefix('permissions')->group (function () {
        Route::get('/', 'PermissionController@index')->name('permissions.index');
        Route::post('store', 'PermissionController@store')->name('permissions.store');
        Route::get('edit/{permission}', 'PermissionController@edit')->name('permissions.edit');
        Route::put('update/{permission}', 'PermissionController@update')->name('permissions.update');
        Route::delete('delete/{permission}', 'PermissionController@destroy')->name('permissions.destroy');
    });

    //Roles routes
    Route::prefix('roles')->group (function () {
        Route::get('/', 'RoleController@index')->name('roles.index');
        Route::post('store', 'RoleController@store')->name('roles.store');
        Route::get('edit/{role}', 'RoleController@edit')->name('roles.edit');
        Route::put('update/{role}', 'RoleController@update')->name('roles.update');
        Route::delete('delete/{role}', 'RoleController@destroy')->name('roles.destroy');
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









