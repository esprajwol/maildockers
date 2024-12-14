@extends('dashboard.layouts.main')

@section('title', ' - Create Brand')

@section('content')
<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{localize('Add New Brand')}}</h4>
                <br>
                {{-- <p class="card-description"> From here you can add new brand. </p> --}}
                <form class="forms-sample" action="{{ route('admin.brand.generate') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group has-validation">
                        <label for="name">{{localize('Company Formal Name")}}</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="i.e: GoodsTracker" value="{{ old('name') }}">
                        @error('name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group has-validation">
                        <label for="short_name">{{localize('Short name')}}</label>
                        <input type="text" class="form-control @error('short_name') is-invalid @enderror" id="short_name" name="short_name" value="{{ old('short_name') }}">
                        @error('short_name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    {{-- <div class="form-group has-validation">
                        <label for="slug">Validation Url</label>
                        <div class="input-group">
                            <span class="input-group-text">https://legalpdf.co/</span>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" placeholder="example" value="{{ old('slug') }}">
                            <span class="input-group-text">/XXXXXXXX</span>
                            @error('slug')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div> --}}
                    <div class="form-group has-validation">
                        <label for="website">{{localize('Site Address')}}</label>
                        <input type="text" class="form-control @error('website') is-invalid @enderror" id="website" name="website" placeholder="www.example.com" value="{{ old('website') }}" pattern="*">
                        @error('website')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group has-validation">
                        <label for="email">{{localize('Email Address')}}</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="example@gmail.com" value="{{ old('email') }}">
                        @error('email')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group has-validation">
                        <label for="address">{{localize('Office Address')}}</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder="New York, United States" value="{{ old('address') }}">
                        @error('address')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group has-validation">
                        <label for="phone">{{localize('Office Phone Number')}}</label>
                        <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="" value="{{ old('phone') }}">
                        @error('phone')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group has-validation">
                        <label for="brand_logo">{{localize('Upload Brand Logo')}}</label>
                        <input type="file" class="form-control @error('brand_logo') is-invalid @enderror" id="brand_logo" name="brand_logo" placeholder="Upload .png,.jpg,.jpeg file" value="{{ old('brand_logo') }}">
                        @error('brand_logo')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    {{-- <div class="form-group has-validation">
                        <label for="brand_cover">Upload Brand Cover</label>
                        <input type="file" class="form-control @error('brand_cover') is-invalid @enderror" id="brand_cover" name="brand_cover" placeholder="Upload .png,.jpg,.jpeg file" value="{{ old('brand_cover') }}">
                        @error('brand_cover')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div> --}}
                    {{-- <div class="form-group has-validation">
                        <label for="description">Brand Description (Optional)</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" placeholder="Type your brand description..."></textarea>
                        @error('description')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div> --}}
                    <button type="submit" class="btn btn-gradient-primary me-2">{{localize('Create Brand')}}</button>
                    {{-- <a href="{{ route('admin.brand.lists') }}" class="btn btn-gradient-danger">Show Brands List</a> --}}
                </form>
            </div>
        </div>
    </div>
</div>
@stop
