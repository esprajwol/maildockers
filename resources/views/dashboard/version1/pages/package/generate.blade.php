@extends('dashboard.layouts.main')

@section('title', localize(' - Create Package'))

@section('content')
<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{localize('Add New Package')}}</h4>
                <br>
                {{-- <p class="card-total_products"> From here you can add new price. </p> --}}
                <form class="forms-sample" action="{{ route('admin.package.generate') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group has-validation">
                        <label for="name">{{localize('Name')}}</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="i.e: Free Plan" value="{{ old('name') }}">
                        @error('name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group has-validation">
                        <label for="price">{{localize('Price')}}</label>
                        <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" step="any" name="price" value="{{ old('price') }}">
                        @error('price')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group has-validation">
                        <label for="total_products">{{localize('Total Products')}}</label>
                        <input type="number" class="form-control @error('total_products') is-invalid @enderror" id="total_products" name="total_products" placeholder="Per Project" value="{{ old('total_products') }}" pattern="*">
                        @error('total_products')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group has-validation">
                        <label for="total_users">{{localize('Total Users')}}</label>
                        <input  type="number" class="form-control @error('total_users') is-invalid @enderror" id="total_users" name="total_users" placeholder="10K products" value="{{ old('total_users') }}"></input>
                        @error('total_users')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group has-validation">
                        <label for="total_models">{{localize('Total Models')}}</label>
                        <input  type="number" class="form-control @error('total_models') is-invalid @enderror" id="total_models" name="total_models" placeholder="10K products" value="{{ old('total_models') }}"></input>
                        @error('total_models')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group has-validation">
                        <label for="anti_fake_detection">{{localize('Anti Fake Detection')}}</label>
                        <input type="checkbox" checked="checked"  value="1"  id="anti_fake_detection" name="anti_fake_detection">
                        @error('anti_fake_detection')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group has-validation">
                        <label for="create_import_qr">{{localize('Create Import QR')}}</label>
                        <input type="checkbox" checked="checked"  value="1"  id="create_import_qr" name="create_import_qr">
                        @error('create_import_qr')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group has-validation">
                        <label for="fake_detection_alert">{{localize('Fake Detaction Alert')}}</label>
                        <input type="checkbox" checked="checked"  value="1"  id="fake_detection_alert" name="fake_detection_alert">
                        @error('fake_detection_alert')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group has-validation">
                        <label for="product_sold_alert">{{localize('Product Sold Alert')}}</label>
                        <input type="checkbox" checked="checked"  value="1"  id="product_sold_alert" name="product_sold_alert">
                        @error('product_sold_alert')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group has-validation">
                        <label for="out_stock_notifications">{{localize('Out Stock Notifications')}}</label>
                        <input type="checkbox" checked="checked"  value="1"  id="out_stock_notifications" name="out_stock_notifications">
                        @error('out_stock_notifications')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group has-validation">
                        <label for="permissions_system">{{localize('Permissions System')}}</label>
                        <input type="checkbox" checked="checked"  value="1"  id="permissions_system" name="permissions_system">
                        @error('permissions_system')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group has-validation">
                        <label for="advanced_analytics_system">{{localize('Advanced Analytics System')}}</label>
                        <input type="checkbox" checked="checked"  value="1"  id="advanced_analytics_system" name="advanced_analytics_system">
                        @error('advanced_analytics_system')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group has-validation">
                        <label for="stores_listing">{{localize('Stores Listing')}}</label>
                        <input type="checkbox" checked="checked"  value="1"  id="stores_listing" name="stores_listing">
                        @error('stores_listing')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group has-validation">
                        <label for="managers_dashboard">{{localize('Managers Dashboard')}}</label>
                        <input type="checkbox" checked="checked"  value="1"  id="managers_dashboard" name="managers_dashboard">
                        @error('managers_dashboard')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group has-validation">
                        <label for="unlimited_lotteries">{{localize('Unlimited Lotteries')}}</label>
                        <input type="checkbox" checked="checked"  value="1"  id="unlimited_lotteries" name="unlimited_lotteries">
                        @error('unlimited_lotteries')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group has-validation">
                        <label for="consumers_database_collector">{{localize('Consumers Database Collector')}}</label>
                        <input type="checkbox" checked="checked"  value="1"  id="consumers_database_collector" name="consumers_database_collector">
                        @error('consumers_database_collector')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group has-validation">
                        <label for="ordering">{{localize('Ordering')}}</label>
                        <input  type="number" class="form-control @error('ordering') is-invalid @enderror" id="ordering" name="ordering" placeholder="1" value="{{ old('ordering') }}"></input>
                        @error('ordering')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group has-validation">
                        <label for="image_path">{{localize('Upload Image')}}</label>
                        <input type="file" class="form-control @error('image_path') is-invalid @enderror" id="image_path" name="image_path" placeholder="Upload .png,.jpg,.jpeg file" value="{{ old('image_path') }}">
                        @error('image_path')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>


                    <button type="submit" class="btn btn-gradient-primary me-2">{{localize('Create Package')}}</button>
                    {{-- <a href="{{ route('admin.package.lists') }}" class="btn btn-gradient-danger">Show Package List</a> --}}
                </form>
            </div>
        </div>
    </div>
</div>
@stop
