jQuery(document).ready(function() {

	//Hide the real password input box
	jQuery('input.password').toggle();
	
	//Clear username input box and reset default value if nothing is typed
	jQuery('input.username').focus(function() {
		if (jQuery(this).val() == "email") {
			jQuery(this).val('');
		}
	});

	jQuery('input.username').blur(function() {
		if (jQuery(this).val() == "") {
			jQuery(this).val('email');
		}
	});
	
	//Toggle real password input box for the same clearing effect as the username box
	jQuery('input.fake-password').focus(function() {
		jQuery(this).toggle();
		jQuery('input.password').toggle();
		jQuery('input.password').focus();
	});

	jQuery('input.password').blur(function() {
		if (jQuery(this).val() == "") {
			jQuery(this).toggle();
			jQuery('input.fake-password').toggle();
		}
	});
});