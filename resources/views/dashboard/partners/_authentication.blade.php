<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ localize("Authentication Information") }}</h4>
                <br>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group has-validation">
                            <x-form.label for="userName" :isRequired="true">{{ localize("User Name") }}</x-form.label>
                            <x-form.input type="text"
                                          id="userName"
                                          name="username"
                                          placeholder="Ex. John123"
                                          value="{{ isset($user) ? $user->username : old('username') }}"
                            />
                        </div>
                    </div>

                    @if(!isset($user))
                        <div class="col-lg-4">
                            <div class="form-group has-validation">
                                <x-form.label for="password" :isRequired="true">{{ localize("Password") }}</x-form.label>
                                <x-form.input type="password"
                                              id="password"
                                              name="password"
                                              placeholder="Ex. password"
                                              value="{{ isset($user) ? $user->password : old('password') }}"
                                />
                            </div>
                        </div>
                    @else
{{--                        <div class="col-lg-4">--}}
{{--                            <div class="form-group has-validation">--}}
{{--                                <x-form.label for="affiliation_id" :isRequired="false">{{ localize("Affiliation ID") }}</x-form.label>--}}
{{--                                <x-form.input type="text"--}}
{{--                                              id="affiliation_id"--}}
{{--                                              name="affiliation_id"--}}
{{--                                              value="{{ isset($user) ? $user->partner?->affiliation_id : old('affiliation_id') }}"--}}
{{--                                />--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    @endif


                    <div class="col-lg-4">
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
                </div>

            </div>
        </div>
    </div>
</div>
