$j(function(){
	
	
	$j('#amount_slider').slider({
		value:0,
		min: parseInt(amountOptions.minimum),
		max: parseInt(amountOptions.maximum),
		step: parseInt(amountOptions.offset),
		slide:function(e,ui){
			$j('#amount_container').html('$' + ui.value);
		}
	});


});
