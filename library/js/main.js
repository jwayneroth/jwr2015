var JWR = JWR || {};

jQuery(document).ready(function($) {
	
	console.log('docready');
	
	JWR.BGExpand.init();
	JWR.Zoom.init();
	if(Modernizr.cssgradients) JWR.TimeBG.init();
	JWR.Loader.init();
	
	$('#contact-wrapper').on('shown.bs.collapse', function() {
		
		$('html, body').animate({
    	scrollTop: document.body.scrollHeight
		}, 400);
		
		$('#contact-me-btn').text('hide form');
	
	});
	
	$('#contact-wrapper').on('hidden.bs.collapse', function() {
		$('#contact-me-btn').text('contact me');
	});
	
	//show thumb at full opacity on hover
	$('.thumb').hover(function(evt) {
		$(evt.currentTarget).addClass('hover-on');
	}, function(evt) {
		$(evt.currentTarget).removeClass('hover-on');
	});
	
	$("#contact-form").validate({
		
		rules: {
			contact_name: {
				required: true
			},
			contact_email: {
				required: true,
				email: true
			},
			contact_message: {
				required: true
			}
		},
		
		//invalidHandler: function(evt, validator) {
		//	console.log('contact submit invalid', validator);
		//},
		
		submitHandler: function(form) {
			
			//console.log('contact submitted', form);
			
			$.ajax({
				type: 'post',
				url: JWR.ajaxurl,
				data: {
					'action': 'jwr_contact_submit',
					'contact-pass': $('#contact-pass').val(),
					'contact-name': $('#contact-name').val(),
					'contact-email': $('#contact-email').val(),
					'contact-message': $('#contact-message').val()
				},
				success: function(data) {
					//console.log('ajax success');
					$(form).hide();
					$('#contact-result')
						.removeClass('text-danger')
						.addClass('text-primary')
						.text('Thanks!');
				},
				error: function() {
					//console.log('ajax error');
					$(form).hide();
					$('#contact-result')
						.removeClass('text-primary')
						addClass('text-danger')
						.text('Uh oh, something went wrong. Try again later');
				}
			});
			
		}
	});
	
	//console.log(Modernizr);
	
	if(Modernizr.canvas) {
	
		//thumb click loads full img into canvas
		//also sets zoom prop on zoom button
		$('.thumb').click(function(evt) {

			evt.preventDefault();
		
			$('.thumb-overlay').hide();
		
			var $thumb = $(evt.currentTarget).children('a');
			var $overlay = $thumb.siblings('.thumb-overlay');
		
			$('#image-caption').html( $thumb.data('caption') );
			$overlay.show();
			JWR.BGExpand.loadImage( $thumb.attr('href') );
			JWR.Zoom.checkClose();
			JWR.Zoom.setZoomButtonTarget( $thumb.data('zoom') );
		
			//window.scrollTo(0,0);
			$('html, body').animate({
				scrollTop: 0
			}, 400);
		
			return false;

		});
	
		$('.thumb').first().click();

	}else{
		$('#jwr-canvas, #controls-wrapper').hide();
	}
});

/*
 * Loader class
 * controls ajax-loader gif
*/
(function($) {
	function Loader() {}
	Loader.el = null;
	Loader.init = function() {
		this.el = $('#image-loader');
	};
	Loader.show = function() {
		this.el.show();
	};
	Loader.hide = function() {
		this.el.hide();
	};
	JWR.Loader = Loader;
}(jQuery));