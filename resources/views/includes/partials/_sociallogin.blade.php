<style>
/* Container Styling */
.social-login-buttons {
    background-color: transparent;
    padding: 30px;
    text-align: center;
    margin-top: 30px;
    margin-bottom: 30px;
}

/* Button Base Styling */
.social-login-buttons a {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 15px;
    font-size: 16px;
    font-weight: 600;
    text-decoration: none;
    color: #333;
    transition: all 0.3s ease; /* Enables smooth transition for hover effects */
    margin: 15px 0;
    width: 100%;
    border: 1px solid #f0f0f0; /* Default border color */
    border-radius: 0;
    background-color: transparent;
}

/* Gmail Button */
.social-login-buttons a.gmail-btn {
    color: #DB4437; /* Gmail Red Text */
    border-color: #DB4437; /* Gmail Red Border */
}

.social-login-buttons a.gmail-btn:hover {
    border-color: #c23321 !important; /* Darker Gmail Red Border on Hover */
}

/* Outlook Button */
.social-login-buttons a.outlook-btn {
    color: #0072C6; /* Outlook Blue Text */
    border-color: #0072C6; /* Outlook Blue Border */
}

.social-login-buttons a.outlook-btn:hover {
    border-color: #005a9c !important; /* Darker Outlook Blue Border on Hover */
}

/* Button Icons */
.social-login-buttons img {
    width: 20px;
    height: 20px;
    margin-right: 10px;
}

/* Responsive Design */
@media (max-width: 768px) {
    .social-login-buttons {
        padding: 20px;
    }

    .social-login-buttons a {
        font-size: 14px;
        padding: 12px;
    }
}
</style>

<div class="row justify-content-center mt-4">
    <div class="col-md-6 col-lg-4">
        <div class="social-login-buttons text-center">
            @if(!LaravelGmail::check())
            <!-- Gmail Login Button -->
            <a href="{{ url(config('app.url').'/oauth/gmail') }}" class="gmail-btn d-flex align-items-center justify-content-center">
                <img src="{{ asset('web/assets/img/gmail.png') }}" alt="gmail"> Sign in with Gmail
            </a>
            @endif
            @if(!session('userName'))
            <!-- Outlook Login Button -->
            <a href="{{ url('microsoft/signin') }}" class="outlook-btn d-flex align-items-center justify-content-center">
                <img src="{{ asset('web/assets/img/outlook.png') }}" alt="outlook"> Sign in with Outlook
            </a>
            @endif
        </div>
    </div>
</div>
