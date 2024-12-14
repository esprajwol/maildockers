@extends('dashboard.layouts.main')

@section('title', localize('New Series'))
@section('top-header',  localize('New Series'))

@section('content')
    <form class="forms-sample" action="{{ route('admin.series.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include("dashboard.admin.series.form_series")
    </form>
@stop


@section("js")
    @include("dashboard.admin.series.js")
@endsection
