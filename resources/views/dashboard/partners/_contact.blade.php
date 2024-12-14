<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ localize("Contact Information") }}</h4>
                <br>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group has-validation">
                            <x-form.label for="company_name" :isRequired="true">{{ localize("Contact Full Name") }}</x-form.label>
                            <x-form.input type="text"
                                          id="contact_full_name"
                                          name="contact_full_name"
                                          placeholder="Ex. John123"
                                          value="{{ isset($partner) ? $partner->contact_full_name : old('contact_full_name') }}"
                            />
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-group has-validation">
                            <x-form.label for="contact_title" :isRequired="true">{{ localize("Contact Title") }}</x-form.label>
                            <x-form.input type="text"
                                          id="contact_title"
                                          name="contact_title"
                                          placeholder="Ex. John123"
                                          value="{{ isset($partner) ? $partner->contact_title : old('contact_title') }}"
                            />
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-group has-validation">
                            <x-form.label for="contact_email" :isRequired="true">{{ localize("Contact Email") }}</x-form.label>
                            <x-form.input type="email"
                                          id="contact_email"
                                          name="contact_email"
                                          placeholder="Ex. John123"
                                          value="{{ isset($partner) ? $partner->contact_email : old('contact_email') }}"
                            />
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-group has-validation">
                            <x-form.label for="contact_mobile_number" :isRequired="true">{{ localize("Company Mobile Number") }}</x-form.label>
                            <x-form.input type="text"
                                          id="contact_mobile_number"
                                          name="contact_mobile_number"
                                          placeholder="Ex. John123"
                                          value="{{ isset($partner) ? $partner->contact_mobile_number : old('contact_mobile_number') }}"
                            />
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </div>
</div>
