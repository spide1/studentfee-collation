<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>OTP Verification</title>
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

                <!-- HEADER IMAGE -->
                <div class="login-box-header">
                    <img src="{{ asset('images/login-img.png') }}" alt="">
                </div>

                <div class="login-box-bottom">
                    <div class="login-box-bottom-inner">

                        <div class="login-box-bottom-inner-top otp-sec">

                            <!-- BACK -->
                            <div class="otp-header">
                                <a href="{{ route('student.login') }}" class="back-btn">
                                    <i class="fa fa-arrow-left"></i>
                                </a>
                            </div>

                            <img src="{{ asset('images/logo.svg') }}" alt="">
                            <h1>OTP Verification</h1>

                            <p>
                                Enter the 6-digit OTP sent to your
                                <strong>{{ $mobile }}</strong>
                            </p>

                            <!-- OTP INPUTS -->
                            <div class="otp-input-wrapper mt-4">
                                @for ($i = 1; $i <= 6; $i++)
                                    <input type="text" maxlength="1" class="otp-input" id="otp{{ $i }}">
                                @endfor
                            </div>

                            <!-- TIMER -->
                            <div class="otp-expire-sec">
                                <p>
                                    OTP will expire in
                                    <span id="timer">02:00</span>
                                </p>
                                <a href="javascript:void(0)" id="resendOtp" class="resend-btn d-none">
                                    Resend OTP
                                </a>
                            </div>

                            <!-- VERIFY -->
                            <button class="otp-btn" id="verifyOtpBtn">
                                Login
                            </button>

                        </div>

                        <!-- FOOTER -->
                        <div class="login-box-bottom-inner-bottom">
                            <a href="#" class="powerby-box">
                                Powered by <img src="{{ asset('images/logo.svg') }}">
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

        const mobile = "{{ $mobile }}";

        $('#verifyOtpBtn').click(function() {

            let otp = '';
            $('.otp-input').each(function() {
                otp += $(this).val();
            });

            if (otp.length !== 6) {
                toastr.error('Enter complete OTP');
                return;
            }

            $.post("{{ route('parent.verifyOtp') }}", {
                mobile: mobile,
                otp: otp
            }, function(res) {

                if (res.status) {
                    window.location.href = res.redirect;
                } else {
                    toastr.error(res.message);
                }

            });
        });

        const inputs = document.querySelectorAll('.otp-input');

        inputs.forEach((input, index) => {

            // Allow only numbers
            input.addEventListener('input', (e) => {
                input.value = input.value.replace(/[^0-9]/g, '');

                // Move to next input
                if (input.value && index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }
            });

            // Move back on backspace
            input.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && !input.value && index > 0) {
                    inputs[index - 1].focus();
                }
            });

            // Paste OTP
            input.addEventListener('paste', (e) => {
                e.preventDefault();
                const pasteData = (e.clipboardData || window.clipboardData)
                    .getData('text')
                    .replace(/[^0-9]/g, '')
                    .slice(0, 6);

                pasteData.split('').forEach((digit, i) => {
                    if (inputs[i]) {
                        inputs[i].value = digit;
                    }
                });

                if (pasteData.length === inputs.length) {
                    inputs[inputs.length - 1].focus();
                }
            });
        });

        let timeLeft = 120; // 2 minutes
        let timerInterval;

        function startOtpTimer() {
            clearInterval(timerInterval);
            timeLeft = 120;

            $('#resendOtp').addClass('d-none');
            $('#verifyOtpBtn').prop('disabled', false);
            $('#timer').text('02:00');

            timerInterval = setInterval(() => {
                let minutes = Math.floor(timeLeft / 60);
                let seconds = timeLeft % 60;

                minutes = minutes < 10 ? '0' + minutes : minutes;
                seconds = seconds < 10 ? '0' + seconds : seconds;

                $('#timer').text(`${minutes}:${seconds}`);

                if (timeLeft <= 0) {
                    clearInterval(timerInterval);
                    $('#timer').text('00:00');
                    $('#resendOtp').removeClass('d-none');
                    $('#verifyOtpBtn').prop('disabled', true);
                }

                timeLeft--;
            }, 1000);
        }

        // Start timer when page loads
        startOtpTimer();

        // Resend OTP click
        $('#resendOtp').click(function() {
            $.post("{{ route('parent.resendOtp') }}", {
                mobile: mobile
            }, function(res) {
                if (res.status) {
                    toastr.success('OTP resent successfully');

                    $('.otp-input').val('');
                    $('.otp-input').first().focus();
                    startOtpTimer();
                } else {
                    toastr.error(res.message);
                }
            });
        });
    </script>


</body>

</html>
