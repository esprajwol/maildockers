@extends('dashboard.layouts.main')

@section('title', localize(' - Create Store'))

@section('content')

    @php
        $actionRoute = isAdmin() ? route('admin.stores.store') : route('distributor.stores.store');
    @endphp
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{localize('Add New Store')}}</h4>
                    <br>
                    {{-- <p class="card-description"> From here you can add new store. </p> --}}
                    <form class="forms-sample"
                          action="{{ $actionRoute }}"
                          method="POST"
                          enctype="multipart/form-data">
                        @csrf


                        @include("dashboard.pages.stores.form_store")
                        <button type="submit" class="btn btn-gradient-primary me-2">{{localize('Create Store')}}</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{localize('Dynamic Map')}}</h4>
                    <br>
                    {{-- <p class="card-description"> From here you can add new store. </p> --}}
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    <style>
        #map {
            height: 500px;
            width: 100%;
        }
    </style>

    @include("dashboard.pages.stores.js")

@endsection
