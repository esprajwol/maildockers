<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <h4 class="card-title">{{ localize("Payment Details") }}</h4>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group has-validation">
                            <x-form.label for="card_number" :isRequired="true">{{ localize("Card Number") }}</x-form.label>
                            <x-form.input type="text" id="card_number" name="card_number" placeholder="Card number" value="{{ isset($client) ? base64_decode($client->card_number) : old('card_number') }}" />
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group has-validation">
                            <x-form.label for="card_holder_name" :isRequired="true">{{ localize("Card Holder Name") }}</x-form.label>
                            <x-form.input type="text" id="card_holder_name" name="card_holder_name" placeholder="Card Holder Name" value="{{ isset($client) ? $client->card_holder_name : old('card_holder_name') }}" />
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group has-validation">
                            <x-form.label for="card_exipre" :isRequired="true">{{ localize("Card Exipre") }}</x-form.label>
                            <x-form.input type="text" id="card_exipre" name="card_exipre" placeholder="Card expire mm/yy" value="{{ isset($client) ? $client->card_exipre : old('card_exipre') }}" />
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group has-validation">
                            <x-form.label for="card_cvv" :isRequired="true">{{ localize("Card CVV") }}</x-form.label>
                            <x-form.input type="text" id="card_cvv" name="card_cvv" placeholder="Card CVV" value="{{ isset($client) ? base64_decode($client->card_cvv) : old('card_cvv') }}" />
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
