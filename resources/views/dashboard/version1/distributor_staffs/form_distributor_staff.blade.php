<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ localize("User Information") }}</h4>
                <br>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group has-validation">
                            <x-form.label for="first_name" :isRequired="true">{{ localize("First Name") }}</x-form.label>
                            <x-form.input type="text"
                                          id="first_name"
                                          name="first_name"
                                          placeholder="{{ localize('First Name') }}"
                                          :value="isset($user) ? $user->first_name : old('first_name')"
                            />
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group has-validation">
                            <x-form.label for="middle_name" :isRequired="false">{{ localize("Middle Name") }}</x-form.label>
                            <x-form.input type="text"
                                          id="middle_name"
                                          name="middle_name"
                                          placeholder="{{ localize('Middle Name') }}"
                                          :value="isset($user) ? $user->middle_name : old('middle_name')"
                            />
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group has-validation">
                            <x-form.label for="last_name" :isRequired="false">{{ localize("Last Name") }}</x-form.label>
                            <x-form.input type="text"
                                          id="last_name"
                                          name="last_name"
                                          placeholder="{{ localize('Last Name') }}"
                                          :value="isset($user) ? $user->last_name : old('last_name')"
                            />
                        </div>
                    </div>


                    <div class="col-lg-4">
                        <div class="form-group has-validation">
                            <x-form.label for="username" :isRequired="true">{{ localize("Username") }}</x-form.label>
                            <x-form.input type="text"
                                          id="username"
                                          name="username"
                                          placeholder="{{ localize('username') }}"
                                          :value="isset($user) ? $user->username : old('username')"
                            />
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group has-validation">
                            <x-form.label for="email" :isRequired="false">{{ localize("Email") }}</x-form.label>
                            <x-form.input type="text"
                                          id="email"
                                          name="email"
                                          placeholder="{{ localize('email@domain.com') }}"
                                          :value="isset($user) ? $user->email : old('email')"
                            />
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group has-validation">
                            <x-form.label for="password" :isRequired="true">{{ localize("password") }}</x-form.label>
                            <x-form.input type="password"
                                          id="password"
                                          name="password"
                                          placeholder=""
                                          :value="isset($user) ? $user->password : old('password')"
                            />
                        </div>
                    </div>

                   {{-- <div class="col-lg-4">
                        <div class="form-group has-validation">
                            <x-form.label for="user_type" :isRequired="true">{{ localize("User Type") }}</x-form.label>

                            <x-form.select name="user_type" class="form-control">
                                <option value="admin">{{ localize("Admin") }}</option>
                                <option value="admin_staff">{{ localize("Admin Staff") }}</option>
                                <option value="partner">{{ localize("Partner") }}</option>
                                <option value="partner_staff">{{ localize("Partner Staff") }}</option>
                                <option value="distributor">{{ localize("Distributor") }}</option>
                                <option value="distributor_staff">{{ localize("Distributor Staff") }}</option>
                            </x-form.select>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group has-validation">
                            <x-form.label for="parent_user_id" :isRequired="false">{{ localize("Parent User") }}</x-form.label>

                            <x-form.select name="parent_user_id" class="form-control">
                                <option value="">{{ localize("None") }}</option>
                            @forelse($parentUsers as $key=>$pUser)
                                    <option value="{{ $pUser->id }}">{{ $pUser->getFullNameAttribute() }}</option>
                                @empty
                                @endforelse
                            </x-form.select>
                        </div>
                    </div>--}}

                    {{-- <div class="col-lg-4">
                        <div class="form-group has-validation">
                            <x-form.label for="role" :isRequired="false">{{ localize("Role") }}</x-form.label>

                            <x-form.select name="role" class="form-control">
                                <option value="">{{ localize("admin") }}</option>
                                <option value="">{{ localize("superadmin") }}</option>
                            </x-form.select>
                        </div>
                    </div> --}}
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
                            <x-form.label for="menu_permission_version" :isRequired="true">{{ localize("Menu Permission Version") }}</x-form.label>

                            <x-form.select name="menu_permission_version" class="form-control">
                                    <option value="0" selected>{{ localize("No") }}</option>
                                    <option value="1">{{ localize("Yes") }}</option>
                            </x-form.select>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="row">
                            @if(isset($user))
                                <div class="form-group">
                                    @if(isset($user->photo))
                                        <img src="{{ asset($user->photo) }}" alt="Previous Image" class="img-thumbnail" style="height: 90px; width: 100px">
                                    @endif
                                </div>
                                <br><br>
                            @endif
                                <div class="form-group has-validation">
                                    <x-common.file_upload label="Upload Image" name="photo" />
                                </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<x-form.submit />
