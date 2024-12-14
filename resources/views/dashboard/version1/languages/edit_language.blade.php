@extends('dashboard.version1.layouts.main')

@section('title', 'Update Language')
@section('top-header', 'Update Language')
@section('top-header-right')
    @if (isAdmin() || isDistributor())
        <a href="@if(isAdmin()) {{ route('admin.languages.index') }}  @endif"
           class="btn btn-gradient-primary btn-icon-text btn-sm">
            <i class="mdi mdi-view-list btn-icon-prepend"></i> {{ localize("Languages") }}
        </a>
    @endif
@stop
@section('content')
    <form class="forms-sample"
          action="{{ route("admin.languages.update",["language"=>$language->id])}}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @method("PUT")


        @include("dashboard.version1.languages.form_language")
    </form>
@stop
