<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ localize("Card Information") }}</h4>
                <br>
                @if($user->user_type == 'partner')
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group has-validation">
                            <x-form.label for="account_name" :isRequired="true">{{ localize("Account Name") }}</x-form.label>
                            <x-form.input type="text"
                                          id="account_name"
                                          name="account_name"
                                          placeholder="Ex. John123"
                                          value="{{  isset($user) ? $user->partner?->account_name : old('account_name') }}"
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
                                          value="{{  isset($user) ? $user->partner?->account_iban : old('account_iban') }}"
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
                                          value="{{  isset($user) ? $user->partner?->account_swift : old('account_swift') }}"
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
                                          value="{{  isset($user) ? $user->partner?->vat_number : old('vat_number') }}"
                            />
                        </div>
                    </div>


                </div>
                @endif
                @if($user->user_type == 'distributor')
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group has-validation">
                            <x-form.label for="card_holder_name" :isRequired="true">{{ localize("Card Holder Name") }}</x-form.label>
                            <x-form.input type="text"
                                          id="card_holder_name"
                                          name="card_holder_name"
                                          placeholder="Ex. John123"
                                          value="{{ isset($user) ? $user->distributor?->card_holder_name : old('card_holder_name') }}"
                            />
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-group has-validation">
                            <x-form.label for="card_number" :isRequired="true">{{ localize("Card Number") }}</x-form.label>
                            <x-form.input type="text"
                                          id="card_number"
                                          name="card_number"
                                          placeholder="Ex. John123"
                                          value="{{ isset($user) ? $user->distributor?->card_number : old('card_number') }}"
                            />
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-group has-validation">
                            <x-form.label for="card_expiration_date" :isRequired="true">{{ localize("Card Expiration Date") }}</x-form.label>
                            <x-form.input type="date"
                                          id="card_expiration_date"
                                          name="card_expiration_date"
                                          placeholder="Ex. 123"
                                          value="{{ isset($user) ? $user->distributor?->card_expiration_date : old('card_expiration_date') }}"
                            />
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-group has-validation">
                            <x-form.label for="card_cvv" :isRequired="true">{{ localize("Card CVV") }}</x-form.label>
                            <x-form.input type="text"
                                          id="card_cvv"
                                          name="card_cvv"
                                          placeholder="Ex. 123"
                                          value="{{ isset($user) ? $user->distributor?->card_cvv : old('card_cvv') }}"
                            />
                        </div>
                    </div>


                </div>
                @endif

            </div>
        </div>
    </div>
</div>
