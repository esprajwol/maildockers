<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <h4 class="card-title">{{ localize("Attachments") }}</h4>
            </div>
            <div class="card-body">

                <div class="row">
                    @if($user->user_type == 'admin' || $user->user_type == 'partner' || $user->user_type == 'client' || $user->user_type == 'individual')
                        <div class="col-lg-4">
                            <div class="row">
                                @if(isset($user->photo))
                                    <div class="form-group">
                                        @if(isset($user->photo))
                                            <img src="{{ asset($user->photo) }}" alt="Previous Image"
                                                 class="img-thumbnail" style="height: 90px; width: 100px">
                                        @endif
                                    </div>
                                    <br><br>
                                @endif
                                <div class="form-group has-validation">
                                    <x-common.file_upload label="Upload Partner Image" name="photo"/>
                                </div>
                            </div>

                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
