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
                            <strong>{{ $identifier }}</strong>
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

const identifier = "{{ $identifier }}";

/* OTP INPUT AUTO MOVE */
$('.otp-input').on('keyup', function (e) {
    if (this.value.length === 1) {
        $(this).next('.otp-input').focus();
    }
});

/* VERIFY OTP */
$('#verifyOtpBtn').click(function () {

    let otp = '';
    $('.otp-input').each(function () {
        otp += $(this).val();
    });

    if (otp.length !== 6) {
        toastr.error('Enter complete OTP');
        return;
    }

    $.post('{{ route("student.verifyOtp") }}', {
        identifier: identifier,
        otp: otp
    }, function (res) {
        if (res.status) {
            window.location.href = res.redirect;
        } else {
            toastr.error(res.message);
        }
    });
});

/* TIMER */
let time = 120;
let timer = setInterval(() => {
    time--;

    let min = Math.floor(time / 60);
    let sec = time % 60;

    $('#timer').text(
        String(min).padStart(2, '0') + ':' +
        String(sec).padStart(2, '0')
    );

    if (time <= 0) {
        clearInterval(timer);
        $('#resendOtp').removeClass('d-none');
    }
}, 1000);

/* RESEND OTP */
$('#resendOtp').on('click', function (e) {
    e.preventDefault();

    $.post('{{ route("student.sendOtp") }}', {
        identifier: identifier
    })
    .done(function (res) {
        toastr.success('OTP resent');

        time = 120;
        $('#resendOtp').addClass('d-none');
    })
    .fail(function () {
        toastr.error('CSRF error – please refresh once');
    });
});

</script>

</body>
</html>
