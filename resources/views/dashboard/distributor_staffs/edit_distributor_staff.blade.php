@extends('dashboard.layouts.main')

@section('title', localize('Update Staff'))
@section('top-header', 'Update Staff')

@section('content')
    <form class="forms-sample"
          action="{{ route("distributor.distributor-staffs.update",["distributor_staff"=>$user->id])}}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @method("PUT")

        @include("dashboard.distributor_staffs.form_distributor_staff")
    </form>
@stop
