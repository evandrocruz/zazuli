<?php
function ecs_load_slider($ecs_div_id){
	wp_enqueue_script( 'slider', get_bloginfo("template_directory").'/js/slider.js',"","", true );
	//wp_localize_script( 'slider', 'slider_args', array( 'ecs_div_id' => $ecs_div_id ));
} 
?>