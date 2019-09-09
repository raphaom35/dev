(function ($) {
    wp.customize('matrix_theme_options[logo_text_width]', function (value) {
        value.bind(function (to) {
            $('a#alogo').css('font-size', to + 'px');
        });
    });
    wp.customize('matrix_theme_options[logo_top_spacing]', function (value) {
        value.bind(function (to) {
            $('a#alogo, .custom-logo').each(function () {
                this.style.setProperty('padding-top', to + 'px', 'important');
            });
        });
    });
    wp.customize('matrix_theme_options[logo_bottom_spacing]', function (value) {
        value.bind(function (to) {
            $('a#alogo,.custom-logo').each(function () {
                this.style.setProperty('padding-bottom', to + 'px', 'important');
            });
        });
    });
	wp.customize('background_color', function (value) {
        value.bind(function (to) {
            $('body').css('background-color',to);
            });
    });
	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( 'a#alogo, .site-description' ).css({
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute'
				});
				// Add class for different logo styles if title and description are hidden.
				$( 'body' ).addClass( 'title-tagline-hidden' );
			} else {

				$( 'a#alogo, .site-description' ).css({
					clip: 'auto',
					position: 'relative'
				});
				$( 'a#alogo, .site-description' ).css({
					color: to
				});
				// Add class for different logo styles if title and description are visible.
				$( 'body' ).removeClass( 'title-tagline-hidden' );
			}
		});
	});
    wp.customize('matrix_theme_options[logo_layout]', function (value) {
        value.bind(function (to) {
            if (to == 'right') {
                $('.navbar-header').css('float', to);
                $('.navbar-collapse').css('float', 'left');
            } else {
                $('.navbar-header').css('float', to);
                $('.navbar-collapse').css('float', 'right');
            }
        });
    });
    wp.customize('matrix_theme_options[site_layout]', function (value) {
        value.bind(function (to) {
            if (to != "") {
                $('body').addClass(to);
            } else {
                $('body').removeClass('boxed-page');
            }
        });
    });
    wp.customize('matrix_theme_options[footer_layout]', function (value) {
        value.bind(function (to) {
            $('footer .container .footer-widgets').children().attr('class', 'col-md-' + to);
        });
    });
    wp.customize('matrix_theme_options[headercolorscheme]', function (value) {
        value.bind(function (to) {
            if (to == 'light_header') {
                $('body').addClass(to);
                $('body').removeClass('transparent_header');
            } else if (to == 'transparent_header') {
                $('body').addClass(to);
                $('body').removeClass('light_header');
            } else if (to == '') {
                $('body').removeClass('light_header transparent_header');
            }
        });
    });
    wp.customize('matrix_theme_options[topbar]', function (value) {
        value.bind(function (to) {
            if (to) {
                $('.topbar').hide();
            } else {
                $('.topbar').show();
            }
        });
    });
    /* Slider Options */
    wp.customize('matrix_theme_options[home_slider_enabled]', function (value) {
        value.bind(function (to) {
            if (!to) {
                $('section#home').hide();
            } else {
                $('section#home').show();
            }
        });
    });
    
    /* Service Options */
	wp.customize('matrix_theme_options[home_service_enable]', function (value) {
        value.bind(function (to) {
            if (!to) {
                $('.service').hide();
            } else {
                $('.service').show();
            }
        });
    });
    wp.customize('matrix_theme_options[home_service_title]', function (value) {
        value.bind(function (to) {
            $('h1#service-head').html(to);
        });
    });
    wp.customize('matrix_theme_options[home_service_description]', function (value) {
        value.bind(function (to) {
            $('#service-desc').html(to);
        });
    });
    wp.customize('matrix_theme_options[home_service_column]', function (value) {
        value.bind(function (to) {
            if (6 == to) {
                $('.service-box').removeClass('col-md-4');
                $('.service-box').removeClass('col-md-3');
                $('.seservice-boxrvice').addClass('col-md-6');
            } else if (4 == to) {
                $('.service-box').removeClass('col-md-6');
                $('.service-box').removeClass('col-md-3');
                $('.service-box').addClass('col-md-4');
            } else {
                $('.service-box').removeClass('col-md-4');
                $('.service-box').removeClass('col-md-6');
                $('.service-box').addClass('col-md-3');
            }
        });
    });
    wp.customize('matrix_theme_options[service_icon_1]', function (value) {
        value.bind(function (to) {
            $('#service-icon-1').attr('class', to+' icon-large');
        });
    });
    wp.customize('matrix_theme_options[service_icon_2]', function (value) {
        value.bind(function (to) {
            $('#service-icon-2').attr('class', to+' icon-large');
        });
    });
    wp.customize('matrix_theme_options[service_icon_3]', function (value) {
        value.bind(function (to) {
            $('#service-icon-3').attr('class', to+' icon-large');
        });
    });
    wp.customize('matrix_theme_options[service_icon_4]', function (value) {
        value.bind(function (to) {
            $('#service-icon-4').attr('class', to+' icon-large');
        });
    });
    wp.customize('matrix_theme_options[service_title_1]', function (value) {
        value.bind(function (to) {
            $('#service-title-1').html(to);
        });
    });
    wp.customize('matrix_theme_options[service_title_2]', function (value) {
        value.bind(function (to) {
            $('#service-title-2').html(to);
        });
    });
    wp.customize('matrix_theme_options[service_title_3]', function (value) {
        value.bind(function (to) {
            $('#service-title-3').html(to);
        });
    });
    wp.customize('matrix_theme_options[service_title_4]', function (value) {
        value.bind(function (to) {
            $('#service-title-4').html(to);
        });
    });
    wp.customize('matrix_theme_options[service_text_1]', function (value) {
        value.bind(function (to) {
            $('#service-desc-1').html(to);
        });
    });
    wp.customize('matrix_theme_options[service_text_2]', function (value) {
        value.bind(function (to) {
            $('#service-desc-2').html(to);
        });
    });
    wp.customize('matrix_theme_options[service_text_3]', function (value) {
        value.bind(function (to) {
            $('#service-desc-3').html(to);
        });
    });
    wp.customize('matrix_theme_options[service_text_4]', function (value) {
        value.bind(function (to) {
            $('#service-desc-4').html(to);
        });
    });
    wp.customize('matrix_theme_options[service_link_1]', function (value) {
        value.bind(function (to) {
            $('#service-link-1').attr('href', to);
        });
    });
    wp.customize('matrix_theme_options[service_link_2]', function (value) {
        value.bind(function (to) {
            $('#service-link-2').attr('href', to);
        });
    });
    wp.customize('matrix_theme_options[service_link_3]', function (value) {
        value.bind(function (to) {
            $('#service-link-3').attr('href', to);
        });
    });
    wp.customize('matrix_theme_options[service_link_4]', function (value) {
        value.bind(function (to) {
            $('#service-link-4').attr('href', to);
        });
    });
	
	wp.customize('matrix_theme_options[service_link_1]', function (value) {
        value.bind(function (to) {
            $('#service-link-11').attr('href', to);
        });
    });
    wp.customize('matrix_theme_options[service_link_2]', function (value) {
        value.bind(function (to) {
            $('#service-link-12').attr('href', to);
        });
    });
    wp.customize('matrix_theme_options[service_link_3]', function (value) {
        value.bind(function (to) {
            $('#service-link-13').attr('href', to);
        });
    });
    wp.customize('matrix_theme_options[service_link_4]', function (value) {
        value.bind(function (to) {
            $('#service-link-14').attr('href', to);
        });
    });
    /* Portfolio Options */
	wp.customize('matrix_theme_options[home_portfolio_enable]', function (value) {
        value.bind(function (to) {
            if (!to) {
                $('.full-width-portfolio').hide();
            } else {
                $('.full-width-portfolio').show();
            }
        });
    });
	wp.customize('matrix_theme_options[portfolio_four_column]', function (value) {
        value.bind(function (to) {
            if (to) {
                $('.wl-gallery').css('width','24.0%');
            } else {
                $('.wl-gallery').css('width','50%');
            }
        });
    });

    /* Home blog */
	wp.customize('matrix_theme_options[home_blog_enable]', function (value) {
        value.bind(function (to) {
            if (!to) {
                $('#home-blog').hide();
            } else {
                $('#home-blog').show();
            }
        });
    });
    wp.customize('matrix_theme_options[home_blog_title]', function (value) {
        value.bind(function (to) {
            $('h1#blog-heading').html(to);
        });
    });
    wp.customize('matrix_theme_options[home_blog_description]', function (value) {
        value.bind(function (to) {
            $('#blog-desc').html(to);
        });
    });
    /* Footer Callout */
	wp.customize('matrix_theme_options[home_callout_enable]', function (value) {
        value.bind(function (to) {
            if (!to) {
                $('.purchase').hide();
            } else {
                $('.purchase').show();
            }
        });
    });
    wp.customize('matrix_theme_options[callout_bg_image]', function (value) {
        value.bind(function (to) {
            $('.purchase').css('background-image', 'url(' + to + ')');
        });
    });
    wp.customize('matrix_theme_options[anim_texts]', function (value) {
        value.bind(function (to) {
            var anims = to.split(",");
            var str = '';
            $.each(anims, function (t, anim) {
                str += '<span>' + anim + '</span>';
            });
            $('.texts').html(str);
        });
    });
    wp.customize('matrix_theme_options[home_callout_description]', function (value) {
        value.bind(function (to) {
            $('#banner_desc').html(to);
        });
    });
    /* banner buttons */
    wp.customize('matrix_theme_options[home_callout_btn_1]', function (value) {
        value.bind(function (to) {
            $('#banner_btn_1 span').html(to);
        });
    });
    wp.customize('matrix_theme_options[home_callout_btn1_link]', function (value) {
        value.bind(function (to) {
            $('a#banner_btn_1').attr('href', to);
        });
    });
    wp.customize('matrix_theme_options[home_callout_btn1_icon]', function (value) {
        value.bind(function (to) {
            $('i#banner_icon_1').attr('class', to);
        });
    });

    wp.customize('matrix_theme_options[home_callout_btn_2]', function (value) {
        value.bind(function (to) {
            $('a#banner_btn_2 span').html(to);
        });
    });
    wp.customize('matrix_theme_options[home_callout_btn2_link]', function (value) {
        value.bind(function (to) {
            $('a#banner_btn_2').attr('href', to);
        });
    });
    wp.customize('matrix_theme_options[home_callout_btn2_icon]', function (value) {
        value.bind(function (to) {
            $('i#banner_icon_2').attr('class', to);
        });
    });
    /* Social Options */
    wp.customize('matrix_theme_options[social_media_header]', function (value) {
        value.bind(function (to) {
            if (!to) {
                $('#social-list-header').hide();
            } else {
                $('#social-list-header').show();
            }
        });
    });
    wp.customize('matrix_theme_options[social_media_footer]', function (value) {
        value.bind(function (to) {
            if (!to) {
                $('#social-list-footer').hide();
            } else {
                $('#social-list-footer').show();
            }
        });
    });
    wp.customize('matrix_theme_options[social_facebook_link]', function (value) {
        value.bind(function (to) {
            $('a.facebook').attr('href', to);
        });
    });
    wp.customize('matrix_theme_options[social_twitter_link]', function (value) {
        value.bind(function (to) {
            $('a.twitter').attr('href', to);
        });
    });
    wp.customize('matrix_theme_options[social_linkedin_link]', function (value) {
        value.bind(function (to) {
            $('a.linkdin').attr('href', to);
        });
    });
    wp.customize('matrix_theme_options[social_instagram_link]', function (value) {
        value.bind(function (to) {
            $('a.instgram').attr('href', to);
        });
    });
    wp.customize('matrix_theme_options[social_google_plus_link]', function (value) {
        value.bind(function (to) {
            $('a.google').attr('href', to);
        });
    });
    wp.customize('matrix_theme_options[social_dribble_link]', function (value) {
        value.bind(function (to) {
            $('a.dribbble').attr('href', to);
        });
    });
    /* Contact Options */
    wp.customize('matrix_theme_options[contact_info_header]', function (value) {
        value.bind(function (to) {
            if (!to) {
                $('.contact-details').hide();
            } else {
                $('.contact-details').show();
            }
        });
    });
    wp.customize('matrix_theme_options[contact_address]', function (value) {
        value.bind(function (to) {
            $('a#con_address span').html(to);
        });
    });
    wp.customize('matrix_theme_options[contact_email]', function (value) {
        value.bind(function (to) {
            $('a#con_email span').html(to);
            $('a#con_email').attr('href', 'mailto:' + to);
        });
    });
    wp.customize('matrix_theme_options[contact_phone]', function (value) {
        value.bind(function (to) {
            $('a#con_phone span').html(to);
            $('a#con_phone').attr('href', 'tel:' + to);
        });
    });
    /* Footer Copyright Text */
    wp.customize('matrix_theme_options[copyright_text_footer]', function (value) {
        value.bind(function (to) {
            if (!to) {
                $('.copyright-section .row div:first-child').hide();
            } else {
                $('.copyright-section .row div:first-child').show();
            }
        });
    });
    wp.customize('matrix_theme_options[footer_copyright_text]', function (value) {
        value.bind(function (to) {
            $('#copyright-text').html(to);
        });
    });
    wp.customize('matrix_theme_options[created_by_matrix_text]', function (value) {
        value.bind(function (to) {
            $('a#copyright-link').html(to);
        });
    });
    wp.customize('matrix_theme_options[created_by_link]', function (value) {
        value.bind(function (to) {
            $('a#copyright-link').attr('href', to);
        });
    });
	wp.customize('matrix_theme_options[home_extra_title]', function (value) {
        value.bind(function (to) {
            $('#extra_title').html(to);
        });
    });
	wp.customize('matrix_theme_options[home_extra_description]', function (value) {
        value.bind(function (to) {
            $('#extra_desc').html(to);
        });
    });
})(jQuery);