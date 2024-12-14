<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ localize("Company Information") }}</h4>
                <br>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group has-validation">
                            <x-form.label for="company_name" :isRequired="true">{{ localize("Company Name") }}</x-form.label>
                            <x-form.input type="text"
                                          id="company_name"
                                          name="company_name"
                                          placeholder="Ex. John123"
                                          value="{{ isset($partner) ? $partner->company_name : old('company_name') }}"
                            />
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group has-validation">
                            <x-form.label for="office_address" :isRequired="true">{{ localize("Company Office Address") }}</x-form.label>
                            <x-form.input type="text"
                                          id="office_address"
                                          name="office_address"
                                          placeholder="Ex. John123"
                                          value="{{ isset($partner) ? $partner->office_address : old('office_address') }}"
                            />
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group has-validation">
                            <x-form.label for="company_description" :isRequired="true">{{ localize("Company Description") }}</x-form.label>
                            <x-form.input type="text"
                                          id="company_description"
                                          name="company_description"
                                          placeholder="Ex. John123"
                                          value="{{ isset($partner) ? $partner->company_description : old('company_description') }}"
                            />
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </div>
</div>
