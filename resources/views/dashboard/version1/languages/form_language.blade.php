<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group has-validation">
                            <x-form.label for="name" :isRequired="true">{{ localize("Language Name") }}</x-form.label>
                            <x-form.input type="text"
                                          id="name"
                                          name="name"
                                          placeholder="{{ localize('Ex.English') }}"
                                          :value="isset($language) ? $language->name : old('name')"
                            />
                        </div>
                    </div>


                    <div class="col-lg-3">
                        <div class="form-group has-validation">
                            <x-form.label for="Code" :isRequired="false">{{ localize("Code") }}</x-form.label>
                            <x-form.input type="text"
                                          id="Code"
                                          name="code"
                                          placeholder="Ex. en"
                                          :value="isset($language) ? $language->code : old('code')"
                            />
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group has-validation">
                            <x-form.label for="direction" :isRequired="false">{{ localize("direction") }}</x-form.label>
                            <select name="direction" class="form-control">
                                <option value="ltr" @if(isset($language) && $language->direction == 'ltr') selected @endif>{{ localize('LTR') }}</option>
                                <option value="rtl" @if(isset($language) && $language->direction == 'rtl') selected @endif>{{ localize('RTL') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group has-validation">
                            <x-form.label for="Code" :isRequired="false">{{ localize("Code") }}</x-form.label>
                            <select name="is_active" class="form-control">
                                <option value="1" @if(isset($language) && $language->is_active == 1) selected @endif>{{ localize('Active') }}</option>
                                <option value="0" @if(isset($language) && $language->is_active == 0) selected @endif>{{ localize('Inactive') }}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        
<a href="{{route('admin.languages.index')}}" class="btn btn-primary">Back</a>
<x-form.submit />

@push('extra-scripts')
    <script>
        $('#user_id').select2({
            width: '100%',
            placeholder: "Select an Option",
            allowClear: true
        });
    </script>
@endpush
