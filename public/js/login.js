$(document).ready(function () {

    // CSRF setup
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // SAFE click binding (prevents stack overflow)
    $(document).off('click', '#sendOtpBtn')
        .on('click', '#sendOtpBtn', function (e) {

        e.preventDefault();

        let identifier = $('#identifier').val().trim();

        if (!identifier) {
            toastr.error('Please enter email or mobile');
            return;
        }

        $.post('/send-otp', { identifier }, function (res) {

            // ❌ Not registered → Signup
            if (res.status === false && res.redirect) {
                window.location.href = res.redirect;
                return;
            }

            // ✅ Registered → OTP page
            if (res.status === true && res.redirect) {
                window.location.href = res.redirect;
                return;
            }

            toastr.error('Something went wrong');
        });
    });
});


// //#parnet-login.js
// $.ajaxSetup({
//     headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     }
// });

// /* ======================
//    SEND OTP
// ====================== */
// $('#sendOtpBtn').on('click', function () {

//     let identifier = $('#identifier').val();

//     if (!identifier) {
//         toastr.error('Enter mobile number');
//         return;
//     }

//     $.post('/parent/send-otp', {
//         mobile: identifier
//     }, function (res) {

//         if (res.status) {
//             toastr.success(res.message);

//             $('#otpBox').removeClass('d-none');
//             $('#verifyOtpBtn').removeClass('d-none');
//             $('#sendOtpBtn').addClass('d-none');

//         } else {
//             toastr.error(res.message);
//         }
//     });
// });

// /* ======================
//    VERIFY OTP
// ====================== */
// $('#verifyOtpBtn').on('click', function () {

//     $.post('/parent/verify-otp', {
//         mobile: $('#identifier').val(),
//         otp: $('#otp').val()
//     }, function (res) {

//         if (res.status) {
//             window.location.href = res.redirect;
//         } else {
//             toastr.error(res.message);
//         }
//     });
// });


