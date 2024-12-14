<style>
    /* Container Styling */
    .social-login-buttons {
        background-color: #ffffff;
        border: 1px solid #ddd;
        border-radius: 10px;
    }

    /* Button Base Styling */
    .social-login-buttons a {
        display: block;
        padding: 12px;
        border-radius: 30px;
        font-size: 16px;
        font-weight: bold;
        text-align: center;
        text-decoration: none;
        color: white;
        transition: all 0.3s ease;
    }

    /* Gmail Button */
    .social-login-buttons .btn-danger {
        background-color: #DB4437; /* Gmail Red */
        border: none;
        box-shadow: 0px 4px 8px rgba(219, 68, 55, 0.3);
    }

    .social-login-buttons .btn-danger:hover {
        background-color: #c23321; /* Darker Gmail Red */
        transform: translateY(-2px);
    }

    /* Outlook Button */
    .social-login-buttons .btn-primary {
        background-color: #0072C6; /* Outlook Blue */
        border: none;
        box-shadow: 0px 4px 8px rgba(0, 114, 198, 0.3);
    }

    .social-login-buttons .btn-primary:hover {
        background-color: #005a9c; /* Darker Outlook Blue */
        transform: translateY(-2px);
    }

    /* Button Icons */
    .social-login-buttons i {
        font-size: 20px;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .social-login-buttons {
            padding: 20px;
        }

        .social-login-buttons a {
            font-size: 14px;
        }
    }
</style>


<div class="row justify-content-center mt-4">
    <div class="col-md-6 col-lg-4">
        <div class="social-login-buttons text-center p-3 shadow-sm rounded">
            <!-- <h5 class="mb-4">Sign in to Continue</h5> -->

            <!-- Gmail Login/Logout Button -->
                <a href="{{ url('oauth/gmail') }}" class="btn btn-danger d-flex align-items-center justify-content-center mb-3">
                    <i class="fab fa-google me-2"></i> Login with Gmail
                </a>
            <!-- Outlook Login/Logout Button -->
                <a href="{{ url('microsoft/signin') }}" class="btn btn-primary d-flex align-items-center justify-content-center">
                    <i class="fas fa-envelope me-2"></i> Login with Outlook
                </a>
        </div>
    </div>
</div>
