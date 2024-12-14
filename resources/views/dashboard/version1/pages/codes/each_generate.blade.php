@extends('dashboard.layouts.main')

@section('title', localize(' - Generate Codes'))

@push('extra-styles')
    <style>
        .form-group select option {
            padding: 0.94rem 1.375rem!important;
            font-size: 0.9125rem;
        }
    </style>
@endpush

@section('content')
<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{localize('Generate New QR Codes')}}</h4>
                <p class="card-description"> {{localize('From here you can generate new QR codes as needed.')}} </p>
                <form class="forms-sample" action="{{ route('admin.code.generate.each') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group has-validation">
                        <label for="customSelect">{{localize('Product of Brand')}}</label>
                        <select name="brand" class="form-control @error('brand') is-invalid @enderror" style="padding: 0.94rem 1.375rem!important;">
                            <option value="">{{localize('Choose Brand')}}</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                        @error('brand')
                        <small id="brand" class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group has-validation">
                        <label for="number">{{localize('Number of QR Codes')}}</label>
                        <input type="number" class="form-control @error('number') is-invalid @enderror" id="number" name="number" min="1" placeholder="eg: 500">
                        @error('number')
                        <small id="number" class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-gradient-primary me-2">{{localize('Generate')}}</button>
                    <a href="{{ route('admin.code.lists') }}" class="btn btn-gradient-danger">{{localize('Show List')}}</a>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@push('extra-scripts')
{{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#customSelect').select2({
            templateResult: formatOption
        });
    });

    function formatOption(option) {
        if (!option.id) {
            return option.text;
        }
        var imageUrl = $(option.element).data('image');
        var $option = $(
            `<span><img src="${imageUrl}" class="select-image" /> ${option.text}</span>`
        );
        return $option;
    }
</script> --}}
@endpush
