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
Route::view('/', 'index');






Auth::routes();
//Route::get('/home', 'HomeController@index')->name('home');



/*
 * Admin Web Guard Routes
 */
Route::namespace('Admin')->prefix('admin')->group (function () {

    // Admin Auth routes
    Route::name('admin.')->group (function () {
        Route::get('/', 'DashboardController@index');
        Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
        Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
        Route::post('/login', 'Auth\LoginController@login')->name('login.submit');
        Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
    });

    //Administrator routes
    Route::resource('admin', 'AdminController')->except('create','show');
    Route::resource('users', 'UserController')->except('create','show');
    Route::resource('permissions', 'PermissionController')->except('create','show');
    Route::resource('roles', 'RoleController')->except('create','show');
    Route::resource('activityLogs', 'ActivityLogController')->except('create','show','edit','update');

    // Store Management
    Route::prefix('store/')->group (function () {
        Route::get('/manage','StoreController')->name('store.manage');
        Route::resource('itemCategories','ItemCategoryController')->except('create','show');
        Route::resource('items','ItemController')->except('create','show');
        Route::resource('itemUnits','ItemUnitController')->except('create','show');
        Route::resource('itemReceived','ItemReceivedController')->except('show');
        Route::resource('itemIssued','ItemIssuedController')->except('show');
    });

    // Human Resource Management
    Route::prefix('hr/')->group (function () {
        Route::get('/dashboard', function () {return redirect()->route('departments.index');})->name('hr.dashboard');
        Route::resource('departments','DepartmentController')->except('create','show');
        Route::resource('employee','EmployeeController');
    });

    //Location Management
    Route::prefix('location/')->group (function () {
        Route::get('/', function () {return redirect()->route('countries.index');})->name('location');

        Route::post('countries/import', 'CountryController@import')->name('countries.import');
        Route::resource('countries', 'CountryController')->except('create','show');

        Route::post('cities/import', 'CityController@import')->name('cities.import');
        Route::resource('cities', 'CityController')->except('create','show');

        Route::post('districts/import', 'DistrictController@import')->name('districts.import');
        Route::resource('districts', 'DistrictController')->except('create','show');

        Route::post('wards/import', 'WardController@import')->name('wards.import');
        Route::resource('wards', 'WardController')->except('create','show');

        Route::post('streets/import', 'StreetController@import')->name('streets.import');
        Route::resource('streets', 'StreetController')->except('create','show');

        Route::post('venues/import', 'VenueController@import')->name('venues.import');
        Route::resource('venues', 'VenueController')->except('show');
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
});


/*
 * Employee Web Guard Routes
 */
Route::namespace('Employee')->prefix('employee/')->group (function () {

    // Admin Auth routes
    Route::name('employee.')->group (function () {
        Route::get('/', 'DashboardController@index');
        Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
        Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
        Route::post('/login', 'Auth\LoginController@login')->name('login.submit');
       Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
    });

});









