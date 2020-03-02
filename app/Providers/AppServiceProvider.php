<?php

namespace App\Providers;

use App\Country;
use App\Http\View\Composers\CitiesComposer;
use App\Http\View\Composers\DistrictsComposer;
use App\Http\View\Composers\EmployeesComposer;
use App\Http\View\Composers\EventsComposer;
use App\Http\View\Composers\GroupsComposer;
use App\Http\View\Composers\IndividualsComposer;
use App\Http\View\Composers\ItemCategoriesComposer;
use App\Http\View\Composers\ItemsComposer;
use App\Http\View\Composers\ItemUnitsComposer;
use App\Http\View\Composers\OrganizationsComposer;
use App\Http\View\Composers\ParticipantRolesComposer;
use App\Http\View\Composers\PermissionsComposer;
use App\Http\View\Composers\RolesComposer;
use App\Http\View\Composers\SectorsComposer;
use App\Http\View\Composers\WardsComposer;
use App\ParticipantRole;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Http\View\Composers\CountriesComposer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        //Option 1 every Single View
        //View::share('countries',Country::all());

        //Option 2 - Granular views with specific views
        //View::composer(['location.countries.index','location.cities.index'], function ($view){
       //         $view->with('countries',Country::all());
       // });

        //Option 3 - Granular views with wildcards
        //View::composer(['location.countries.*','location.cities.*'], function ($view){
            //$view->with('countries',Country::all());
        //});

        //Option 4 - Dedicated Facade
        //Pass variable countries to multiple views
        View::composer(['partials.countries.*'],CountriesComposer::class);

        //Pass variable cities to multiple views
        View::composer(['partials.cities.*'],CitiesComposer::class);

        //Pass variable cities to multiple views
        View::composer(['partials.districts.*'],DistrictsComposer::class);

        //Pass variable wards to multiple views
        View::composer(['partials.wards.*'],WardsComposer::class);

        //Pass variable item Categories to multiple views
        View::composer(['partials.item.categories.*'],ItemCategoriesComposer::class);

        //Pass variable item Categories to multiple views
        View::composer(['partials.item.units.*'],ItemUnitsComposer::class);

        //Pass variable item Categories to multiple views
        View::composer(['partials.item.items.*'],ItemsComposer::class);

        //Pass variable item Categories to multiple views
        View::composer(['partials.employees.*'],EmployeesComposer::class);

        //Pass variable item Categories to multiple views
        View::composer(['partials.organizations.*'],OrganizationsComposer::class);

        //Pass variable item Categories to multiple views
        View::composer(['partials.individuals.*'],IndividualsComposer::class);

        //Pass variable item Categories to multiple views
        View::composer(['partials.event.events.*'],EventsComposer::class);

        //Pass variable item Categories to multiple views
        View::composer(['partials.individuals.groups.*'],GroupsComposer::class);

        //Pass variable item Categories to multiple views
        View::composer(['partials.individuals.roles.*'],ParticipantRolesComposer::class);

        //Pass roles
        View::composer(['partials.roles.*'],RolesComposer::class);

        //Pass permissions
        View::composer(['partials.permissions.*'],PermissionsComposer::class);

        //Pass permissions
        View::composer(['partials.sectors.*'],SectorsComposer::class);




    }
}
