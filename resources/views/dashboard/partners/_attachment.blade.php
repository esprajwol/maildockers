<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ localize("Profile Picture") }}</h4>
                <br>

                <div class="row">
                    <div class="col-lg-4">
                        <div class="row">
                            @if(isset($user))
                            <div class="form-group">
                                @if(isset($user->photo))
                                    <img src="{{ asset($user->photo) }}" alt="Previous Image" class="img-thumbnail" style="height: 90px; width: 100px">
                                @endif
                            </div>
                            <br><br>
                            @endif
                            <div class="form-group has-validation">
                                <x-common.file_upload label="Upload Partner Image" name="photo" />
                            </div>
                        </div>

                    </div>

{{--                    <div class="col-lg-4">--}}
{{--                        <div class="row">--}}
{{--                            @if(isset($partner))--}}
{{--                            <div class="form-group">--}}
{{--                                @if(isset($partner->company_logo))--}}
{{--                                    <img src="{{ asset($partner->company_logo) }}" alt="Previous Image" class="img-thumbnail" style="height: 90px; width: 100px">--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                            <br><br>--}}
{{--                            @endif--}}
{{--                            <div class="form-group has-validation">--}}
{{--                                <x-common.file_upload label="Company Logo" name="company_logo" />--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                </div>--}}

            </div>
        </div>
    </div>
</div>