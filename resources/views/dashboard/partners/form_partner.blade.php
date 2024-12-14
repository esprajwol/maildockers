<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ localize("Personal Information") }}</h4>
                <br>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group has-validation">
                            <x-form.label for="firstName" :isRequired="true">{{ localize("First Name") }}</x-form.label>
                            <x-form.input type="text"
                                          id="firstName"
                                          name="first_name"
                                          placeholder="Ex. John"
                                          value="{{ isset($user) ? $user->first_name : old('firstName') }}"
                            />
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group has-validation">
                            <x-form.label for="middleName" :isRequired="false">{{ localize("Middle Name") }}</x-form.label>
                            <x-form.input type="text"
                                          id="middleName"
                                          name="middle_name"
                                          placeholder="Ex. Doe"
                                          value="{{ isset($user) ? $user->middle_name : old('middle_name') }}"
                            />
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group has-validation">
                            <x-form.label for="lastName" :isRequired="false">{{ localize("Last Name") }}</x-form.label>
                            <x-form.input type="text"
                                          id="lastName"
                                          name="last_name"
                                          placeholder="Ex. John"
                                          value="{{ isset($user) ? $user->last_name : old('last_name') }}"
                            />
                        </div>
                    </div>
                    @if(isset($user))
                        <div class="col-lg-4">
                            <div class="form-group has-validation">
                                <x-form.label for="is_active" :isRequired="true">{{ localize("Status") }}</x-form.label>

                                <x-form.select name="is_active" class="form-control">
                                    <option value="1" @if($user->is_active == 1) selected @endif>{{localize('Active')}}</option>
                                    <option value="0" @if($user->is_active == 0) selected @endif>{{localize('Inactive')}}</option>

                                </x-form.select>
                            </div>
                        </div>
                    @endif
                    <div class="col-lg-4">
                        <div class="form-group has-validation">
                            <x-form.label for="country_id" :isRequired="true">{{ localize("Country") }}</x-form.label>

                            <x-form.select name="country_id" class="form-control">
                                @forelse($countries as $country)
                                    <option value="{{$country->id}}" @if(isset($user) && $country->id == $user->country_id) selected @endif>{{$country->name}}</option>
                                @empty
                                @endforelse
                            </x-form.select>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group has-validation">
                            <x-form.label for="state_id" :isRequired="true">{{ localize("State") }}</x-form.label>

                            <x-form.select name="state_id" class="form-control">
                                @forelse($states as $state)
                                    <option value="{{$state->id}}" @if(isset($user) && $state->id == $user->state_id) selected @endif>{{$state->name}}</option>
                                @empty
                                @endforelse
                            </x-form.select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Authentication Start --}}
@include("dashboard.partners._authentication")
{{-- Authentication End --}}

{{-- Partner Company Information Start--}}
{{--@include("dashboard.partners._company")--}}
{{-- Partner Company Information End--}}

{{-- Partner Contact Start --}}
{{--@include("dashboard.partners._account")--}}
{{-- Partner Contact End --}}

{{-- Partner Contact Start --}}
{{--@include("dashboard.partners._contact")--}}
{{-- Partner Contact End --}}

{{-- Social Link Start --}}
{{--@include("dashboard.partners._social")--}}
{{-- Social Link End --}}

{{-- Partner Attachment Start--}}
@include("dashboard.partners._attachment")
{{-- Partner Attachment End--}}

<x-form.submit />
