jQuery(function ($) {
    "use strict";


    /*--scroll to top on refresh and init fullpage plugin--*/
    $(function () {
        $(this).scrollTop(0);
        $('#fullpage').fullpage();
    });

    /*--extend sidemenu on hover--*/
    $('#mySidenav').hover(function () {
        $(this).stop().animate({
            width: "290px"
        }, 100, "linear");
    }, function () {
        $(this).animate({
            width: "80px"
        }, 100, "linear");
    });

    $('#mySidenav').hover(function () {
        $('div.sidenav p').removeClass('hidden fadeOutLeft').addClass('fadeInLeft');
    }, function () {
        $('div.sidenav p').addClass('fadeOutLeft')
    });



});
