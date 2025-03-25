import $ from 'jquery';

window.$ = $;
window.jQuery = $;



(function ($) {
	"use strict";

	// preloader
	$('#xb-loadding').delay().fadeOut();

	// back to top - start
	// --------------------------------------------------
	$(window).scroll(function () {
		if ($(this).scrollTop() > 500) {
			$('.xb-backtotop').addClass('active');
		} else {
			$('.xb-backtotop').removeClass('active');
		}
	});
	$(function () {
		$(".scroll").on('click', function () {
			$("html,body").animate({ scrollTop: 0 }, "slow");
			return false
		});
	});
	// back to top - end
	// --------------------------------------------------

	// sticky header
	if ($('.stricky').length) {
		$('.stricky').addClass('original').clone(true).insertAfter('.stricky').addClass('stricked-menu').removeClass('original');
	}
	$(window).on('scroll', function () {
		if ($('.stricked-menu').length) {
			var headerScrollPos = 100;
			var stricky = $('.stricked-menu');
			if ($(window).scrollTop() > headerScrollPos) {
				stricky.addClass('stricky-fixed');
			} else if ($(this).scrollTop() <= headerScrollPos) {
				stricky.removeClass('stricky-fixed');
			}
		}
	});

	//=======================
	// header search
	$(".header-search-btn").on("click", function (e) {
		e.preventDefault();
		$(".header-search-form-wrapper").addClass("open");
		$('.header-search-form-wrapper input[type="search"]').focus();
		$('.body-overlay').addClass('active');
	});
	$(".xb-search-close").on("click", function (e) {
		e.preventDefault();
		$(".header-search-form-wrapper").removeClass("open");
		$("body").removeClass("active");
		$('.body-overlay').removeClass('active');
	});

	// sidebar info start
	// --------------------------------------------------
	$('.sidebar-menu-close, .body-overlay').on('click', function () {
		$('.offcanvas-sidebar').removeClass('active');
		$('.body-overlay').removeClass('active');
	});

	$('.offcanvas-sidebar-btn').on('click', function () {
		$('.offcanvas-sidebar').addClass('active');
		$('.body-overlay').addClass('active');
	});

	$('.body-overlay').on('click', function () {
		$(this).removeClass('active');
		$(".header-search-form-wrapper").removeClass("open");
	});


	// mobile menu
	// --------------------------------------------------
	$('.xb-nav-hidden li.menu-item-has-children > a').append('<span class="xb-menu-toggle"></span>');
	$('.xb-header-menu li.menu-item-has-children, .xb-menu-primary li.menu-item-has-children').append('<span class="xb-menu-toggle"></span>');
	$('.xb-menu-toggle').on('click', function () {
		if (!$(this).hasClass('active')) {
			$(this).closest('ul').find('.xb-menu-toggle.active').toggleClass('active');
			$(this).closest('ul').find('.sub-menu.active').toggleClass('active').slideToggle();
		}
		$(this).toggleClass('active');
		$(this).closest('.menu-item').find('> .sub-menu').toggleClass('active');
		$(this).closest('.menu-item').find('> .sub-menu').slideToggle();
	});

	$('.xb-nav-hidden li.menu-item-has-children > a').click(function (e) {
		var target = $(e.target);
		if ($(this).attr('href') === '#' && !(target.is('.xb-menu-toggle'))) {
			e.stopPropagation();
			if (!$(this).find('.xb-menu-toggle').hasClass('active')) {
				$(this).closest('ul').find('.xb-menu-toggle.active').toggleClass('active');
				$(this).closest('ul').find('.sub-menu.active').toggleClass('active').slideToggle();
			}
			$(this).find('.xb-menu-toggle').toggleClass('active');
			$(this).closest('.menu-item').find('> .sub-menu').toggleClass('active');
			$(this).closest('.menu-item').find('> .sub-menu').slideToggle();
		}
	});
	$(".xb-nav-mobile").on('click', function () {
		$(this).toggleClass('active');
		$('.xb-header-menu').toggleClass('active');
	});

	$(".xb-menu-close, .xb-header-menu-backdrop").on('click', function () {
		$(this).removeClass('active');
		$('.xb-header-menu').removeClass('active');
	});
	/* End Menu Mobile */


	//data background
	$("[data-background]").each(function () {
		$(this).css("background-image", "url(" + $(this).attr("data-background") + ") ")
	})

	// data bg color
	$("[data-bg-color]").each(function () {
		$(this).css("background-color", $(this).attr("data-bg-color"));

	});

	function wowAnimation() {
		var wow = new WOW({
			boxClass: 'wow',
			animateClass: 'animated',
			offset: 0,
			mobile: false,
			live: true
		});
		wow.init();
	}
	wowAnimation();

	// xbo counter start
	if ($(".xbo").length) {
		$('.xbo').appear();
		$(document.body).on('appear', '.xbo', function (e) {
			var odo = $(".xbo");
			odo.each(function () {
				var countNumber = $(this).attr("data-count");
				$(this).html(countNumber);
			});
			window.xboOptions = {
				format: 'd',
			};
		});
	}
	// xbo counter end

	// isotop
	/*$('.grid').imagesLoaded(function () {
		// init Isotope
		var $grid = $('.grid').isotope({
			itemSelector: '.grid-item',
			percentPosition: true,
			masonry: {
				// use outer width of grid-sizer for columnWidth
				columnWidth: '.grid-item',
			}
		});
	});*/

	// brand slider
	var slider = new Swiper('.brand-slider .swiper-container', {
		slidesPerView: 7,
		roundLengths: true,
		loop: true,
		centeredSlides: true,
		loopAdditionalSlides: 30,
		watchSlidesVisibility: true,
		slideVisibleClass: 'swiper-slide-visible',
		autoplay: {
			enabled: true,
			delay: 6000
		},
		speed: 400,
		breakpoints: {
			'1600': {
				slidesPerView: 7,
			},
			'1200': {
				slidesPerView: 6,
			},
			'992': {
				slidesPerView: 5,
				centeredSlides: false,
			},
			'768': {
				slidesPerView: 4,
				centeredSlides: false,
			},
			'576': {
				slidesPerView: 3,
				centeredSlides: false,
			},
			'0': {
				slidesPerView: 2,
			},
		},
	});

	// testimonial slider
	var slider = new Swiper('.xb-testimonial-slider', {
		spaceBetween: 34,
		slidesPerView: 2,
		roundLengths: true,
		loop: true,
		loopAdditionalSlides: 30,
		watchSlidesVisibility: true,
		slideVisibleClass: 'swiper-slide-visible',
		navigation: {
			nextEl: ".tm-button-next",
			prevEl: ".tm-button-prev",
		},
		autoplay: {
			enabled: true,
			delay: 6000
		},
		speed: 400,
		breakpoints: {
			'1600': {
				slidesPerView: 2,
			},
			'1200': {
				slidesPerView: 2,
			},
			'992': {
				slidesPerView: 2,
			},
			'768': {
				slidesPerView: 2,
			},
			'576': {
				slidesPerView: 2,
			},
			'0': {
				slidesPerView: 1,
			},
		},
	});

	// testimonial slider
	var slider = new Swiper('.xb-testimonial-slider2', {
		spaceBetween: 30,
		slidesPerView: 3,
		roundLengths: true,
		loop: true,
		loopAdditionalSlides: 30,
		watchSlidesVisibility: true,
		autoplay: {
			enabled: true,
			delay: 6000
		},
		speed: 400,
		breakpoints: {
			'1600': {
				slidesPerView: 3,
			},
			'1200': {
				slidesPerView: 3,
			},
			'992': {
				slidesPerView: 2,
			},
			'768': {
				slidesPerView: 2,
			},
			'576': {
				slidesPerView: 2,
			},
			'0': {
				slidesPerView: 1,
			},
		},
	});

	// country slider
	var slider = new Swiper('.xb-country-slide', {
		slidesPerView: 6,
		roundLengths: true,
		loop: true,
		loopAdditionalSlides: 30,
		watchSlidesVisibility: true,
		slideVisibleClass: 'swiper-slide-visible',
		autoplay: {
			enabled: true,
			delay: 6000
		},
		speed: 400,
		breakpoints: {
			'1600': {
				slidesPerView: 6,
			},
			'1200': {
				slidesPerView: 6,
			},
			'992': {
				slidesPerView: 5,
			},
			'768': {
				slidesPerView: 4,
			},
			'576': {
				slidesPerView: 3,
			},
			'0': {
				slidesPerView: 2,
			},
		},
	});

	// category slider
	var slider = new Swiper('.xb-category-slider', {
		spaceBetween: 30,
		slidesPerView: 7,
		roundLengths: true,
		loop: true,
		loopAdditionalSlides: 30,
		watchSlidesVisibility: true,
		autoplay: {
			enabled: true,
			delay: 6000
		},
		speed: 400,
		breakpoints: {
			'1600': {
				slidesPerView: 7,
			},
			'1200': {
				slidesPerView: 6,
			},
			'992': {
				slidesPerView: 5,
			},
			'768': {
				slidesPerView: 4,
			},
			'576': {
				slidesPerView: 3,
			},
			'0': {
				slidesPerView: 2,
			},
		},
	});

	// nice select
	//$('#nice-select').niceSelect();
	//$('.nice-select').niceSelect();

	// Select
	$(document).ready(function() {
		let i = 0;
		$('.select2').each(function() {

			$(this).select2({
				dropdownCssClass: 'select2-dropdown',
				containerCssClass: 'select2-container',
				minimumResultsForSearch: 10,
				templateResult: formatCountry,
            	templateSelection: formatCountry,
				width: '100%'
			});
			console.log(i);
			i++;
		});
	});

	/* magnificPopup img view */
	$('.popup-image').magnificPopup({
		type: 'image',
		gallery: {
			enabled: true
		}
	});

	/* magnificPopup video view */
	$('.popup-video').magnificPopup({
		type: 'iframe',
		mainClass: 'mfp-zoom-in',
	});

	// Accordion Box start
	if ($(".accordion_box").length) {
		$(".accordion_box").on("click", ".acc-btn", function () {
			var outerBox = $(this).parents(".accordion_box");
			var target = $(this).parents(".accordion");

			if ($(this).next(".acc_body").is(":visible")) {
				$(this).removeClass("active");
				$(this).next(".acc_body").slideUp(300);
				$(outerBox).children(".accordion").removeClass("active-block");
			} else {
				$(outerBox).find(".accordion .acc-btn").removeClass("active");
				$(this).addClass("active");
				$(outerBox).children(".accordion").removeClass("active-block");
				$(outerBox).find(".accordion").children(".acc_body").slideUp(300);
				target.addClass("active-block");
				$(this).next(".acc_body").slideDown(300);
			}
		});
	}
	// Accordion Box end

	// datepicker
	updateDatePicker();

})(jQuery);

function updateDatePicker() {

	$(".datepicker").datepicker({
		dateFormat: 'mm/dd/yy',
	});

	$(".datepicker-birthday").datepicker({
		maxDate: "-0d",
		yearRange: "-120:+0",
		changeYear: true,
		dateFormat: 'mm/dd/yy'
	});

	// Datepicker that takes today as minimum date
	$(".datepicker-min-today").datepicker({
		minDate: new Date(),
		dateFormat: 'mm/dd/yy',
		onSelect: function (dateText, inst) {
			// Show message alert
			if( $(this).hasClass('min-5-alert') ) {

				// If the value is less than 5 days from today, show alert $(this).closest('.alert.hidden').removeClass('hidden');
				var date1 = new Date();
				var date2 = new Date(dateText);
				var timeDiff = Math.abs(date2.getTime() - date1.getTime());
				var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));

				if (diffDays < 5) { 
					console.log(diffDays);
					$(this).parent().find('.alert').removeClass('hidden');
				} else {
					$(this).parent().find('.alert').addClass('hidden');
				}

			}
		}
	});

	$(".hasDatepicker").attr("readonly", "readonly");

}


function formatCountry(country) {
		
	if (!country.id) {
		return country.text;
	}

	var flagUrl = $(country.element).data('flag'); // Get flag URL from data attribute
	var $country = '';
	if (flagUrl) {
		$country = $(
			`<span><img src="${flagUrl}" class="w-5 h-5 inline-block mr-2" /> ${country.text}</span>`
		);
	} else {
		$country = $(`<span>${country.text}</span>`);
	}
	return $country;
}




