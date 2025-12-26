/**
 * MAIN UI JS
 * Safe bindings, no recursion, no stack overflow
 */

$(document).ready(function () {

    /* -------------------------------------------------
     * SIDEBAR TOGGLE (DESKTOP + MOBILE)
     * ------------------------------------------------- */
    $(document).off('click', '.sidebar-trigger')
        .on('click', '.sidebar-trigger', function (e) {
            e.preventDefault();

            if ($(window).width() >= 993) {
                // Desktop
                $(".dashboardSidebar").toggleClass("minimiseBar");
                $(".dashboardPagesContent").toggleClass("minimiseBar");
            } else {
                // Mobile
                $(".dashboardSidebar").toggleClass("open");
                $(".ddashboardSidebarOverlay").toggleClass("open");
                $("body").css("overflow", "hidden");
            }
        });

    /* -------------------------------------------------
     * SIDEBAR OVERLAY CLOSE (MOBILE)
     * ------------------------------------------------- */
    $(document).off('click', '.ddashboardSidebarOverlay')
        .on('click', '.ddashboardSidebarOverlay', function () {
            if ($(window).width() <= 992) {
                $(".dashboardSidebar").removeClass("open");
                $(".ddashboardSidebarOverlay").removeClass("open");
                $("body").css("overflow", "auto");
            }
        });

    /* -------------------------------------------------
     * SIDEBAR MENU DROPDOWN DETECTION
     * ------------------------------------------------- */
    $(".dashboardSidebarMenu ul li ul")
        .closest("ul")
        .parent("li")
        .addClass('dropdownMenuItem');

    /* -------------------------------------------------
     * SIDEBAR MENU TOGGLE (STOP BUBBLING)
     * ------------------------------------------------- */
    $(document).off('click', '.dashboardSidebarMenu ul li')
        .on('click', '.dashboardSidebarMenu ul li', function (e) {
            e.stopPropagation();

            $(this).toggleClass("show");
            $('.dashboardSidebarMenu ul li').not(this).removeClass('show');
        });

    /* -------------------------------------------------
     * WEB HEADER MENU (DESKTOP NAV)
     * ------------------------------------------------- */
    $(".web-header .navbar .navbar-nav li ul")
        .closest("ul")
        .parent("li")
        .addClass('dropdown_menu');

    $(document).off('click', '.web-header .navbar .navbar-nav li')
        .on('click', '.web-header .navbar .navbar-nav li', function (e) {
            e.stopPropagation();

            $(this).toggleClass("curent");
            $('.web-header .navbar .navbar-nav li').not(this).removeClass('curent');
        });

    /* -------------------------------------------------
     * WINDOW RESIZE FIX (CLEAN STATES)
     * ------------------------------------------------- */
    $(window).on('resize', function () {
        if ($(window).width() > 992) {
            $(".dashboardSidebar").removeClass("open");
            $(".ddashboardSidebarOverlay").removeClass("open");
            $("body").css("overflow", "auto");
        }
    });

});



$(".sidebar-trigger").click(function () {
  if ($(window).width() >= 993) {
    $(".dashboardSidebar").toggleClass("minimiseBar");
    $(".dashboardPagesContent").toggleClass("minimiseBar");
  }
});

$(".dashboardSidebarMenu ul li ul").find("li").closest("ul").parent("li").addClass('dropdownMenuItem');
$(".dashboardSidebarMenu ul li").click(function () {
  $(this).toggleClass("show");
  $('.dashboardSidebarMenu ul li').not($(this)).removeClass('show');
});
// menu bar

/*$(".sidebar-trigger ").click(function () {
   $(".dashboardSidebar").toggleClass("open");
   $(".ddashboardSidebarOverlay").toggleClass("open");
   $("body").css("overflow", "hidden");
 });
 $(".ddashboardSidebarOverlay").click(function () {
   $(".ddashboardSidebarOverlay").removeClass("open");
   $(".dashboardSidebar").removeClass("open");
   $("body").css("overflow", "auto");
 });

$(".menu_close_btn").click(function () {
   $(".navbar-collapse").removeClass("menu-visible");
   $(".navbar-collapse").removeClass("show");
   $(".menu_overlay").removeClass("menu-visible");
   $("body").css("overflow", "auto");
 });*/

$(".sidebar-trigger").click(function () {
  if ($(window).width() <= 992) {
    $(".dashboardSidebar").toggleClass("open");
    $(".ddashboardSidebarOverlay").toggleClass("open");
    $("body").css("overflow", "hidden");
  }
});
$(".ddashboardSidebarOverlay").click(function () {
  if ($(window).width() <= 992) {
    $(".dashboardSidebar").removeClass("open");
    $(".ddashboardSidebarOverlay").removeClass("open");
    $("body").css("overflow", "auto");
  }
});



$(".web-header .navbar .navbar-nav li ul").find("li").closest("ul").parent("li").addClass('dropdown_menu');
$(".web-header .navbar .navbar-nav li").click(function () {
  $(this).toggleClass("curent");
  $('.web-header .navbar .navbar-nav li').not($(this)).removeClass('curent');
});


// tab js

$('.tab-menu li a').on('click', function () {
  var target = $(this).attr('data-rel');
  $('.tab-menu li a').removeClass('active');
  $(this).addClass('active');
  $("#" + target).fadeIn('slow').siblings(".tab-box").hide();
  return false;
});

// change profile

$(document).ready(function() {


    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.profile-pic').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }


    $(".file-upload").on('change', function(){
        readURL(this);
    });

    $(".upload-button").on('click', function() {
       $(".file-upload").click();
    });
});
