<div class="col-lg-12 showWhenMsgCrossed100 mt-3 d-none" style="text-align: left; padding:10px;">
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <span class="error-message text-danger" style="font-size:1.5rem; text-align-left;"></span>
                <br>
                <input type="hidden"
                       class="notify_channel"
                       value="email"
                />

                <label for="" class="mb-3" style="font-size:1.6rem;">
                    We are about to send the document directly to
                </label>

                <input type="email"
                       name="notify_value"
                       style="font-size:1.5rem;"
                       class="form-control notify_value text-center"
                       placeholder="Ex. email@example.com"
                       value="{{ laravelGmailUser() }}"
                />

            </div>
        </div>
    </div>
</div>
