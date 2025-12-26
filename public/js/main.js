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


