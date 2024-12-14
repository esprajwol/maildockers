@extends('dashboard.layouts.main')

@section('title', localize(' - Create Store'))

@section('content')

    @php
        $actionRoute = isAdmin() ? route('admin.stores.update',$store->id) : route('distributor.stores.update',$store->id);
    @endphp

{{--    @dd(--}}
{{--    $latitude,--}}
{{--    $longitude--}}
{{--)--}}

    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Update Store</h4>
                    <br>
                    <form class="forms-sample"
                          action="{{ $actionRoute }}"
                          method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @method("PUT")

                        @include("dashboard.pages.stores.form_store")

                        <button type="submit"
                                class="btn btn-gradient-primary me-2">{{ localize("Update Store") }}</button>
                        {{-- <a href="{{ route('admin.store.lists') }}" class="btn btn-gradient-danger">Show Stores List</a> --}}
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
