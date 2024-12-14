<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ localize("Series Information") }}</h4>
                <br>
                <div class="row">

                    @if(isAdmin())
                        <div class="col-lg-3">
                            <div class="form-group has-validation">
                                <x-form.label for="user_id" :isRequired="false">{{ localize("Distributor") }}</x-form.label>

                                <x-form.select name="user_id" class="form-control userId">
                                    <option value="">{{ localize("Select a Distributor") }}</option>
                                    @forelse($users as $key=>$user)
                                        <option value="{{ $user->id }}">{{ $user->fullName }} </option>
                                    @empty
                                    @endforelse
                                </x-form.select>
                            </div>
                        </div>
                    @endif

                    <div class="col-lg-3">
                        <div class="form-group has-validation">
                            <x-form.label for="distrack_model_id" :isRequired="false">{{ localize("Model") }}</x-form.label>

                            <x-form.select name="distrack_model_id" class="form-control modelId">
                                @if(!isAdmin())
                                    @forelse($models as $key=>$model)
                                        <option value="{{ $model->id }}">{{ $model->model_name }} </option>
                                    @empty
                                    @endforelse
                                @endif

                            </x-form.select>
                        </div>
                    </div>


                    <div class="col-lg-3">
                        <div class="form-group has-validation">
                            <x-form.label for="quantity" :isRequired="false">{{ localize("Quantity") }}</x-form.label>
                            <x-form.input type="number"
                                          id="quantity"
                                          name="quantity"
                                          placeholder="{{ localize('Ex: 100') }}"
                                          :value="isset($series) ? $series->quantity : old('quantity') "
                            />
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<x-form.submit />
