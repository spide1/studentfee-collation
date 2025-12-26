<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Institute Login</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- CSS -->
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">


    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
</head>

<style>
    .register-link {
        display: inline-block;
        margin-top: 10px;
        font-weight: 600;
        color: #0d6efd;
        text-decoration: none;
    }

    .register-link:hover {
        text-decoration: underline;
    }
</style>


<body>
    <div class="login-body">
        <div class="login-body-inner">
            <div class="login-box">

                <div class="login-box-header">
                    <img src="{{ asset('images/login-img.png') }}" alt="">
                </div>

                <div class="login-box-bottom">
                    <div class="login-box-bottom-inner">

                        <div class="login-box-bottom-inner-top">
                            <img src="{{ asset('images/logo.svg') }}" alt="">
                            <h1>Institute Login</h1>

                            <form id="instituteLoginForm">
                                @csrf

                                <div class="login-input-sec">
                                    <div class="parent-login-input-sec-inner">

                                        <div class="form-group mb-3">
                                            <input id="email" name="email" class="form-control" type="email"
                                                required>
                                            <label>Email Address</label>
                                        </div>

                                        <div class="form-group">
                                            <input id="password" name="password" class="form-control" type="password"
                                                required>
                                            <label>Password</label>
                                        </div>

                                    </div>

                                    <p>
                                        By using the Jodo platform you agree to the
                                        <a href="#">Privacy Policy</a> and
                                        <a href="#">Terms and Conditions</a>
                                    </p>

                                    <button type="submit" class="otp-btn">
                                        Login
                                    </button>

                                    <div class="text-center mt-3">
                                        <a href="{{ route('institute.register') }}" class="register-link">
                                            Register Your Institute
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="login-box-bottom-inner-bottom">
                            <a href="#" class="powerby-box">
                                Powered by
                                <img src="{{ asset('images/logo.svg') }}">
                            </a>
                            <div class="iso-box">
                                <img src="{{ asset('images/ISOCertifiedLogo-1wuQ1o4O.svg') }}">
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
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('#instituteLoginForm').submit(function (e) {
    e.preventDefault();

    $.post('{{ route('institute.login.submit') }}', {
        email: $('#email').val(),
        password: $('#password').val()
    })
    .done(function (res) {
        if (res.status) {
            window.location.href = res.redirect;
        } else {
            toastr.error(res.message);
        }
    })
    .fail(function (xhr) {
        if (xhr.responseJSON && xhr.responseJSON.message) {
            toastr.error(xhr.responseJSON.message);
        } else {
            toastr.error('Login failed. Please try again.');
        }
    });
});
</script>

</body>

</html>
