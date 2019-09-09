var $ = jQuery.noConflict();

// Page Loader
$(window).load(function () {
    "use strict";
    $('#loader').fadeOut();
});

$(document).ready(function ($) {
    "use strict";
////------- Custom Carousel
    var caroufredsel = function () {
        jQuery('#matrix_blog_section').carouFredSel({
            width: '100%',
            responsive: true,
            scroll: {
                items: 1,
                duration: 2000,
                timeoutDuration: 2000
            },
            circular: true,
            direction: 'left',
            scroll: {
                items: 1,
                duration: 1250,
                timeoutDuration: 2500,
                easing: 'swing',
                pauseOnHover: 'immediate'
            },
            items: {
                height: 'variable',
                visible: {
                    min: 1,
                    max: 3
                },
            },
            prev: '#port-prev1',
            next: '#port-next1',
            auto: {
                play: true
            }
        });
    }
    jQuery(window).resize(function () {
        caroufredsel();
    });
    jQuery(window).load(function () {
        caroufredsel();
    });
});