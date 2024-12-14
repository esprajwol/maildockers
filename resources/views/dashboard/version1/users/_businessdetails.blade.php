<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <h4 class="card-title">{{ localize("Business Details") }}</h4>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group has-validation">
                            <x-form.label for="business_name" :isRequired="true">{{ localize("Business Name") }}</x-form.label>
                            <x-form.input type="text" id="business_name" name="business_name" placeholder="Business Name" value="{{ isset($client) ? $client->business_name : old('business_name') }}" />
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group has-validation">
                            <x-form.label for="business_address" :isRequired="true">{{ localize("Business Address") }}</x-form.label>
                            <x-form.input type="text" id="business_address" name="business_address" placeholder="Business Address" value="{{ isset($client) ? $client->business_address : old('business_address') }}"
                            />
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group has-validation">
                            <x-form.label for="vat_no" :isRequired="true">{{ localize("VAT No.") }}</x-form.label>
                            <x-form.input type="text" id="vat_no" name="vat_no" placeholder="VAT No" value="{{ isset($client) ? $client->vat_no : old('vat_no') }}"
                            />
                        </div>
                    </div>
                    @include("dashboard.version1.users._attachmentclient")
                </div>
            </div>
        </div>
    </div>
</div>
