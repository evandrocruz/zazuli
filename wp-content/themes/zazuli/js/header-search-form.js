jQuery(document).ready(function() {

	//Hide the link
	var search_form = jQuery('form#header-search-form');
	var search_form_input = jQuery('input#s');
	var search_form_submit = jQuery('input#header-searchsubmit');
	var search_form_link = jQuery('a#header-search-form-link');
	
	//search_form.toggle();
	
	search_form_link.click(function(){
		jQuery(this).toggle();
		search_form.toggle();
		search_form_input.focus();
	});
	
	
	if ( search_form.parent().attr('id') == 'area-perfil' ) {
		search_form.attr('class','two columns alpha omega');
		search_form_input.attr('class','two columns alpha omega');
		search_form_submit.attr('class','one column alpha omega');
	}
	
		//Clear username input box and reset default value if nothing is typed
	jQuery('input.header-search-input').focus(function() {
		if (jQuery(this).val() == "Procurar por...") {
			jQuery(this).val('');
		}
	});

	jQuery('input.header-search-input').blur(function() {
		if (jQuery(this).val() == "") {
			jQuery(this).val('Procurar por...');
		}
	});
	
});