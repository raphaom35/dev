jQuery( document ).ready(function($) {
	jQuery('.layer-slider').flexslider({
	    animation: event_slider_value.event_animation_effect,
	    animationLoop: true,
	    slideshow: true,
	    slideshowSpeed: event_slider_value.event_slideshowSpeed,
	    animationSpeed: event_slider_value.event_animationSpeed,
	    direction: event_slider_value.event_direction,
	    smoothHeight: true
	});

	jQuery('.client-slider').flexslider({
		animation: "slide",
		animationLoop: true,
		slideshow: true,
		controlNav: false,
		directionNav: false,
		smoothHeight: false,
		slideshowSpeed: 5000,
		animationSpeed: 2000,
		itemWidth: 200,
		itemMargin: 5,
		move: 1
	});

	jQuery('.testimonial-slider').flexslider({
		animation: "slide",
		animationLoop: true,
		slideshow: true,
		directionNav: false,
		smoothHeight: false,
		slideshowSpeed: 7000,
		animationSpeed: 2000,
	});
});
