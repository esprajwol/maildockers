<div class="form-group has-validation">
    <label for="store_name">Store Name</label>
    <x-form.input type="text"
                  class="form-control "
                  id="store_name"
                  name="store_name"
                  :value="isset($store) ? $store->store_name : old('store_name')"
    />
</div>
<div class="form-group has-validation">
    <label for="contact_name">Contact name</label>
    <x-form.input type="text"
           class="form-control "
           id="contact_name"
           name="contact_name"
           :value="isset($store) ? $store->contact_name : old('contact_name')"
    />
</div>

<div class="form-group has-validation">
    <label for="contact_mobile">Contact Mobile</label>
    <x-form.input type="text"
                  class="form-control "
                  id="contact_mobile"
                  name="contact_mobile"
                  :value="isset($store) ? $store->contact_mobile : old('contact_mobile')"
    />
</div>
<div class="form-group has-validation">
    <label for="contact_email">Email Address</label>
    <x-form.input type="email"
                  class="form-control "
                  id="contact_email"
                  name="contact_email"
                  :value="isset($store) ? $store->contact_email : old('contact_email')"
    />
</div>
<div class="form-group has-validation">
    <label for="address-input">{{ localize("Address") }}</label>
    <x-form.input type="text"
                  class="form-control map-input"
                  id="address"
                  name="address"
                  placeholder="Enter Your Location"
                  :value="isset($store) ? $store->address : old('address')"
    />
</div>

<div class="form-group has-validation d-none" id="latitudeArea">
    <label for="address-latitude ">Latitude</label>
    <x-form.input type="hidden"
                  class="form-control"
                  name="latitude"
                  id="latitude"
                  placeholder=""
                  :value="isset($store) ? $store->latitude : old('latitude')"
    />
</div>
<div class="form-group has-validation  d-none" id="longitudeArea">
    <label for="address-longitude">Longitude</label>
    <x-form.input type="hidden"
                  class="form-control"
                  name="longitude"
                  id="longitude"
                  placeholder=""
                  :value="isset($store) ? $store->longitude : old('longitude')"
    />
</div>

<div class="form-group has-validation">
    <label for="image">Upload Store Logo</label>
    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
           name="image" placeholder="Upload .png,.jpg,.jpeg file" value="{{ old('image') }}">
    @error('image')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
