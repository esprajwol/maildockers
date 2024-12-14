@extends('dashboard.layouts.main')

@section('title', localize('Update Settings'))
@section('top-header', localize('Update Settings'))

@section('content')
    <form class="forms-sample"
          action="{{ route("admin.users.update",["user"=>$user->id])}}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @method("PUT")

        @include("dashboard.users.form_user_creation")
    </form>
@stop
