@extends('dashboard.version1.layouts.main')

@section('title', 'Update Partner')
@section('top-header', 'Update Partner')

@section('content')
    <form class="forms-sample" action="{{ route('admin.partners.update',["partner" =>$user->id]) }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @method("PUT")

        @include("dashboard.partners.form_partner")
    </form>
@stop
