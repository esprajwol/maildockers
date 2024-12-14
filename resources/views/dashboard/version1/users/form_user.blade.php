<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <h4 class="card-title">{{ localize("Personal Information") }}</h4>
            </div>
            <div class="card-body">

                <div class="row">
                    @if($user->user_type == 'admin' || $user->user_type == 'partner' )

                        <div class="col-lg-4">
                            <div class="form-group has-validation">
                                <x-form.label for="firstName"
                                              :isRequired="true">{{ localize("First Name") }}</x-form.label>
                                <x-form.input type="text"
                                              id="firstName"
                                              name="first_name"
                                              placeholder="Ex. John"
                                              value="{{ isset($user) ? $user->first_name : old('firstName') }}"
                                />
                            </div>
                        </div>
                    @endif
                    @if($user->user_type == 'admin' || $user->user_type == 'partner' )

                        <div class="col-lg-4">
                            <div class="form-group has-validation">
                                <x-form.label for="middleName"
                                              :isRequired="false">{{ localize("Middle Name") }}</x-form.label>
                                <x-form.input type="text"
                                              id="middleName"
                                              name="middle_name"
                                              placeholder="Ex. Doe"
                                              value="{{ isset($user) ? $user->middle_name : old('middle_name') }}"
                                />
                            </div>
                        </div>
                    @endif
                    @if($user->user_type == 'admin' || $user->user_type == 'partner')

                        <div class="col-lg-4">
                            <div class="form-group has-validation">
                                <x-form.label for="lastName"
                                              :isRequired="false">{{ localize("Last Name") }}</x-form.label>
                                <x-form.input type="text"
                                              id="lastName"
                                              name="last_name"
                                              placeholder="Ex. John"
                                              value="{{ isset($user) ? $user->last_name : old('last_name') }}"
                                />
                            </div>
                        </div>
                    @endif
                    @if($user->user_type == 'client' || $user->user_type == 'individual')

                        <div class="col-lg-4">
                            <div class="form-group has-validation">
                                <x-form.label for="fullName"
                                              :isRequired="false">{{ localize("Full Name") }}</x-form.label>
                                              <?php $middle = (!empty($user->middle_name))? $user->middle_name.' ':'';?>
                                <x-form.input type="text"
                                              id="fullName"
                                              name="full_name"
                                              placeholder="Ex. John"
                                              value="{{ isset($user) ? $user->first_name.' '.$middle.$user->last_name : old('last_name') }}"
                                />
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>

{{-- Authentication Start --}}
@if($user->user_type == 'admin' || $user->user_type == 'partner' || $user->user_type == 'client' || $user->user_type == 'individual')
@include("dashboard.version1.users._authentication")
@endif
{{-- Authentication End --}}




{{-- Partner Attachment Start--}}
@if($user->user_type == 'admin' || $user->user_type == 'partner' || $user->user_type == 'client' || $user->user_type == 'individual')
@include("dashboard.version1.users._attachment")
@endif

@if($user->user_type == 'client')
@include("dashboard.version1.users._paymentdetails")
@include("dashboard.version1.users._businessdetails")
@endif

{{-- Partner Attachment End--}}
<x-form.submit/>
