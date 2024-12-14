<div class="row mt-3">

    <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ localize("Payment Details") }}</h4>
                    <br>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group has-validation">
                                <x-form.label for="cardHolderName" :isRequired="true">{{ localize("Card Holder Name") }}</x-form.label>
                                <x-form.input type="text"
                                              id="cardHolderName"
                                              name="card_holder_name"
                                              placeholder="Ex. John123"
                                              value="{{ isset($user) ? $user->distributor?->card_holder_name : old('card_holder_name') }}"
                                />
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group has-validation">
                                <x-form.label for="cardNumber" :isRequired="true">{{ localize("Card Number") }}</x-form.label>
                                <x-form.input type="text"
                                              id="cardNumber"
                                              name="card_number"
                                              placeholder="Ex. 123456789"
                                              value="{{ isset($user) ? $user->distributor?->card_number : old('card_number') }}"
                                />
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group has-validation">
                                <x-form.label for="cardExpirationDate" :isRequired="true">{{ localize("Card Expiration Date") }}</x-form.label>
                                <x-form.input type="text"
                                              id="cardExpirationDate"
                                              name="card_expiration_date"
                                              placeholder="Ex. 01/30"
                                              value="{{ isset($user) ? $user->distributor?->card_expiration_date : old('card_expiration_date') }}"
                                />
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group has-validation">
                                <x-form.label for="cardCVV" :isRequired="true">{{ localize("Card CVV") }}</x-form.label>
                                <x-form.input type="number"
                                              id="cardCVV"
                                              name="card_cvv"
                                              placeholder="Ex. 123"
                                              value="{{ isset($user) ? $user->distributor?->card_cvv : old('card_cvv') }}"
                                />
                            </div>
                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>
