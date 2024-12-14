<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ localize("Account Information") }}</h4>
                <br>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group has-validation">
                            <x-form.label for="account_name" :isRequired="true">{{ localize("Account Name") }}</x-form.label>
                            <x-form.input type="text"
                                          id="account_name"
                                          name="account_name"
                                          placeholder="Ex. John123"
                                          value="{{ isset($partner) ? $partner->account_name : old('account_name') }}"
                            />
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-group has-validation">
                            <x-form.label for="account_iban" :isRequired="true">{{ localize("IBAN") }}</x-form.label>
                            <x-form.input type="text"
                                          id="account_iban"
                                          name="account_iban"
                                          placeholder="Ex. John123"
                                          value="{{ isset($partner) ? $partner->account_iban : old('account_iban') }}"
                            />
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-group has-validation">
                            <x-form.label for="account_swift" :isRequired="true">{{ localize("Swift") }}</x-form.label>
                            <x-form.input type="number"
                                          id="account_swift"
                                          name="account_swift"
                                          placeholder="Ex. 123"
                                          value="{{ isset($partner) ? $partner->account_swift : old('account_swift') }}"
                            />
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-group has-validation">
                            <x-form.label for="vat_number" :isRequired="true">{{ localize("V.A.T Number") }}</x-form.label>
                            <x-form.input type="text"
                                          id="vat_number"
                                          name="vat_number"
                                          placeholder="Ex. 123"
                                          value="{{ isset($partner) ? $partner->vat_number : old('vat_number') }}"
                            />
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </div>
</div>
