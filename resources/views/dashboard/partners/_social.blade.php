<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ localize("Social Links") }}</h4>
                <br>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group has-validation">
                            <x-form.label for="company_name" :isRequired="true">{{ localize("Facebook") }}</x-form.label>
                            <x-form.input type="text"
                                          id="facebook_link"
                                          name="facebook_link"
                                          placeholder="Ex. https://facebook.com/YourUserName"
                                          value="{{ isset($partner) ? $partner->facebook_link : old('facebook_link') }}"
                            />
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group has-validation">
                            <x-form.label for="instagram_link" :isRequired="true">{{ localize("Instagram") }}</x-form.label>
                            <x-form.input type="text"
                                          id="instagram_link"
                                          name="instagram_link"
                                          placeholder="Ex. https://instagram.com/YourUserName"

                                          value="{{ isset($partner) ? $partner->instagram_link : old('instagram_link') }}"
                            />
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group has-validation">
                            <x-form.label for="tiktok_link" :isRequired="true">{{ localize("TikTok") }}</x-form.label>
                            <x-form.input type="text"
                                          id="tiktok_link"
                                          name="tiktok_link"
                                          placeholder="Ex. https://tiktok.com/YourUserName"
                                          value="{{ isset($partner) ? $partner->tiktok_link : old('tiktok_link') }}"
                            />
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group has-validation">
                            <x-form.label for="youtube_link" :isRequired="true">{{ localize("Youtube  Number") }}</x-form.label>
                            <x-form.input type="text"
                                          id="youtube_link"
                                          name="youtube_link"
                                          placeholder="Ex. https://youtube.com/YourUserName"
                                          value="{{ isset($partner) ? $partner->youtube_link : old('youtube_link') }}"
                            />
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </div>
</div>
