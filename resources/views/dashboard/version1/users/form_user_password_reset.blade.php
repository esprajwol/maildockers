@extends('dashboard.version1.layouts.main')

@section('title', localize(' - Change Password'))
@section('top-header', localize('Change Password'))

@section('content')
    <form class="forms-sample" action="@if(isAdmin()){{ route('admin.updatePassword.update') }} @elseif(isDistributor()) {{ route('distributor.updatePassword.update') }} @elseif(isPartner()) {{ route('partner.updatePassword.update') }} @endif" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card custom-card">
                    <div class="card-header  justify-content-between">
                        <h4 class="card-title">{{ localize("Change Password") }}</h4>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group has-validation">
                                    <label for="current_password" class="form-label">{{ localize("Current Password") }}</label>
                                    <span style="color: red">*</span>
                                    <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password" required>
                                    @error('current_password')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group has-validation">
                                    <label for="new_password" class="form-label">{{ localize("New Password") }}</label><span style="color: red">*</span>
                                    <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" name="new_password" required>
                                    @error('new_password')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group has-validation">
                                    <label for="new_password_confirmation" class="form-label">{{ localize("Confirm New Password") }}</label><span style="color: red">*</span>
                                    <input type="password" class="form-control @error('new_password_confirmation') is-invalid @enderror" id="new_password_confirmation" name="new_password_confirmation" required>
                                    @error('new_password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">{{ localize("Update Password") }}</button>
    </form>
@endsection
