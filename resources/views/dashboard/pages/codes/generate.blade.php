@extends('dashboard.layouts.main')

@section('title', localize(' - Generate Codes'))

@push('extra-styles')
    <style>
        .card-description a {
            text-decoration: none;
            color: #fe7096;
        }
    </style>
@endpush

@section('content')
<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{localize('Import Security Code')}}</h4>
                <p class="card-description"> {{localize('From here you can import csv file.')}} <a href="{{ route('admin.file.download', ['filename' => 'sample.csv']) }}">{{localize('Download sample.csv')}}</a></p>
                <form class="forms-sample" action="{{ route('admin.code.generate') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group has-validation">
                        <label for="file">{{localize('Upload Excel Sheet')}}</label>
                        <input type="file" class="form-control @error('file') is-invalid @enderror" id="file" name="file" placeholder="Upload .csv file">
                        @error('file')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-gradient-primary me-2">{{localize('Import')}}</button>
                    <a href="{{ route('admin.code.lists') }}" class="btn btn-gradient-danger">{{localize('Show List')}}</a>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
