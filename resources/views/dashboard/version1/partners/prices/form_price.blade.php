<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card custom-card">

            <div class="card-header justify-content-between">
                <div class="card-title">
                    <h4 class="card-title">{{ localize("edit_price") }}</h4>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group has-validation">
                            <x-form.label for="price" :isRequired="true">{{ localize("price") }}</x-form.label>
                            <x-form.input type="text"
                                id="price"
                                name="price"
                                placeholder="{{ localize('ex_dot_price') }}"
                                value="{{ isset($partnerPrice) ? $partnerPrice->price : old('price') }}" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<x-form.submit />
