@extends('dashboard.version1.layouts.main')

@section('title', ' - Create Model')
@section('top-header', 'New Model')
@section('top-header-right')
    @if (isAdmin() || isDistributor())
        <a href="@if(isAdmin()) {{ route('admin.languages.index') }}  @endif"
           class="btn btn-gradient-primary btn-icon-text btn-sm">
            <i class="mdi mdi-view-list btn-icon-prepend"></i> {{ localize("Models") }}
        </a>
    @endif
@stop

@section('content')
    <form class="forms-sample"
          action="@if(isAdmin()) {{ route('admin.languages.store') }} @endif"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @include("dashboard.version1.languages.form_language")
    </form>
@stop
