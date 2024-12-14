@extends('dashboard.layouts.main')

@section('title', localize(' - Create Store'))
@section('top-header', localize('New User'))

@section('content')
    <form class="forms-sample"
          action="{{ route('admin.users.store') }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @include("dashboard.users.form_user_creation")
    </form>
@stop
