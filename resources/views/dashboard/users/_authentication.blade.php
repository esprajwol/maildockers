<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ localize("Authentication Information") }}</h4>
                <br>
                <div class="row">
                    @if($user->user_type == 'admin' || $user->user_type == 'partner' || $user->user_type == 'distributor')
                        <div class="col-lg-4">
                            <div class="form-group has-validation">
                                <x-form.label for="userName"
                                              :isRequired="true">{{ localize("User Name") }}</x-form.label>
                                <x-form.input type="text"
                                              id="userName"
                                              name="username"
                                              placeholder="Ex. John123"
                                              value="{{ isset($user) ? $user->username : old('username') }}"
                                />
                            </div>
                        </div>
                    @endif

{{--                    @if($user->user_type == 'partner')--}}
{{--                        <div class="col-lg-4">--}}
{{--                            <div class="form-group has-validation">--}}
{{--                                <x-form.label for="affiliation_id"--}}
{{--                                              :isRequired="false">{{ localize("Affiliation ID") }}</x-form.label>--}}
{{--                                <x-form.input type="text"--}}
{{--                                              id="affiliation_id"--}}
{{--                                              name="affiliation_id"--}}
{{--                                              value="{{ isset($user) ? $user->partner?->affiliation_id : old('affiliation_id') }}"--}}
{{--                                />--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endif--}}


{{--                    @if($user->user_type == 'partner')--}}
{{--                        <div class="col-lg-4">--}}
{{--                            <div class="form-group has-validation">--}}
{{--                                <x-form.label for="tenant_id"--}}
{{--                                              :isRequired="false">{{ localize("Tenant ID") }}</x-form.label>--}}
{{--                                <x-form.input type="text"--}}
{{--                                              id="tenant_id"--}}
{{--                                              name="tenant_id"--}}
{{--                                              value="{{ isset($user) ? $user->partner?->tenant_id : old('tenant_id') }}"--}}
{{--                                />--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endif--}}
                    @if($user->user_type == 'distributor')
                        <div class="col-lg-4">
                            <div class="form-group has-validation">
                                <x-form.label for="tenant_id"
                                              :isRequired="false">{{ localize("Tenant ID") }}</x-form.label>
                                <x-form.input type="text"
                                              id="tenant_id"
                                              name="tenant_id"
                                              value="{{ isset($user) ? $user->distributor?->tenant_id : old('tenant_id') }}"
                                />
                            </div>
                        </div>
                    @endif


                    @if($user->user_type == 'admin' || $user->user_type == 'partner' || $user->user_type == 'distributor')
                        <div class="col-lg-6">
                            <div class="form-group has-validation">
                                <x-form.label for="email" :isRequired="true">{{ localize("Email") }}</x-form.label>
                                <x-form.input type="email"
                                              id="email"
                                              name="email"
                                              placeholder="Ex. admin@example.com"
                                              value="{{ isset($user) ? $user->email : old('email') }}"
                                />
                            </div>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
