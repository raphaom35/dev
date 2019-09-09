/* ----------------- Start JS Document ----------------- */

var $ = jQuery.noConflict();

// Page Loader
$(window).load(function () {
    "use strict";
    $('#loader').fadeOut();
});

$(window).load(function(){
	$('form input:not(.actions input,input[type=number],input[type=submit]), form textarea, form select:not(#billing_country)').addClass('form-control');
	
	/* put compare, addToWhishList and add to cart button in same line in product list mode */
        if($('.gridlist-buttonwrap').length==0){
		$('.add_to_cart_button.ajax_add_to_cart').wrap('<div></div>');
	}	
	
	/* add tooltip to compre and quick view button in product grid view */
	$('.products.grid,.related.products').find('.compare.button, .button.yith-wcqv-button').each(function(){ 
		jQuery(this).attr('data-toggle','tooltip'); 
		$(this).attr('data-placement','bottom');
		if($(this).hasClass('compare')){
			$(this).attr('data-original-title','Add to Compare'); 
		}
		if($(this).hasClass('yith-wcqv-button')){
			$(this).attr('data-original-title','Quick View'); 
		}
	});
		
	// TOOLTIP
	$('.products.grid,.related.products').tooltip({
	  selector: "[data-toggle=tooltip]",
	  container: "body"
	})
});
$(document).ready(function ($) {
    "use strict";
	/* Woocommerce sidebar category collapse */
	$('.woocommerce .product-categories').dcAccordion({
        saveState: false,
        autoExpand: true,
        showCount: true,
    });
	$('.dcjq-icon').click(function(){
		$(this).toggleClass('less');
	});
    /*----------------------------------------------------*/
    /*	Nice-Scroll
     /*----------------------------------------------------*/

    $("html").niceScroll({
        scrollspeed: 100,
        mousescrollstep: 38,
        cursorwidth: 5,
        cursorborder: 0,
        cursorcolor: '#333',
        autohidemode: true,
        zindex: 999999999,
        horizrailenabled: false,
        cursorborderradius: 0,
    });

    /*----------------------------------------------------*/
    /*	Nav Menu & Search
     /*----------------------------------------------------*/

    $(".nav > li:has(ul)").addClass("drop");
    $(".nav > li.drop > ul").addClass("dropdown");
    $(".nav > li.drop > ul.dropdown ul").addClass("sup-dropdown");

    $('.show-search').click(function () {
        $('.search-form').fadeIn(300);
        $('.search-form input').focus();
    });
    $('.search-form input').blur(function () {
        $('.search-form').fadeOut(300);
    });

    /*----------------------------------------------------*/
    /*	Back Top Link
     /*----------------------------------------------------*/
	
    var offset = 200;
    var duration = 500;
    $(window).scroll(function () {
        if ($(this).scrollTop() > offset) {
            $('.back-to-top').fadeIn(400);
        } else {
            $('.back-to-top').fadeOut(400);
        }
    });
    $('.back-to-top').click(function (event) {
        event.preventDefault();
        $('html, body').animate({scrollTop: 0}, 600);
        return false;
    })
	/*---------------------------------------------------
	*Update Wishlist on heaeder
	*---------------------------------------------------- */
$( document ).ready( function(){
    var update_wishlist_count = function() {
        $.ajax({
            beforeSend: function () {

            },
            complete  : function () {

            },
            data      : {
                action: 'matrix_update_wishlist_count'
            },
            success   : function (data) {
				console.log(data);
                jQuery('#top-wishlist a span').html(data);
            },

            url: yith_wcwl_l10n.ajax_url
        });
    };

    $('body').on( 'added_to_wishlist removed_from_wishlist', update_wishlist_count );
} );
    /*----------------------------------------------------*/
    /*	Sliders & Carousel
     /*----------------------------------------------------*/

    ////------- Touch Slider
    var time = 4.4,
        $progressBar,
        $bar,
        $elem,
        isPause,
        tick,
        percentTime;
    $('.touch-slider').each(function () {
        var owl = jQuery(this),
            sliderNav = $(this).attr('data-slider-navigation'),
            sliderPag = $(this).attr('data-slider-pagination'),
            sliderProgressBar = $(this).attr('data-slider-progress-bar');

        if (sliderNav == 'false' || sliderNav == '0') {
            var returnSliderNav = false
        } else {
            var returnSliderNav = true
        }

        if (sliderPag == 'true' || sliderPag == '1') {
            var returnSliderPag = true
        } else {
            var returnSliderPag = false
        }

        if (sliderProgressBar == 'true' || sliderProgressBar == '1') {
            var returnSliderProgressBar = progressBar
            var returnAutoPlay = false
        } else {
            var returnSliderProgressBar = false
            var returnAutoPlay = true
        }

        owl.owlCarousel({
            navigation: returnSliderNav,
            pagination: returnSliderPag,
            slideSpeed: 400,
            paginationSpeed: 400,
            lazyLoad: true,
            singleItem: true,
            autoHeight: true,
            autoPlay: returnAutoPlay,
            stopOnHover: returnAutoPlay,
            transitionStyle: "fade",
            afterInit: returnSliderProgressBar,
            afterMove: moved,
            startDragging: pauseOnDragging
        });

    });

    function progressBar(elem) {
        $elem = elem;
        buildProgressBar();
        start();
    }

    function buildProgressBar() {
        $progressBar = $("<div>", {
            id: "progressBar"
        });
        $bar = $("<div>", {
            id: "bar"
        });
        $progressBar.append($bar).prependTo($elem);
    }

    function start() {
        percentTime = 0;
        isPause = false;
        tick = setInterval(interval, 10);
    };

    function interval() {
        if (isPause === false) {
            percentTime += 1 / time;

        }
    }

    function pauseOnDragging() {
        isPause = true;
    }

    function moved() {
        clearTimeout(tick);
        start();
    }


    /*----------------------------------------------------*/
    /*	Css3 Transition
     /*----------------------------------------------------*/

    $('*').each(function () {
        if ($(this).attr('data-animation')) {
            var $animationName = $(this).attr('data-animation'),
                $animationDelay = "delay-" + $(this).attr('data-animation-delay');
            $(this).appear(function () {
                $(this).addClass('animated').addClass($animationName);
                $(this).addClass('animated').addClass($animationDelay);
            });
        }
    });

    /*----------------------------------------------------*/
    /*	Nivo Lightbox
     /*----------------------------------------------------*/

    $('.lightbox').nivoLightbox({
        effect: 'fadeScale',
        keyboardNav: true,
        errorMessage: 'The requested content cannot be loaded. Please try again later.'
    });

    /*----------------------------------------------------*/
    /*	Change Slider Nav Icons
     /*----------------------------------------------------*/

    $('.touch-slider').find('.owl-prev').html('<i class="fa fa-angle-left"></i>');
    $('.touch-slider').find('.owl-next').html('<i class="fa fa-angle-right"></i>');

    $('.read-more').append('<i class="fa fa-angle-right"></i>');

    /*----------------------------------------------------*/
    /*	Tooltips & Fit Vids & Parallax & Text Animations
     /*----------------------------------------------------*/

    $('.itl-tooltip').tooltip();

    $('.bg-parallax').each(function () {
        $(this).parallax("30%", 0.2);
    });

    $('.tlt').textillate({
        loop: true,
        in: {
            effect: 'fadeInUp',
            delayScale: 2,
            delay: 50,
            sync: false,
            shuffle: false,
            reverse: true,
        },
        out: {
            effect: 'fadeOutUp',
            delayScale: 2,
            delay: 50,
            sync: false,
            shuffle: false,
            reverse: true,
        },
    });

	/* Slick Nav */
	$('.wpb-mobile-menu').slicknav({
	  prependTo: '.abcd',
	  parentTag: 'matrix',
	  allowParentLinks: true,
	  duplicate: false,
	  label: '',
	  closedSymbol: '<i class="fa fa-angle-right"></i>',
	  openedSymbol: '<i class="fa fa-angle-down"></i>',
	});
	
});
/* ----------------- End JS Document ----------------- */
