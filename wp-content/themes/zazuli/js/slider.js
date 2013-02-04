jQuery(document).ready(function() {
	// Start slider
	jQuery("ul.slider").carouFredSel({
		items : 3,
		auto : false,
		mousewheel : true,
		swipe : {
			onMouse : true,
			onTouch : true
		},
		scroll : {
			items : 1,
			easing : "swing",
			duration : 300,
			pauseOnHover : true
		}
	});
	
	//Add "sixteen columns" class to keep it responsive 
	jQuery(".caroufredsel_wrapper").addClass("sixteen columns");

});
