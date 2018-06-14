$(function() {

	// Скролинг по якорям
	$('.anchor').bind("click", function(e){
		var anchor = $(this);
		$('html, body').stop().animate({
			scrollTop: $(anchor.attr('href')).offset().top // отступ от меню
		}, 500);
	e.preventDefault();
	});

	// Клик по гамбургеру на моб версии
	$('.mnu-link').click(function() {
		$('.head-mnu').toggleClass('show');
	});
	$('.head-mnu__item a').click(function() {
		$('.head-mnu').removeClass('show');
	});

	// Отправка формы
	$('form').submit(function() {
		var data = $(this).serialize();
		var goalId = $(this).find('input[ name="goal"]').val();
		data += '&ajax-request=true';
		$.ajax({
			type: 'POST',
			url: 'mail.php',
			dataType: 'json',
			data: data,
			success: (function() {
				$.fancybox.close();
				$.fancybox.open('<div class="thn"><h3>Заявка отправлена!</h3><p>С Вами свяжутся в ближайшее время.</p></div>');
				//gtag('event','submit',{'event_category':'submit','event_action':goalId});
				//fbq('track', 'Lead');
			})()
		});
		return false;
	});

	// Инит фансибокса
	$('.fancybox').fancybox({
		margin: 0,
		padding: 0
	});

	$('.projects-slider').slick({
		infinite: true,
		slidesToShow: 4,
		slidesToScroll: 1,
		centerMode: true,
		responsive: [
			{
				breakpoint: 768,
				settings: {
					slidesToShow: 2
				}
			},
			{
				breakpoint: 576,
				settings: {
					slidesToShow: 1
				}
			}
		]
	});

	var handle = $( "#custom-handle" ).find('span');
	var handle2 = $( "#custom-handle2" ).find('span');
	$( "#slider-range" ).slider({
		range: true,
		min: 250,
		max: 500,
		values: [ 250, 500 ],
		slide: function( event, ui ) {
			handle.text( ui.values[ 0 ] + " м²");
			handle2.text( ui.values[ 1 ] + " м²");
			$( "#area" ).val(ui.values[ 0 ] + "м² - " + ui.values[ 1 ] + "м²" );
		}
	});

	$('.team-slider').slick({
		infinite: true,
		slidesToShow: 1,
		slidesToScroll: 1,
		centerMode: true,
		centerPadding: '15vw',
		dots: true,
		responsive: [
			{
				breakpoint: 993,
				settings: {
					centerPadding: '10vw'
				}
			},
			{
				breakpoint: 768,
				settings: {
					centerMode: false,
				}
			}
		]
	});

	$('.head-slider').slick({
		infinite: true,
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: false,
		fade: true,
		autoplay: true,
		dots: true
	});

	$('.head-slider .slick-dots li button').each( function(){
		if ($(this).html() < 10) {
			$(this).prepend('0');
		}
	});
	var lastNumbHead = $('.head-slider .slick-dots li:last-child button').html();
	$('.head-slider .slick-dots').append('<div class="last"><span></span><p>'+lastNumbHead+'</p></div>');

	$('.reviews-slider').slick({
		infinite: true,
		slidesToShow: 1,
		slidesToScroll: 1,
		fade: true
	});

	$('.steps-slider').slick({
		infinite: true,
		slidesToShow: 1,
		slidesToScroll: 1,
		fade: true,
		dots: true,
		arrows: false
	});

	$('.steps-slider .slick-dots li button').each( function(){
		if ($(this).html() < 10) {
			$(this).prepend('0');
		}
	});
	var lastNumbStep = $('.steps-slider .slick-dots li:last-child button').html();
	$('.steps-slider .slick-dots').append('<div class="last"><span></span><p>'+lastNumbStep+'</p></div>');

	$('.steps-link').click(function(){
		var numb = $(this).data('slide');
		$('.steps-slider').slick('slickGoTo', numb);
		$(this).addClass('active').siblings().removeClass('active');
	});

	$(".scroll").each(function () {
		var block = $(this);
		$(window).scroll(function() {
			if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
				var top = block.offset().top-75;
			} else {
				var top = block.offset().top+75;
			}
			var bottom = block.height()+top;
			top = top - $(window).height();
			var scroll_top = $(this).scrollTop();
			if ((scroll_top > top) && (scroll_top < bottom)) {
				if (!block.hasClass("animated")) {
					block.addClass("animated");
					block.trigger('animatedIn');
				}
			}
		});
	});

});