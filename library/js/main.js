var JWR = JWR || {};

jQuery(document).ready(function($) {
	
	console.log('docready');
	
	JWR.BGExpand.init();//$('#thumb-wrapper a').first().attr('href'));
	JWR.Zoom.init();
	JWR.TimeBG.init();
	
	//show thumb at full opacity on hover
	$('.thumb').hover(function(evt) {
		$(evt.currentTarget).addClass('hover-on');
	}, function(evt) {
		$(evt.currentTarget).removeClass('hover-on');
	});
	
	//thumb click loads full img into canvas
	//also sets zoom prop on zoom button
	$('#thumb-wrapper a').click(function(evt) {

		evt.preventDefault();
		
		$('.thumb-overlay').hide();
		
		var $thumb = $(evt.currentTarget);
		var $overlay = $thumb.siblings('.thumb-overlay');
		
		$('#image-caption').html( $thumb.data('caption') );
		$overlay.show();
		JWR.BGExpand.loadImage( $thumb.attr('href') );
		JWR.Zoom.checkClose();
		JWR.Zoom.setZoomButtonTarget( $thumb.data('zoom') );
		
		return false;

	});
	
	$('#thumb-wrapper a').first().click();

});