<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        @if (!LaravelGmail::check() && !session('userName'))
            <div class="nav-link active" id="nav-google-tab" data-bs-toggle="tab" data-bs-target="#nav-google" type="button"
                role="tab" aria-controls="nav-google" aria-selected="true">
                <img src="{{ asset('web/assets/img/gmail.png') }}" alt="gmail"> Gmail
            </div>
            <div class="nav-link" id="nav-microsoft-tab" data-bs-toggle="tab" data-bs-target="#nav-microsoft"
                type="button" role="tab" aria-controls="nav-microsoft" aria-selected="false">
                <img src="{{ asset('web/assets/img/outlook.png') }}" alt="gmail"> Outlook
            </div>

        @elseif(LaravelGmail::check() && !session('userName'))
            <div class="nav-link active" id="nav-google-tab" data-bs-toggle="tab" data-bs-target="#nav-google"
                type="button" role="tab" aria-controls="nav-google" aria-selected="true">
                <img src="{{ asset('web/assets/img/gmail.png') }}" alt="gmail"> Gmail
            </div>
            <div class="nav-link" id="nav-status-tab" data-bs-toggle="tab" data-bs-target="#nav-status" type="button"
                role="tab" aria-controls="nav-microsoft" aria-selected="false">
                <img src="{{ asset('web/assets/img/status.png') }}" alt="status"> Status
            </div>
        @elseif(!LaravelGmail::check() && session('userName'))
            <div class="nav-link active" id="nav-microsoft-tab" data-bs-toggle="tab" data-bs-target="#nav-microsoft"
                type="button" role="tab" aria-controls="nav-microsoft" aria-selected="true">
                <img src="{{ asset('web/assets/img/outlook.png') }}" alt="gmail"> Outlook
            </div>
            <div class="nav-link" id="nav-status-tab" data-bs-toggle="tab" data-bs-target="#nav-status" type="button"
                 role="tab" aria-controls="nav-microsoft" aria-selected="false">
                <img src="{{ asset('web/assets/img/status.png') }}" alt="status"> Status
            </div>
        @endif
        @if (!LaravelGmail::check() || !session('userName'))
        <div class="nav-link d-none" id="nav-social-tab" data-bs-toggle="tab" data-bs-target="#nav-social" type="button"
                role="tab" aria-controls="nav-social" aria-selected="true">
                Login
            </div>
            @endif
    </div>
</nav>
