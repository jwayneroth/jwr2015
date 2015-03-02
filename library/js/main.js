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
		//console.log(evt);
		evt.preventDefault();
		
		//TODO: show overlay on selected thumb
		//TODO: add ptg info below canvas
		
		
		JWR.BGExpand.loadImage(evt.currentTarget.href);
		JWR.Zoom.checkClose();
		JWR.Zoom.setZoomButtonTarget( $(evt.currentTarget).data('zoom') );
		
		return false;

	});
	
	$('#thumb-wrapper a').first().click();

});