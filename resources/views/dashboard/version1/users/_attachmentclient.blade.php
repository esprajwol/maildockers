@if($user->user_type == 'client')
    <div class="col-lg-4">
        <div class="row">
            @if(isset($client->attachment))
                <div class="form-group">
                    @if(isset($client->attachment))
                        <img src="{{ asset($client->attachment) }}" alt="Previous Image" class="img-thumbnail" style="height: 90px; width: 100px">
                    @endif
                </div>
                <br><br>
            @endif
            <div class="form-group has-validation">
                <x-common.file_upload label="Upload Attchment Image" name="attachment"/>
            </div>
        </div>

    </div>
@endif