<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card custom-card">
            <div class="card-body">
                <h4 class="card-title">{{ localize("Business Information") }}</h4>
                <br>
                <div class="row">
                    
                    <div class="col-lg-4">
                        <div class="form-group has-validation">
                            <x-form.label for="company_email" :isRequired="false">{{ localize("Company Email") }}</x-form.label>
                            <x-form.input type="email"
                                          id="company_email"
                                          name="company_email"
                                          placeholder="Ex. admin@example.com"
                                          value="{{ isset($user) ? $user->company_email : old('company_email') }}"
                            />
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group has-validation">
                            <x-form.label for="company_name" :isRequired="false">{{ localize("Company Name") }}</x-form.label>
                            <x-form.input type="text"
                                          id="company_name"
                                          name="company_name"
                                          placeholder="Ex. John123"
                                          value="{{ isset($user) ? $user->company_name : old('company_name') }}"
                            />
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group has-validation">
                            <x-form.label for="company_no" :isRequired="false">{{ localize("Company No") }}</x-form.label>
                            <x-form.input type="text"
                                          id="company_no"
                                          name="company_no"
                                          placeholder="+441234567890"
                                          value="{{ isset($user) ? $user->company_no : old('Company No') }}"
                            />
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group has-validation">
                            <x-form.label for="company_website" :isRequired="false">{{ localize("Company Website") }}</x-form.label>
                            <x-form.input type="text"
                                          id="company_website"
                                          name="company_website"
                                          placeholder="www.website.com"
                                          value="{{ isset($user) ? $user->company_website : old('company_website') }}"
                            />
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group has-validation">
                            <x-form.label for="company_address" :isRequired="false">{{ localize("Company Address") }}</x-form.label>
                            <x-form.input type="text"
                                          id="company_address"
                                          name="company_address"
                                          placeholder="Company Address"
                                          value="{{ isset($user) ? $user->company_address : old('company_address') }}"
                            />
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
