@extends('dashboard.layouts.main')

@section('title', localize(' - Create Staff'))
@section('top-header', localize('New Staff'))

@section('content')
    <form class="forms-sample"
          action="{{ route('distributor.distributor-staffs.store') }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @include("dashboard.distributor_staffs.form_distributor_staff")
    </form>
@stop
