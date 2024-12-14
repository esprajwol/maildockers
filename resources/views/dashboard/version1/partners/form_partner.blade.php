<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card custom-card">
            <div class="top-left"></div>
            <div class="top-right"></div>
            <div class="bottom-left"></div>
            <div class="bottom-right"></div>
            <div class="card-header justify-content-between">
                <div class="card-title">
                    <h4 class="card-title">{{ localize('Personal Information') }}</h4>
                </div>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group has-validation">
                            <x-form.label for="firstName" :isRequired="true">{{ localize('First Name') }}</x-form.label>
                            <x-form.input type="text" id="firstName" name="first_name" placeholder="Ex. John"
                                value="{{ isset($user) ? $user->first_name : old('firstName') }}" />
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group has-validation">
                            <x-form.label for="middleName"
                                :isRequired="false">{{ localize('Middle Name') }}</x-form.label>
                            <x-form.input type="text" id="middleName" name="middle_name" placeholder="Ex. Doe"
                                value="{{ isset($user) ? $user->middle_name : old('middle_name') }}" />
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group has-validation">
                            <x-form.label for="lastName" :isRequired="false">{{ localize('Last Name') }}</x-form.label>
                            <x-form.input type="text" id="lastName" name="last_name" placeholder="Ex. John"
                                value="{{ isset($user) ? $user->last_name : old('last_name') }}" />
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group has-validation">
                            <x-form.label for="email" :isRequired="true">{{ localize('Email') }}</x-form.label>
                            <x-form.input type="email" id="email" name="email"
                                placeholder="Ex. admin@example.com"
                                value="{{ isset($user) ? $user->email : old('email') }}" />
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group has-validation">
                            <x-form.label for="mobile_no" :isRequired="false">{{ localize('Mobile') }}</x-form.label>
                            <x-form.input type="text" id="mobile_no" name="mobile_no" placeholder="+441234567890"
                                value="{{ isset($user) ? $user->mobile_no : old('mobile_no') }}" />
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group has-validation">
                            <x-form.label for="userName" :isRequired="true">{{ localize('User Name') }}</x-form.label>
                            <x-form.input type="text" id="userName" name="username" placeholder="Ex. John123"
                                value="{{ isset($user) ? $user->username : old('username') }}" />
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group has-validation">
                            <x-form.label for="country_id" :isRequired="true">{{ localize('Country') }}</x-form.label>

                            <x-form.select name="country_id" id="country_id" class="form-control">
                                <option value=""> Select Country </option>
                                @forelse($countries as $country)
                                    <option value="{{ $country->id }}"
                                        @if (isset($user) && $country->id == $user->country_id) selected @endif>{{ $country->name }}</option>
                                @empty
                                @endforelse
                            </x-form.select>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group has-validation">
                            <x-form.label for="state_id" :isRequired="false">{{ localize('State') }}</x-form.label>
                            <x-form.select name="state_id" id="state_id" class="form-control">
                                <option value="">Select State</option>
                            </x-form.select>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group has-validation">
                            <x-form.label for="password" :isRequired="true">{{ localize('Password') }}</x-form.label>
                            <x-form.input type="password" id="password" name="password" placeholder="Ex. password"
                                value="{{ isset($user) ? $user->password : old('password') }}" />
                        </div>
                    </div>

                    @if (isset($user))
                        <div class="col-lg-4">
                            <div class="form-group has-validation">
                                <x-form.label for="is_active" :isRequired="true">{{ localize('Status') }}</x-form.label>

                                <x-form.select name="is_active" class="form-control">
                                    <option value="1" @if ($user->is_active == 1) selected @endif>
                                        {{ localize('Active') }}</option>
                                    <option value="0" @if ($user->is_active == 0) selected @endif>
                                        {{ localize('Inactive') }}</option>

                                </x-form.select>
                            </div>
                        </div>
                    @endif

                    <div class="col-lg-4">
                        <div class="form-group has-validation">
                            <x-form.label for="sub_domain_prefix"
                                :isRequired="false">{{ localize('Subdomain Prefix') }}</x-form.label>
                            <x-form.input type="text" id="sub_domain_prefix" name="sub_domain_prefix"
                                placeholder="Ex. us"
                                value="{{ isset($user) ? $user->sub_domain_prefix : old('sub_domain_prefix') }}" />
                        </div>
                    </div>

                </div>
            </div>




        </div>
    </div>
</div>

{{-- Authentication Start --}}
{{-- @include("dashboard.version1.partners._authentication") --}}
{{-- Authentication End --}}

{{-- Partner Business Information Start --}}
@include('dashboard.version1.partners._business')
{{-- Partner Business Information End --}}

{{-- Partner Company Information Start --}}
{{-- @include("dashboard.partners._company") --}}
{{-- Partner Company Information End --}}

{{-- Partner Contact Start --}}
{{-- @include("dashboard.partners._account") --}}
{{-- Partner Contact End --}}

{{-- Partner Contact Start --}}
{{-- @include("dashboard.partners._contact") --}}
{{-- Partner Contact End --}}

{{-- Social Link Start --}}
{{-- @include("dashboard.partners._social") --}}
{{-- Social Link End --}}

{{-- Partner Attachment Start --}}
@include('dashboard.version1.partners._attachment')
{{-- Partner Attachment End --}}

<x-form.submit />


@push('extra-scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#country_id').on('change', function() {
                let countryId = $(this).val();
                $.ajax({
                    url: "{{ route('stateByCountry', '+countryId+') }}",
                    type: 'GET',
                    data: {
                        country_id: countryId
                    },

                    success: function(response) {
                        let stateSelect = $('#state_id');
                        stateSelect.empty();
                        stateSelect.append('<option value="">Select State</option>');
                        response.forEach(function(state) {
                            stateSelect.append('<option value="' + state.id + '">' +
                                state.name + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }

                });
            });
        });

        $(document).ready(function() {
            let countryId = $('#country_id').val();
            if (countryId) {
                $.ajax({
                    url: "{{ route('stateByCountry', '+countryId+') }}",
                    type: 'GET',
                    data: {
                        country_id: countryId
                    },

                    success: function(response) {
                        let stateSelect = $('#state_id');
                        stateSelect.empty();
                        stateSelect.append('<option value="">Select State</option>');
                        response.forEach(function(state) {

                            @if (isset($user->state_id))
                                if (state.id == {{ $user->state_id }}) {
                                    stateSelect.append('<option value="' + state.id +
                                        '" selected>' + state.name + '</option>');
                                } else {
                                    stateSelect.append('<option value="' + state.id + '">' +
                                        state.name + '</option>');
                                }
                            @else
                                stateSelect.append('<option value="' + state.id + '">' + state
                                    .name + '</option>');
                            @endif

                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }

                });
            }
        });
    </script>
@endpush
