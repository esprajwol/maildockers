
     <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ localize("Change Settings") }}</h4>
                        <br>

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox"
                                               class="form-check-input"
                                               name="is_enable_two_factor_authentication"
                                               id="is_enable_two_factor_authentication"
                                               value="1" @if(isset($userSetting)) @if ($userSetting->is_enable_two_factor_authentication == 1) checked  @endif @endif> {{localize('Enable Two factor Authentication')}}
                                        <i class="input-helper"></i>
                                    </label>
                                </div>

                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox"
                                               class="form-check-input"
                                               name="is_enable_notification"
                                               id="is_enable_notification"
                                               value="1" @if(isset($userSetting)) @if ($userSetting->is_enable_sms == 1) checked  @endif @endif> {{localize('Enable Notification')}}
                                        <i class="input-helper"></i>
                                    </label>
                                </div>
                                {{-- <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio"
                                               class="form-check-input"
                                               name="is_enable_sms"
                                               id="is_enable_sms"
                                               value="1"
                                               @isset($userSetting)
                                                   @if($userSetting->is_enable_sms)
                                                       checked
                                                   @endif
                                               @endisset
                                        > {{localize('Enable SMS Confirmation')}}
                                        <i class="input-helper"></i>
                                    </label>
                                </div> --}}
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio"
                                               class="form-check-input"
                                               name="is_enable_sms"
                                               id="is_enable_sms"
                                               @isset($userSetting)
                                                   @if(!$userSetting->is_enable_sms)
                                                       checked
                                               @endif
                                               @endisset
                                               value="0">
                                        {{localize('Enable Email Confirmation')}}
                                        <i class="input-helper"></i>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">{{ localize("Update Settings") }}</button>
