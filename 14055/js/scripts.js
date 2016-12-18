(function ($) {
	"use strict";



	/*

	MAPS

	*/
	/*var map;
	function initialize_full_width_map() {
		var mapOptions = {
			zoom: 15,
			center: new google.maps.LatLng(-37.814199, 144.961560),
			scrollwheel: false,
			panControl: false,
			zoomControl: false,
			scaleControl: false,
			mapTypeControl: false,
			streetViewControl: false
		};
		map = new google.maps.Map(document.getElementById('full-width-map'),
			mapOptions);
	}
	google.maps.event.addDomListener(window, 'load', initialize_full_width_map);
	function initialize_small_map() {
		var mapOptions = {
			zoom: 15,
			center: new google.maps.LatLng(-37.814199, 144.961560),
			scrollwheel: false,
			panControl: false,
			zoomControl: false,
			scaleControl: false,
			mapTypeControl: false,
			streetViewControl: false
		};
		map = new google.maps.Map(document.getElementById('small-map'),
			mapOptions);
	}
	google.maps.event.addDomListener(window, 'load', initialize_small_map);
*/


	/*

	CLIENT SLIDER

	*/
	$('#client-slider').owlCarousel({
		autoPlay: false,
		items: 5
	});



	/*

	CountTo

	*/
	$('.countTo').countTo();
	$('.countTo').bind('inview', function(event, isInView, visiblePartX, visiblePartY) {
		if (isInView) {
			$(this).countTo();
		}
	});



	/*

	ALERTS

	*/
	$('.alert').bind('inview', function(event, isInView, visiblePartX, visiblePartY) {
		if (isInView) {
			$(this).addClass('in');
		}
	});



	$('.dial').bind('inview', function(event, isInView, visiblePartX, visiblePartY) {
		if (isInView) {
			var $this = $(this);
			var myVal = $this.attr("rel");
			var color = $this.attr("data-color");
			$this.knob({
				readOnly: true,
				width: 200,
				thickness: .075,
				inputColor: color,
				fgColor: color,
				bgColor: '#bfc9d4',
				'draw' : function () { 
					$(this.i).val(this.cv + '%')
				}
			});
			$({
				value: 0
			}).animate({
				value: myVal
			}, {
				duration: 1000,
				easing: 'swing',
				step: function() {
					$this.val(Math.ceil(this.value)).trigger('change');
				}
			});
		}
	});



	/*

	TESTIMONIAL SLIDER

	*/
	$('#testimonial-slider').owlCarousel({
		slideSpeed: 300,
		autoPlay: true,
		singleItem: true
	});
	$('#testimonial-detail-slider').owlCarousel({
		navigation: true,
		pagination: false,
		slideSpeed: 300,
		transitionStyle: "fade",
		autoPlay: true,
		singleItem: true,
		navigationText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>']
	});

	// IMAGE SLIDER
	$('.image-slider').owlCarousel({
		slideSpeed: 300,
		autoPlay: true,
		transitionStyle: "fade",
		singleItem: true
	});

	$('.tool-tip').tooltip();


	
	/*

	PORTFOLIO

	*/
	var $portfolio_detail_container = $('.portfolio-detail').isotope({
		itemSelector: '.portfolio-item',
		layoutMode: 'fitRows'
	});
	var $portfolio_full_width_container = $('.portfolio-full-width').isotope({
		itemSelector: '.portfolio-item',
		layoutMode: 'fitRows'
	});
	var $portfolio_listed_container = $('.portfolio-listed').isotope({
		itemSelector: '.portfolio-listed-item',
		layoutMode: 'fitRows'
	});
	$('#portfolio-filters').on('click', 'button', function () {
		var filterValue = $(this).attr('data-filter');
		$portfolio_detail_container.isotope({ filter: filterValue});
		$('.portfolio-filters .active').removeClass('active');
		$(this).addClass('active');
	});
	$('#portfolio-filters').on('click', 'button', function () {
		var filterValue = $(this).attr('data-filter');
		$portfolio_full_width_container.isotope({ filter: filterValue});
		$('.portfolio-filters .active').removeClass('active');
		$(this).addClass('active');
	});
	$('#portfolio-filters').on('click', 'button', function () {
		var filterValue = $(this).attr('data-filter');
		$portfolio_listed_container.isotope({ filter: filterValue});
		$('.portfolio-filters .active').removeClass('active');
		$(this).addClass('active');
	});



	/*

	Blog Archive

	*/
	var $blog_archive_container = $('.blog-archive').isotope({
		itemSelector: '.blog-post',
		layoutMode: 'masonry'
	});



	/*

	TEAM

	*/
	var $team_container = $('.team').isotope({
		itemSelector: '.team-member',
		layoutMode: 'fitRows',
		filter: $('.team-filters .active').attr('data-filter')
	});
	$('#team-filters').on('click', 'button', function () {
		var filterValue = $(this).attr('data-filter');
		$team_container.isotope({ filter: filterValue});
		$('.team-filters .active').removeClass('active');
		$(this).addClass('active');
	});


	
	/*
	
	SLIDE IN MENU
	
	*/
	$('.side-menu-open-btn').on('click', function(event){
		event.preventDefault();
		$('.side-menu').addClass('side-menu-open');
	});
	$('.side-menu-close-btn').on('click', function(event){
		event.preventDefault();
		$('.side-menu').removeClass('side-menu-open');
	});
	$('.side-menu ul>li ul').parent().addClass('sub');
	$('.side-menu ul>li.sub').children('a').on('click', function(event){
		event.preventDefault();
		$(this).toggleClass('submenu-open').next('ul').slideToggle(200).end().parent('li').siblings('li').children('a').removeClass('submenu-open').next('ul').slideUp(200);
	});



	/*

	ANNOTATIONS

	*/
	$('.annotation').children('a').on('click', function(){
		var selectedPoint = $(this).parent('li');
		if( selectedPoint.hasClass('is-open') ) {
			selectedPoint.removeClass('is-open').addClass('visited');
		} else {
			selectedPoint.addClass('is-open').siblings('.annotation').removeClass('is-open');
		}
	});
	//close interest point description
	$('.close-info').on('click', function(event){
		event.preventDefault();
		$(this).parents('.annotation').eq(0).removeClass('is-open').addClass('visited');
	});



	/*

	CONTACT FORM

	*/
	$('#contact-form').submit(function() {
		$('#contact-error').fadeOut();
		$('#contact-success').fadeOut();
		$('#contact-loading').fadeOut();
		$('#contact-loading').fadeIn();
		if (validateEmail($('#contact-email').val()) && $('#contact-email').val().length !== 0 && $('#contact-name').val().length !== 0 && $('#contact-message').val().length !== 0) {
			var action = $(this).attr('action');
			$.ajax({
				type: "POST",
				url : action,
				data: {
					contact_name: $('#contact-name').val(),
					contact_email: $('#contact-email').val(),
					contact_subject: $('#contact-subject').val(),
					contact_message: $('#contact-message').val()
				},
				success: function() {
					$('#contact-error').fadeOut();
					$('#contact-success').fadeOut();
					$('#contact-loading').fadeOut();
					$('#contact-success').html('Success! Thanks for contacting us!').fadeIn();
				},
				error: function() {
					$('#contact-error').fadeOut();
					$('#contact-success').fadeOut();
					$('#contact-loading').fadeOut();
					$('#contact-error').html('Sorry, an error occurred.').fadeIn();
				}
			});
		} else if (!validateEmail($('#contact-email').val()) && $('#contact-email').val().length !== 0 && $('#contact-name').val().length !== 0 && $('#contact-message').val().length !== 0) {
			$('#contact-error').fadeOut();
			$('#contact-success').fadeOut();
			$('#contact-loading').fadeOut();
			$('#contact-error').html('Please enter a valid email.').fadeIn();
		} else {
			$('#contact-error').fadeOut();
			$('#contact-success').fadeOut();
			$('#contact-loading').fadeOut();
			$('#contact-error').html('Please fill out all the fields.').fadeIn();
		}
		return false;
	});



	/*

	NEWSLETTER FORM

	*/
	$('#newsletter-form').submit(function() {
		$('#newsletter-error').fadeOut();
		$('#newsletter-success').fadeOut();
		$('#newsletter-loading').fadeOut();
		$('#newsletter-loading').fadeIn();
		if (validateEmail($('#newsletter-email').val()) && $('#newsletter-email').val().length !== 0) {
			var action = $(this).attr('action');
			$.ajax({
				url: action,
				type: 'POST',
				data: {
					newsletter_email: $('#newsletter-email').val()
				},
				success: function(data) {
					$('#newsletter-error').fadeOut();
					$('#newsletter-success').fadeOut();
					$('#newsletter-loading').fadeOut();
                    $('#newsletter-success').html(data).fadeIn();
                },
                error: function() {
					$('#newsletter-error').fadeOut();
					$('#newsletter-success').fadeOut();
					$('#newsletter-loading').fadeOut();
                    $('#newsletter-error').html('Sorry, an error occurred.').fadeIn();
                }
			});
		} else {
			$('#newsletter-error').fadeOut();
			$('#newsletter-success').fadeOut();
			$('#newsletter-loading').fadeOut();
			$('#newsletter-error').html('Please enter a valid email.').fadeIn();
		}
		return false;
	});


	
	/*

	VALIDATE EMAIL

	*/
	function validateEmail($validate_email) {
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		if( !emailReg.test( $validate_email ) ) {
			return false;
		} else {
			return true;
		}
	}



	/*

	INTENSE
var elements = document.querySelectorAll('.img-popup');
	Intense(elements);
	*/
	

	

})($);