jQuery(document).ready(function() {
	var menu_mesa = jQuery('ul#menu-mesa');
	
	//O menu inicia escondido
	menu_mesa.toggle();
	
	jQuery('a#mesa-escritor-link').click(function() {
		// Expande ou retrai o menu
			menu_mesa.slideToggle('fast');
	});
	
	jQuery('a#mesa-escritor-link').mouseenter(function() {
		// Expande ou retrai o menu
		if( !( menu_mesa.is( ":visible" ) ) ) {
			menu_mesa.slideToggle('fast');
		}
	});
	
	jQuery('#area-perfil').mouseleave(function() {
		// Expande ou retrai o menu
		if( ( menu_mesa.is( ":visible" ) ) ) {
			menu_mesa.slideToggle('fast');
		}
	});
});

