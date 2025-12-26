<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup for Jodo</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- CSS -->
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

                        <!-- SIGNUP AREA -->
                        <div class="login-box-bottom-inner-top">
                            <a href="{{ route('student.login') }}" class="back-btn mb-2">
                                <i class="fa fa-arrow-left"></i>
                            </a>

                            <img src="{{ asset('images/logo.svg') }}" alt="">
                            <h1>Signup for Jodo</h1>

                            <p class="text-muted mb-3">
                                Welcome! Since you are new here, we need your details to get started.
                            </p>

                            <form id="signupForm">
                                <div class="login-input-sec">

                                    <!-- NAME -->
                                    <div class="form-group mb-3">
                                        <input type="text" id="name" class="form-control" required>
                                        <label for="name">Your Name</label>
                                    </div>

                                    <!-- EMAIL -->
                                    @php
                                        $isEmail = isset($identifier) && filter_var($identifier, FILTER_VALIDATE_EMAIL);
                                    @endphp

                                    <div class="form-group mb-3">
                                        <input type="email" id="email" class="form-control"
                                            value="{{ $isEmail ? $identifier : '' }}">
                                        <label for="email">Email</label>
                                    </div>


                                    <!-- MOBILE -->
                                    @php
                                        $isMobile = isset($identifier) && is_numeric($identifier);
                                    @endphp

                                    <div class="login-input-sec-inner mb-3">
                                        <select class="form-select" disabled>
                                            <option>+91</option>
                                        </select>

                                        <div class="form-group">
                                            <input type="text" id="mobile" class="form-control"
                                                value="{{ $isMobile ? $identifier : '' }}"
                                                {{ $isMobile ? 'readonly' : '' }}>
                                            <label for="mobile">Phone Number</label>
                                        </div>
                                    </div>


                                    <!-- TERMS -->
                                    <div class="register-check-sec">
                                        <input type="checkbox" id="terms" required>
                                        <p>
                                            By using the Jodo platform you agree to the
                                            <a href="#">Privacy Policy</a> and
                                            <a href="#">Terms and Conditions</a>
                                        </p>
                                    </div>

                                    <button type="button" class="otp-btn" id="signupOtpBtn">
                                        Get OTP
                                    </button>

                                </div>
                            </form>
                        </div>

                        <!-- FOOTER -->
                        <div class="login-box-bottom-inner-bottom">
                            <a href="#" class="powerby-box">
                                Powered by
                                <img src="{{ asset('images/logo.svg') }}">
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

        $('#signupOtpBtn').click(function(e) {
            e.preventDefault();

            if (!$('#terms').is(':checked')) {
                toastr.error('Please accept terms and conditions');
                return;
            }

            $.post('{{ route('student.register') }}', {
                name: $('#name').val(),
                email: $('#email').val(),
                mobile: $('#mobile').val()
            }, function(res) {

                if (!res.status) {
                    toastr.error(res.message);
                    return;
                }

                // ✅ Redirect to OTP page
                window.location.href = res.redirect;
            });
        });


        function verifyOtp() {
            let identifier = $('#email').val() || $('#mobile').val();

            $.post('{{ route('student.verifyOtp') }}', {
                identifier: identifier,
                otp: $('#otp').val()
            }, function(res) {
                if (res.status) {
                    window.location.href = res.redirect;
                } else {
                    toastr.error(res.message);
                }
            });
        }
    </script>
</body>

</html>
