@extends('layouts.admin')

@section('title','New Organization Type')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">New Organization Type</h4>
                    @include('alerts._flash')
                    <form method="POST" action="{{route('org_types.store')}}" class="form" >
                        @include('OrganizationCategories.types._form',['buttonText'=>'save'])
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
