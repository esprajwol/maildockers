<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ localize("Personal Information") }}</h4>
                <br>
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
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Authentication Start --}}
@if($user->user_type == 'admin' || $user->user_type == 'partner' )
@include("dashboard.users._authentication")
@endif
{{-- Authentication End --}}




{{-- Partner Attachment Start--}}
@if($user->user_type == 'admin' || $user->user_type == 'partner' )
@include("dashboard.users._attachment")
@endif
{{-- Partner Attachment End--}}

<x-form.submit/>
