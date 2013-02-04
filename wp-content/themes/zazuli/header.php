<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
	
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width,initial-scale=1">
	
	<?php if (is_search()) { ?>
	   <meta name="robots" content="noindex, nofollow" /> 
	<?php } ?>

	<title>
		   <?php
		      if (function_exists('is_tag') && is_tag()) {
		         single_tag_title("Tag Archive for &quot;"); echo '&quot; - '; }
		      elseif (is_archive()) {
		         wp_title(''); echo ' Archive - '; }
		      elseif (is_search()) {
		         echo 'Search for &quot;'.wp_specialchars($s).'&quot; - '; }
		      elseif (!(is_404()) && (is_single()) || (is_page())) {
		         wp_title(''); echo ' - '; }
		      elseif (is_404()) {
		         echo 'Not Found - '; }
		      if (is_home()) {
		         bloginfo('name'); echo ' - '; bloginfo('description'); }
		      else {
		          bloginfo('name'); }
		      if ($paged>1) {
		         echo ' - page '. $paged; }
		   ?>
	</title>
	
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
	
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/base.css" type="text/css" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/skeleton.css" type="text/css" />
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700,400italic,700italic,200italic,200|Sanchez:400,400italic&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" />
	
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<?php //wp_enqueue_script( 'localjquery', get_bloginfo("template_directory").'/js/carouFredSel-6.1.0/jquery-1.8.2.min.js'); ?>
	<?php //wp_enqueue_script( 'caroufredsel' , get_bloginfo("template_directory").'/js/carouFredSel-6.1.0/jquery.carouFredSel-6.1.0.js'); ?>
	<?php //wp_enqueue_script( 'mousewheel' , get_bloginfo("template_directory").'/js/carouFredSel-6.1.0/helper-plugins/jquery.mousewheel.min.js'); ?>
	<?php //wp_enqueue_script( 'touchswipe' , get_bloginfo("template_directory").'/js/carouFredSel-6.1.0/helper-plugins/jquery.touchSwipe.min.js'); ?>
	
	<?php //wp_enqueue_script( 'slider', get_bloginfo("template_directory").'/js/slider.js' ); ?>
	
	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

	<?php wp_head(); ?>
	
</head>

<body <?php body_class(); ?>>
	
	<div id="wrapper">
		<div id="header" class="bottom-shadow">
			<div class="container">
				<a href="<?php echo get_option('home'); ?>/" class="two columns"><img src="<?php bloginfo("template_directory"); ?>/images/logo.png" alt="" id="logo" /></a>
				<?php is_user_logged_in() ? include( TEMPLATEPATH . '/inc/header-account-settings.php' ) : include( TEMPLATEPATH . '/inc/header-login-form.php' ); ?>
			</div>
		</div>