<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>

    <!-- CSRF -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- font awesome -->
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- fancybox -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css" />

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- slick slider -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />

    <!-- owl carousel -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

    <!-- YOUR CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
</head>

<body>
    <div class="login-body">
        <div class="login-body-inner">
            <div class="login-box">
                <div class="login-box-header">
                    <img src="{{ asset('images/login-img.png') }}" alt="Login">
                </div>

                <div class="login-box-bottom">
                    <div class="login-box-bottom-inner">

                        <!-- LOGIN / OTP AREA -->
                        <div class="login-box-bottom-inner-top" id="loginBox">
                            <img src="{{ asset('images/logo.svg') }}" alt="Logo">
                            <h1>Get Started!</h1>

                            <form id="loginForm">
                                <div class="login-input-sec">
                                    <div class="login-input-sec-inner">

                                        <select class="form-select" disabled>
                                            <option value="+91">+91</option>
                                        </select>

                                        <div class="form-group">
                                            <input id="identifier" class="form-control" type="text"
                                                placeholder="Enter email or mobile" required>
                                            <label for="identifier">
                                                Mobile Number or Email
                                            </label>
                                        </div>
                                    </div>

                                    <p>
                                        By using the Jodo platform you agree to the
                                        <a href="#">Privacy Policy</a> and
                                        <a href="#">Terms and Conditions</a>
                                    </p>

                                    <button type="button" class="otp-btn" id="sendOtpBtn">
                                        Send OTP
                                    </button>

                                </div>
                            </form>
                        </div>

                        <!-- FOOTER -->
                        <div class="login-box-bottom-inner-bottom">
                            <a href="#" class="powerby-box">
                                Powered by
                                <img src="{{ asset('images/logo.svg') }}" alt="">
                            </a>
                            <div class="iso-box">
                                <img src="{{ asset('images/ISOCertifiedLogo-1wuQ1o4O.svg') }}" alt="">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <!-- YOUR JS -->
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/login.js') }}"></script>

</body>

</html>
