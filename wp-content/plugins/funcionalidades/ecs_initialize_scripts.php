<?php
	function ecs_initialize_scripts(){
		wp_deregister_script('jquery');
		wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js", false, null);
		wp_enqueue_script('jquery');
		wp_enqueue_script( 'caroufredsel' , get_bloginfo("template_directory").'/js/carouFredSel-6.1.0/jquery.carouFredSel-6.1.0.js');
		wp_enqueue_script( 'mousewheel' , get_bloginfo("template_directory").'/js/carouFredSel-6.1.0/helper-plugins/jquery.mousewheel.min.js');
		wp_enqueue_script( 'touchswipe' , get_bloginfo("template_directory").'/js/carouFredSel-6.1.0/helper-plugins/jquery.touchSwipe.min.js');
		
		wp_enqueue_script( 'slider', get_bloginfo("template_directory").'/js/slider.js' );
		
		wp_enqueue_script( 'header-search-form', get_bloginfo("template_directory").'/js/header-search-form.js' );
		
		wp_enqueue_script( 'mesa-escritor', get_bloginfo("template_directory").'/js/mesa-escritor.js' );
		
		if(!is_user_logged_in()){ wp_enqueue_script( 'zazu_login_form', get_bloginfo("template_directory").'/js/login-form.js'); }
		
	}
	add_action("wp_enqueue_scripts","ecs_initialize_scripts");
?>