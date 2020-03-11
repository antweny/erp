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
        Route::get('participant/create/{id}', 'GenderSeriesController@participant_form')->name('genderSeries.participants');
    });

    // Gender series topics (GDSS) participants routes
    Route::prefix('GDSS/participants/')->group(function () {
        Route::get('/', 'GenderSeriesParticipantController@index')->name('genderSeriesParticipants.index');
        Route::get('create', 'GenderSeriesParticipantController@create')->name('genderSeriesParticipants.create');
        Route::post('store', 'GenderSeriesParticipantController@store')->name('genderSeriesParticipants.store');
        Route::get('show/{id}', 'GenderSeriesParticipantController@show')->name('genderSeriesParticipants.show');
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
    //Security default
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
        Route::get('role/{id}', 'EmployeeController@update_employee_roles_form')->name('employee.rolesUpdate');
        Route::put('role/{id}', 'EmployeeController@update_employee_roles')->name('employee.updating_roles');
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


/*
 * Individual Management Routes
 */
Route::prefix('individual')->group(function (){

    //Individual default
    Route::get('/','IndividualDashboardController@index')->name('individual');
    Route::get('index', 'IndividualController@index')->name('individuals.index');
    Route::get('create', 'IndividualController@create')->name('individuals.create');
    Route::post('store', 'IndividualController@store')->name('individuals.store');
    Route::get('edit/{id}', 'IndividualController@edit')->name('individuals.edit');
    Route::put('update/{id}', 'IndividualController@update')->name('individuals.update');
    Route::delete('delete/{id}', 'IndividualController@destroy')->name('individuals.destroy');
    Route::post('import', 'IndividualController@import')->name('individuals.import');


    //Education Levels routes
    Route::prefix('education/level')->group (function () {
        Route::get('/', 'EducationLevelController@index')->name('educationLevels.index');
        Route::post('store', 'EducationLevelController@store')->name('educationLevels.store');
        Route::get('edit/{id}', 'EducationLevelController@edit')->name('educationLevels.edit');
        Route::put('update/{id}', 'EducationLevelController@update')->name('educationLevels.update');
        Route::delete('delete/{id}', 'EducationLevelController@destroy')->name('educationLevels.destroy');
    });

    //Position Titles  routes
    Route::prefix('position/titles')->group (function () {
        Route::get('/', 'TitleController@index')->name('titles.index');
        Route::post('store', 'TitleController@store')->name('titles.store');
        Route::get('edit/{id}', 'TitleController@edit')->name('titles.edit');
        Route::put('update/{id}', 'TitleController@update')->name('titles.update');
        Route::delete('delete/{id}', 'TitleController@destroy')->name('titles.destroy');
        Route::post('titles/import', 'TitleController@import')->name('titles.import');
    });
    
    //Individual Groups routes
    Route::prefix('groups')->group (function () {
        Route::get('/', 'GroupController@index')->name('groups.index');
        Route::post('store', 'GroupController@store')->name('groups.store');
        Route::get('edit/{id}', 'GroupController@edit')->name('groups.edit');
        Route::put('update/{id}', 'GroupController@update')->name('groups.update');
        Route::delete('delete/{id}', 'GroupController@destroy')->name('groups.destroy');
    });

    //Positions routes
    Route::prefix('positions')->group (function () {
        Route::get('/', 'PositionController@index')->name('positions.index');
        Route::get('create', 'PositionController@create')->name('positions.create');
        Route::post('store', 'PositionController@store')->name('positions.store');
        Route::get('edit/{id}', 'PositionController@edit')->name('positions.edit');
        Route::put('update/{id}', 'PositionController@update')->name('positions.update');
        Route::delete('delete/{id}', 'PositionController@destroy')->name('positions.destroy');
        Route::post('positions/import', 'PositionController@import')->name('positions.import');
    });

    

});

/*
 * Organizations Management
 */
Route::prefix('organization/')->group (function () {
    //Organization default
    Route::get('/','DashboardController@organization')->name('organization');

    Route::get('index', 'OrganizationController@index')->name('organizations.index');
    Route::get('create', 'OrganizationController@create')->name('organizations.create');
    Route::post('store', 'OrganizationController@store')->name('organizations.store');
    Route::get('edit/{id}', 'OrganizationController@edit')->name('organizations.edit');
    Route::put('update/{id}', 'OrganizationController@update')->name('organizations.update');
    Route::delete('delete/{id}', 'OrganizationController@destroy')->name('organizations.destroy');
    Route::post('import', 'OrganizationController@import')->name('organizations.import');

    //Organization Categories Routes
    Route::prefix('categories')->group (function () {
        Route::get('/', 'OrganizationCategoryController@index')->name('categories.index');
        Route::post('store', 'OrganizationCategoryController@store')->name('categories.store');
        Route::get('edit/{id}', 'OrganizationCategoryController@edit')->name('categories.edit');
        Route::put('update/{id}', 'OrganizationCategoryController@update')->name('categories.update');
        Route::delete('delete/{id}', 'OrganizationCategoryController@destroy')->name('categories.destroy');
    });

    //Organization Sectors
    Route::prefix('sectors')->group (function () {
        Route::get('/', 'SectorController@index')->name('sectors.index');
        Route::post('store', 'SectorController@store')->name('sectors.store');
        Route::get('edit/{id}', 'SectorController@edit')->name('sectors.edit');
        Route::put('update/{id}', 'SectorController@update')->name('sectors.update');
        Route::delete('delete/{id}', 'SectorController@destroy')->name('sectors.destroy');
    });

    //Organization Sector Fields
    Route::prefix('sector/fields')->group (function () {
        Route::get('/', 'FieldController@index')->name('fields.index');
        Route::post('store', 'FieldController@store')->name('fields.store');
        Route::get('edit/{id}', 'FieldController@edit')->name('fields.edit');
        Route::put('update/{id}', 'FieldController@update')->name('fields.update');
        Route::delete('delete/{id}', 'FieldController@destroy')->name('fields.destroy');
    });
    
});

/*
 * Support Management System
 */
Route::prefix('support/')->group (function () {
    //Organization default
    Route::get('/','DashboardController@support')->name('supports');

//Organization Sector Fields
    Route::prefix('ticket/categories')->group (function () {
        Route::get('/', 'TicketCategoryController@index')->name('ticketCategories.index');
        Route::post('store', 'TicketCategoryController@store')->name('ticketCategories.store');
        Route::get('edit/{id}', 'TicketCategoryController@edit')->name('ticketCategories.edit');
        Route::put('update/{id}', 'TicketCategoryController@update')->name('ticketCategories.update');
        Route::delete('delete/{id}', 'TicketCategoryController@destroy')->name('ticketCategories.destroy');
    });

    Route::prefix('ticket/')->group (function () {
        Route::get('/', 'TicketController@index')->name('tickets.index');
        Route::get('create', 'TicketController@create')->name('tickets.create');
        Route::post('store', 'TicketController@store')->name('tickets.store');
        Route::get('edit/{id}', 'TicketController@edit')->name('tickets.edit');
        Route::put('update/{id}', 'TicketController@update')->name('tickets.update');
        Route::delete('delete/{id}', 'TicketController@destroy')->name('tickets.destroy');
    });
});


/*
 * Library Management System
 */
Route::prefix('library/')->group (function () {
    //Organization default
    Route::get('/','DashboardController@library')->name('library');

    //Book Authors routes
    Route::prefix('author/')->group (function () {
        Route::get('/', 'AuthorController@index')->name('authors.index');
        Route::post('store', 'AuthorController@store')->name('authors.store');
        Route::get('edit/{id}', 'AuthorController@edit')->name('authors.edit');
        Route::put('update/{id}', 'AuthorController@update')->name('authors.update');
        Route::delete('delete/{id}', 'AuthorController@destroy')->name('authors.destroy');
    });

    //Book Publisher routes
    Route::prefix('publisher/')->group (function () {
        Route::get('/', 'PublisherController@index')->name('publishers.index');
        Route::post('store', 'PublisherController@store')->name('publishers.store');
        Route::get('edit/{id}', 'PublisherController@edit')->name('publishers.edit');
        Route::put('update/{id}', 'PublisherController@update')->name('publishers.update');
        Route::delete('delete/{id}', 'PublisherController@destroy')->name('publishers.destroy');
    });

    //Publication Category
    Route::prefix('publication/categories')->group (function () {
        Route::get('/', 'PublicationCategoryController@index')->name('publicationCategories.index');
        Route::post('store', 'PublicationCategoryController@store')->name('publicationCategories.store');
        Route::get('edit/{id}', 'PublicationCategoryController@edit')->name('publicationCategories.edit');
        Route::put('update/{id}', 'PublicationCategoryController@update')->name('publicationCategories.update');
        Route::delete('delete/{id}', 'PublicationCategoryController@destroy')->name('publicationCategories.destroy');
    });

    //Library Shelf
    Route::prefix('shelf/')->group (function () {
        Route::get('/', 'ShelfController@index')->name('shelves.index');
        Route::post('store', 'ShelfController@store')->name('shelves.store');
        Route::get('edit/{id}', 'ShelfController@edit')->name('shelves.edit');
        Route::put('update/{id}', 'ShelfController@update')->name('shelves.update');
        Route::delete('delete/{id}', 'ShelfController@destroy')->name('shelves.destroy');
    });

    //Book Genres
    Route::prefix('genres/')->group (function () {
        Route::get('/', 'GenreController@index')->name('genres.index');
        Route::post('store', 'GenreController@store')->name('genres.store');
        Route::get('edit/{id}', 'GenreController@edit')->name('genres.edit');
        Route::put('update/{id}', 'GenreController@update')->name('genres.update');
        Route::delete('delete/{id}', 'GenreController@destroy')->name('genres.destroy');
    });

    //Books Publication
    Route::prefix('publications/')->group (function () {
        Route::get('index', 'PublicationController@index')->name('publications.index');
        Route::get('create', 'PublicationController@create')->name('publications.create');
        Route::post('store', 'PublicationController@store')->name('publications.store');
        Route::get('edit/{id}', 'PublicationController@edit')->name('publications.edit');
        Route::put('update/{id}', 'PublicationController@update')->name('publications.update');
        Route::delete('delete/{id}', 'PublicationController@destroy')->name('publications.destroy');
        Route::post('import', 'PublicationController@import')->name('publications.import');
    });



});


/*
 * EMPLOYEE PORTAL
 */

/*
 * Employee Web Guard Routes
 */
Route::namespace('Employee')->prefix('employee/')->name('employee.')->group (function () {
       //Item Store Request
        Route::prefix('store/request')->group (function (){
            Route::get('index', 'ItemRequestController@index')->name('itemRequests.index');
            Route::post('store', 'ItemRequestController@store')->name('itemRequests.store');
            Route::get('edit/{id}', 'ItemRequestController@edit')->name('itemRequests.edit');
            Route::put('update/{id}', 'ItemRequestController@update')->name('itemRequests.update');
            Route::delete('delete/{id}', 'ItemRequestController@destroy')->name('itemRequests.destroy');

        });

        //Events Management Routes
        Route::resource('eventCategories', 'EventCategoryController')->except('create','show','destroy');
        Route::resource('events', 'EventController')->except('show','destroy');

});









