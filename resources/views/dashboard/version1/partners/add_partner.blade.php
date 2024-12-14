@extends('dashboard.version1.layouts.main')

@section('title', ' - Create Partner')
@section('top-header', 'New Partner')

@section('content')
    <form class="forms-sample" action="{{ route('admin.partners.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include("dashboard.version1.partners.form_partner")
    </form>
@stop