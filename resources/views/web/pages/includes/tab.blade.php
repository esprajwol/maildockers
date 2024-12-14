<div class="tab-content" id="nav-tabContent">
@if(!LaravelGmail::check() && !session('userName'))
        <div class="tab-pane fade show active" id="nav-google" role="tabpanel"
             aria-labelledby="nav-google-tab">
            @include('includes.partials._googleForm')
        </div>
        <div class="tab-pane fade" id="nav-microsoft" role="tabpanel"
             aria-labelledby="nav-microsoft-tab">
            @include('includes.partials._microSoftForm')
        </div>
    @elseif(LaravelGmail::check() && !session('userName'))
        <div class="tab-pane fade show active" id="nav-google" role="tabpanel"
             aria-labelledby="nav-google-tab">
            @include('includes.partials._googleForm')
        </div>
        <div class="tab-pane fade" id="nav-status" role="tabpanel"
             aria-labelledby="nav-status-tab">
            @include('includes.partials._status')
        </div>
    @elseif(!LaravelGmail::check() && session('userName'))
        <div class="tab-pane fade show active" id="nav-microsoft" role="tabpanel"
             aria-labelledby="nav-microsoft-tab">
            @include('includes.partials._microSoftForm')
        </div>
        <div class="tab-pane fade" id="nav-status" role="tabpanel"
             aria-labelledby="nav-status-tab">
            @include('includes.partials._status')
        </div>
    @endif
    <div class="tab-pane fade" id="nav-social" role="tabpanel"
             aria-labelledby="nav-status-tab">
            @include('includes.partials._sociallogin')
        </div>
</div>
