/* ====== Index ======

1. SCROLLBAR SIDEBAR
2. MOBILE OVERLAY
3. SIDEBAR MENU
4. SIDEBAR TOGGLE FOR MOBILE
5. SIDEBAR TOGGLE FOR VARIOUS SIDEBAR LAYOUT
6. TODO LIST
7. RIGHT SIDEBAR
8. OFFCANVAS
9. DROPDOWN NOTIFY
10. REFRESS BUTTON
11. NAVBAR TRANSPARENT SCROLL
12. NAVBAR SEARCH
====== End ======*/

$(document).ready(function () {
    "use strict";
    /*======== 2. MOBILE OVERLAY ========*/
    if ($(window).width() < 768) {
        $(".sidebar-toggle").on("click", function () {
            $("body").css("overflow", "hidden");
            $("body").prepend('<div class="mobile-sticky-body-overlay"></div>');
        });

        $(document).on("click", ".mobile-sticky-body-overlay", function (e) {
            $(this).remove();
            $("#body")
                .removeClass("sidebar-mobile-in")
                .addClass("sidebar-mobile-out");
            $("body").css("overflow", "auto");
        });
    }

    /*======== 3. SIDEBAR MENU ========*/
    $("#sidebar-menu > li").click(function () {
        const tagCurrent = $(this);
        const isSubmenu = tagCurrent.hasClass("has-sub");
        tagCurrent
            .siblings()
            .removeClass("expand active")
            .children()
            .removeClass("show");
        tagCurrent.addClass("active");
        if (isSubmenu) {
            const isShow = $("ul", tagCurrent).hasClass("show");
            if (isShow) {
                tagCurrent.addClass("expand");
            }
            else{
              tagCurrent.removeClass("expand");
            }
            return;
        }
        $("#sidebar-menu .has-sub li").removeClass("active");
    });

    $("#sidebar-menu .has-sub li").click(function () {
        const tagCurrent = $(this);
        tagCurrent.siblings().removeClass("active");
        tagCurrent.parent().parent().addClass("expand");
        tagCurrent.addClass("active");
    });

    /*======== 4. SIDEBAR TOGGLE FOR MOBILE ========*/
    if ($(window).width() < 768) {
        $(document).on("click", ".sidebar-toggle", function (e) {
            e.preventDefault();
            var min = "sidebar-mobile-in",
                min_out = "sidebar-mobile-out",
                body = "#body";
            $(body).hasClass(min)
                ? $(body).removeClass(min).addClass(min_out)
                : $(body).addClass(min).removeClass(min_out);
        });
    }

    /*======== 5. SIDEBAR TOGGLE FOR VARIOUS SIDEBAR LAYOUT ========*/
    var body = $("#body");
    if ($(window).width() >= 768) {
        if (body.hasClass("sidebar-mobile-in sidebar-mobile-out")) {
            body.removeClass("sidebar-mobile-in sidebar-mobile-out");
        }

        window.isMinified = false;
        window.isCollapsed = false;

        $("#sidebar-toggler").on("click", function () {
            if (
                body.hasClass("sidebar-fixed-offcanvas") ||
                body.hasClass("sidebar-static-offcanvas")
            ) {
                $(this)
                    .addClass("sidebar-offcanvas-toggle")
                    .removeClass("sidebar-toggle");
                if (window.isCollapsed === false) {
                    body.addClass("sidebar-collapse");
                    window.isCollapsed = true;
                    window.isMinified = false;
                } else {
                    body.removeClass("sidebar-collapse");
                    body.addClass("sidebar-collapse-out");
                    setTimeout(function () {
                        body.removeClass("sidebar-collapse-out");
                    }, 300);
                    window.isCollapsed = false;
                }
            }

            if (
                body.hasClass("sidebar-fixed") ||
                body.hasClass("sidebar-static")
            ) {
                $(this)
                    .addClass("sidebar-toggle")
                    .removeClass("sidebar-offcanvas-toggle");
                if (window.isMinified === false) {
                    body.removeClass(
                        "sidebar-collapse sidebar-minified-out"
                    ).addClass("sidebar-minified");
                    window.isMinified = true;
                    window.isCollapsed = false;
                } else {
                    body.removeClass("sidebar-minified");
                    body.addClass("sidebar-minified-out");
                    window.isMinified = false;
                }
            }
        });
    }

    if ($(window).width() >= 768 && $(window).width() < 992) {
        if (body.hasClass("sidebar-fixed") || body.hasClass("sidebar-static")) {
            body.removeClass("sidebar-collapse sidebar-minified-out").addClass(
                "sidebar-minified"
            );
            window.isMinified = true;
        }
    }

    /*======== 7. RIGHT SIDEBAR ========*/
    if ($(window).width() < 1025) {
        body.addClass("right-sidebar-toggoler-out");

        var btnRightSidebarToggler = $(".btn-right-sidebar-toggler");

        btnRightSidebarToggler.on("click", function () {
            if (!body.hasClass("right-sidebar-toggoler-out")) {
                body.addClass("right-sidebar-toggoler-out").removeClass(
                    "right-sidebar-toggoler-in"
                );
            } else {
                body.addClass("right-sidebar-toggoler-in").removeClass(
                    "right-sidebar-toggoler-out"
                );
            }
        });
    }

    var navRightSidebarLink = $(".nav-right-sidebar .nav-link");

    navRightSidebarLink.on("click", function () {
        if (!body.hasClass("right-sidebar-in")) {
            body.addClass("right-sidebar-in").removeClass("right-sidebar-out");
        } else if ($(this).hasClass("show")) {
            body.addClass("right-sidebar-out").removeClass("right-sidebar-in");
        }
    });

    var cardClosebutton = $(".card-right-sidebar .close");
    cardClosebutton.on("click", function () {
        body.removeClass("right-sidebar-in").addClass("right-sidebar-out");
    });

    /*======== 9. DROPDOWN NOTIFY ========*/
    var dropdownToggle = $(".notify-toggler");
    var dropdownNotify = $(".dropdown-notify");

    if (dropdownToggle.length !== 0) {
        dropdownToggle.on("click", function () {
            if (!dropdownNotify.is(":visible")) {
                dropdownNotify.fadeIn(5);
            } else {
                dropdownNotify.fadeOut(5);
            }
        });

        $(document).mouseup(function (e) {
            if (
                !dropdownNotify.is(e.target) &&
                dropdownNotify.has(e.target).length === 0
            ) {
                dropdownNotify.fadeOut(5);
            }
        });
    }
    /*======== 11. NAVBAR TRANSPARENT SCROLL ========*/
    var body = $("#body");
    var navbar = $("#navbar");
    $(window).scroll(function () {
        if (
            body.hasClass("navbar-fixed") &&
            $(this).width() > 765 &&
            navbar.hasClass("navbar-transparent")
        ) {
            var scroll = $(window).scrollTop();

            if (scroll >= 10) {
                navbar.addClass("navbar-light").addClass("navbar-transparent");
            } else {
                navbar
                    .removeClass("navbar-light")
                    .addClass("navbar-transparent");
            }
        }
    });
});
