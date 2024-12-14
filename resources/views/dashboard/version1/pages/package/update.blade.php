@extends('dashboard.layouts.main')

@section('title', localize(' - Create Package'))

@section('content')
<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{localize('Update Package')}}</h4>
                <br>
                {{-- <p class="card-description"> Update your Package. </p> --}}
                <form class="forms-sample" action="{{ route('admin.package.update', ['id' => $package->id ]) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group has-validation">
                        <label for="name">{{localize('Name')}}</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="i.e: Free Plan" value="{{ $package->name }}">
                        @error('name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group has-validation">
                        <label for="price">{{localize('Price')}}</label>
                        <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" step="any" name="price" value="{{ $package->price }}">
                        @error('price')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group has-validation">
                        <label for="total_products">{{localize('Total Products')}}</label>
                        <input type="number" class="form-control @error('total_products') is-invalid @enderror" id="total_products" name="total_products" placeholder="Per Project" value="{{ $package->total_products }}" pattern="*">
                        @error('total_products')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group has-validation">
                        <label for="total_users">{{localize('Total Users')}}</label>
                        <input  type="number" class="form-control @error('total_users') is-invalid @enderror" id="total_users" name="total_users" placeholder="10K products" value="{{ $package->total_users }}"></input>
                        @error('total_users')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group has-validation">
                        <label for="total_models">{{localize('Total Models')}}</label>
                        <input  type="number" class="form-control @error('total_models') is-invalid @enderror" id="total_models" name="total_models" placeholder="10K products" value="{{ $package->total_models }}"></input>
                        @error('total_models')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group has-validation">
                        <label for="anti_fake_detection">{{localize('Anti Fake Detection')}}</label>
                        <input type="checkbox" class="chk" {{$package->anti_fake_detection == 1 ? 'checked' : ''}}  value="{{$package->anti_fake_detection}}"  id="anti_fake_detection" name="anti_fake_detection">
                        @error('anti_fake_detection')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group has-validation">
                        <label for="create_import_qr">{{localize('Create Import QR')}}</label>
                        <input type="checkbox" class="chk" {{$package->create_import_qr == 1 ? 'checked' : ''}}  value="{{$package->create_import_qr}}"   id="create_import_qr" name="create_import_qr">
                        @error('create_import_qr')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group has-validation">
                        <label for="fake_detection_alert">{{localize('Fake Detaction Alert')}}</label>
                        <input type="checkbox" class="chk" {{$package->fake_detection_alert == 1 ? 'checked' : ''}}  value="{{$package->fake_detection_alert}}"   id="fake_detection_alert" name="fake_detection_alert">
                        @error('fake_detection_alert')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group has-validation">
                        <label for="product_sold_alert">{{localize('Product Sold Alert')}}</label>
                        <input type="checkbox" class="chk" {{$package->product_sold_alert == 1 ? 'checked' : ''}}  value="{{$package->product_sold_alert}}"   id="product_sold_alert" name="product_sold_alert">
                        @error('product_sold_alert')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group has-validation">
                        <label for="out_stock_notifications">{{localize('Out Stock Notifications')}}</label>
                        <input type="checkbox" class="chk" {{$package->out_stock_notifications == 1 ? 'checked' : ''}}  value="{{$package->out_stock_notifications}}"   id="out_stock_notifications" name="out_stock_notifications">
                        @error('out_stock_notifications')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group has-validation">
                        <label for="permissions_system">{{localize('Permissions System')}}</label>
                        <input type="checkbox" class="chk" {{$package->permissions_system == 1 ? 'checked' : ''}}  value="{{$package->permissions_system}}"   id="permissions_system" name="permissions_system">
                        @error('permissions_system')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group has-validation">
                        <label for="advanced_analytics_system">{{localize('Advanced Analytics System')}}</label>
                        <input type="checkbox" class="chk" {{$package->advanced_analytics_system == 1 ? 'checked' : ''}}  value="{{$package->advanced_analytics_system}}"   id="advanced_analytics_system" name="advanced_analytics_system">
                        @error('advanced_analytics_system')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group has-validation">
                        <label for="stores_listing">{{localize('Stores Listing')}}</label>
                        <input type="checkbox" class="chk" {{$package->stores_listing == 1 ? 'checked' : ''}}  value="{{$package->stores_listing}}"   id="stores_listing" name="stores_listing">
                        @error('stores_listing')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group has-validation">
                        <label for="managers_dashboard">{{localize('Managers Dashboard')}}</label>
                        <input type="checkbox" class="chk" {{$package->managers_dashboard == 1 ? 'checked' : ''}}  value="{{$package->managers_dashboard}}"   id="managers_dashboard" name="managers_dashboard">
                        @error('managers_dashboard')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group has-validation">
                        <label for="unlimited_lotteries">{{localize('Unlimited Lotteries')}}</label>
                        <input type="checkbox" class="chk" {{$package->unlimited_lotteries == 1 ? 'checked' : ''}}  value="{{$package->unlimited_lotteries}}"   id="unlimited_lotteries" name="unlimited_lotteries">
                        @error('unlimited_lotteries')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group has-validation">
                        <label for="consumers_database_collector">{{localize('Consumers Database Collector')}}</label>
                        <input type="checkbox" class="chk" {{$package->consumers_database_collector == 1 ? 'checked' : ''}}  value="{{$package->consumers_database_collector}}"   id="consumers_database_collector" name="consumers_database_collector">
                        @error('consumers_database_collector')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group has-validation">
                        <label for="ordering">{{localize('Ordering')}}</label>
                        <input  type="number" class="form-control @error('ordering') is-invalid @enderror" id="ordering" name="ordering" placeholder="1" value="{{ $package->ordering }}"></input>
                        @error('ordering')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group has-validation">
                        <label for="is_active">{{localize('Status')}}</label>
                        <select class="form-control @error('is_active') is-invalid @enderror" id="is_active" name="is_active" >
                            <option  value="1" {{$package->is_active == 1  ? 'selected' : ''}}>Active</option>
                            <option value="0" {{$package->is_active == 0  ? 'selected' : ''}}>Inactive</option>
                        </select>
                        <!-- <textarea  rows="5" type="features" class="form-control @error('features') is-invalid @enderror" id="features" name="features" placeholder="example@gmail.com" value="{{$package->features}}">{{$package->features}}</textarea> -->
                        @error('is_active')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>


                    <div class="form-group has-validation">
                        <label for="image_path">{{localize('Upload Image')}}</label>
                        @if ($package->image_path)
                        <div>
                            <img src="{{asset($package->image_path)}}" style="width: 50%; padding: 8px 0px; display: inline;" alt="Image">
                        </div>
                        @endif
                        <input type="file" class="form-control @error('image_path') is-invalid @enderror" id="image_path" name="image_path" placeholder="Upload .png,.jpg,.jpeg file" value="{{ old('image_path') }}">
                        @error('image_path')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-gradient-primary me-2">{{localize('Update Package')}}</button>
                    {{-- <a href="{{ route('admin.package.lists') }}" class="btn btn-gradient-danger">Show Packages List</a> --}}
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@push('extra-scripts')
    <script type='text/javascript'>
        $(document).ready(function() {

            $(".chk").click(function () {
                $(this).val(0);
                var id = $(this).attr('id');
                if($("#" + id).is(":checked")){
                    $(this).val(1);
                }

            });

        });
    </script>
@endpush
