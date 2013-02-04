<?php
/**
 * Plugin Name: Funcionalidades
 * Plugin URI: http://asfalia.com.br/
 * Description: Funcionalidades que vão além do tema.
 * Author: Evandro Cruz Jr.
 * Author URI: http://asfalia.com.br/
 * Version: 1.0
 */

include("get_first_image.php");
include("ecs_slider_noticias.php");
include("ecs_slider_imagens.php");
include("ecs_initialize_scripts.php");
include("ecs_load_slider.php");
include ("ecs_get_attachment_text.php");
include ("zazu_modify_tinymce.php");

//Admin theme
include ("zazu_load_custom_admin_panel.php");
?>