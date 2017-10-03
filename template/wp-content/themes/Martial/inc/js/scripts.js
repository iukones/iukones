(function ($) {
	$(document).ready(function () {
		$('.tab1').show();

		$('.menu_icon').click(function (e) {
			$('nav ul').slideToggle('fast');
		});

		$('.tab_head li').click(function (e) {

			$(this).addClass('active')
			$(this).siblings().removeClass('active')
			var target = '.' + $(this).attr('id');
			$(target).fadeIn();
			$(target).siblings().hide();
		});

		var length = $('.right_content').height() - $('#sidebar').height() + $('.right_content').offset().top;

		$(window).scroll(function () {

			var scroll = $(this).scrollTop();
			var height = $('#sidebar1').height() + 'px';

			if (scroll < $('.right_content').offset().top) {

				$('#sidebar1').css({
					'position': 'absolute',
					'top': '0'
				});

			} else if (scroll > length) {

				$('#sidebar1').css({
					'position': 'absolute',
					'bottom': '0',
					'top': 'auto'
				});

			} else {

				$('#sidebar1').css({
					'position': 'fixed',
					'top': '0',
					'height': height
				});

			}
		});
	});
})(jQuery);