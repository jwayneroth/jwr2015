var JWR = JWR || {};

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

jQuery(document).ready(function($) {
	
	console.log('docready');
	
	JWR.BGExpand.init();
	JWR.Zoom.init();
	if(Modernizr.cssgradients) JWR.TimeBG.init();
	JWR.Loader.init();
	
	$('#contact-wrapper').on('shown.bs.collapse', function() {
		window.scrollTo(0,document.body.scrollHeight);
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
		
			window.scrollTo(0,0);
		
			return false;

		});
	
		$('.thumb').first().click();

	}else{
		$('#jwr-canvas, #controls-wrapper').hide();
	}
});