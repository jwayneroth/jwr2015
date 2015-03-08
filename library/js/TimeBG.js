var JWR = JWR || {};

(function($) {

	function TimeBG() {}
	
	TimeBG.inited = false;
	TimeBG.display = null;
	TimeBG.updateID = null;
	TimeBG.stop1 = {r:220, g:220, b:220};
	TimeBG.initR = 230;
	TimeBG.initG = 230;
	TimeBG.initB = 230;
	TimeBG.redRange = 25;
	TimeBG.greenRange = 18;
	TimeBG.blueRange = 20;
	TimeBG.stop2 = {r:TimeBG.initR, g:TimeBG.initG, b:TimeBG.initB};
	TimeBG.seconds = 0;
	
	TimeBG.init = function() {
		
		//console.log('TimeBG:init');
		
		if(!this.inited) {
			this.inited = true;
			this.display = $('#time-bg-display');
			
			var d = new Date();
			
			var r = ( Math.abs(30 -  d.getSeconds()) / 30 ) * (this.redRange);//255 - this.initR );
			this.stop2.r = this.initR + Math.round( r );
		
			var g = (( d.getHours() ) / 24) * (this.greenRange);//255 - this.initG);
			this.stop2.g = this.initG + Math.round( g );
			
			var b = ( Math.abs(30 - d.getMinutes()) / 30) * (this.blueRange);//255 - this.initB);
			this.stop2.b = this.initB + Math.round( b );
			
			this.updateID = setInterval( this.updateBG.bind(this), 1000 );
			
		}
	
	};
	
	
	TimeBG.updateBG = function() {
		
		var d,b,r,wbk,vs;
		
		d = new Date();
		
		this.seconds++;
	
		if(this.seconds > 60) {
			this.seconds = 0;
			b = ( Math.abs(30 - d.getMinutes()) / 30) * (this.blueRange);//255 - this.initB);
			this.stop2.b = this.initB + Math.round( b );
		}
	
		r = ( Math.abs(30 -  d.getSeconds()) / 30 ) * (this.redRange);// 255 - this.initR );
		this.stop2.r = this.initR + Math.round( r );
		
		//console.log('r: ' + this.stop2.r + ' g: ' + this.stop2.g + ' b: ' + this.stop2.b);
		
		//wbk = 'background:-webkit-gradient(linear,left top, left bottom,';
		vs = '(top,';
		
		/*wbk += 'color-stop(10%, rgb(' + 
			this.stop1.r + ',' + 
			this.stop1.g + ',' + 
			this.stop1.b + ')),';*/
			
		vs += 'rgb(' + 
			this.stop1.r + ',' +
			this.stop1.g + ',' +
			this.stop1.b + ') 10%, ';
			
		/*wbk += 'color-stop(100%, rgb(' + 
			this.stop2.r + ',' + 
			this.stop2.g + ',' + 
			this.stop2.b + ')));';*/
			
		vs += 'rgb(' + 
			this.stop2.r + ',' +
			this.stop2.g + ',' +
			this.stop2.b + ') 100%)';
		
		var browsers = [
			'-webkit-linear-gradient',
			'-o-linear-gradient',
			'-moz-linear-gradient',
			//'-ms-linear-gradient',
			'linear-gradient'
		];
		
		bg = '';//wbk;
		
		for(var i=0;i<browsers.length;i++) {
			bg += 'background:' + browsers[i] + vs + ';';
		}
		
		//console.log(bg);
		
		//$('#wrapper-all').attr('style', bg);
		$('#banner').attr('style', bg);
		//$('body').css('background-color', 'rgb(' + this.stop2.r + ',' + this.stop2.g + ',' + this.stop2.b + ')');

	};

	JWR.TimeBG = TimeBG;

}(jQuery));