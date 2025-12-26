<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Institute Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
</head>

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
                        <h1>Institute Registration</h1>
                        <p class="text-muted">
                            Register your institute. Admin approval is required.
                        </p>

                        <form id="instituteRegisterForm">
                            @csrf

                            <div class="login-input-sec">

                                <!-- Institute Name -->
                                <div class="form-group mb-3">
                                    <input type="text" id="name" class="form-control" required>
                                    <label>Institute Name</label>
                                </div>

                                <!-- Address -->
                                <div class="form-group mb-3">
                                    <textarea id="address" class="form-control" rows="3" required></textarea>
                                    <label>Institute Address</label>
                                </div>

                                <!-- Email -->
                                <div class="form-group mb-3">
                                    <input type="email" id="email" class="form-control" required>
                                    <label>Email Address</label>
                                </div>

                                <!-- Password -->
                                <div class="form-group mb-3">
                                    <input type="password" id="password" class="form-control" required>
                                    <label>Password</label>
                                </div>

                                <!-- Confirm Password -->
                                <div class="form-group mb-3">
                                    <input type="password" id="password_confirmation" class="form-control" required>
                                    <label>Confirm Password</label>
                                </div>

                                <button type="submit" class="otp-btn">
                                    Register Institute
                                </button>

                                <p class="mt-3 text-center">
                                    Already registered?
                                    <a href="{{ route('institute.login') }}">Login</a>
                                </p>

                            </div>
                        </form>
                    </div>

                    <div class="login-box-bottom-inner-bottom">
                        <a href="#" class="powerby-box">
                            Powered by <img src="{{ asset('images/logo.svg') }}">
                        </a>
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

$('#instituteRegisterForm').submit(function(e) {
    e.preventDefault();

    $.post('{{ route("institute.register.submit") }}', {
        name: $('#name').val(),
        address: $('#address').val(),
        email: $('#email').val(),
        password: $('#password').val(),
        password_confirmation: $('#password_confirmation').val(),
    }, function(res) {

        if (res.status) {
            toastr.success(res.message);
            setTimeout(() => {
                window.location.href = res.redirect;
            }, 1500);
        } else {
            toastr.error(res.message);
        }

    }).fail(function(xhr) {
        toastr.error('Validation error. Please check inputs.');
    });
});
</script>

</body>
</html>
