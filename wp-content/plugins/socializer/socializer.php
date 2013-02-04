<?php
/*
Plugin Name: Socializer!
Version: 6.1
Plugin URI: http://www.thefreewindows.com/5598/socializer-share-wordpress-posts-pages/
Description: Socializer! is a free and light, very fast, plugin to let you have your posts shared on more than 30 top social networks, including Facebook and Twitter, have them promoted in Google Plus, recommended by eMail, even let your visitors translate them to a different language. Check the <a href="http://www.socializer.info/" target="_blank">Home Page of Socializer!</a> for more information, options, and technical support.
Author: TheFreeWindows
Author URI: http://www.thefreewindows.com
*/
if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__file__) == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( !defined('WP_CONTENT_URL') )
    		define( 'WP_CONTENT_URL', get_option('siteurl') . '/wp-content');
 
	$socpath = WP_CONTENT_URL.'/plugins/'.plugin_basename(dirname(__FILE__)).'/';

add_option('tfw_sposts', TRUE);	
add_option('tfw_spages', TRUE);	
add_option('tfw_spbe', FALSE);	
add_option('tfw_spaf', TRUE);	
add_option('tfw_sindarch', TRUE);	
add_option('tfw_stl', 'border:none;margin:8pt;');
add_option('tfw_stlw', 'border:none;margin:8pt;');
add_option('tfw_stldiv', 'text-align:left;');
add_option('tfw_stlwdiv', 'text-align:left;');
add_option('tfw_cimg', ''.$socpath.'scl.gif');
add_option('tfw_cimgw', ''.$socpath.'scl-sm.gif');

function tfw_add_option_pages() {
	if (function_exists('add_options_page')) {
		add_options_page('Socializer!', 'Socializer!', 8, socializer.php, 'tfw_options_page');
	}		
}

function tfw_options_page() {

	if (isset($_POST['info_update'])) {

		?><div id="message" class="updated fade"><p><strong><?php 

		update_option('tfw_sposts', (bool)$_POST["tfw_sposts"]);
		update_option('tfw_spages', (bool)$_POST["tfw_spages"]);
		update_option('tfw_spbe', (bool)$_POST["tfw_spbe"]);
		update_option('tfw_spaf', (bool)$_POST["tfw_spaf"]);
		update_option('tfw_sindarch', (bool)$_POST["tfw_sindarch"]);
		update_option('tfw_stl', '' . (string)$_POST["tfw_stl"] . '');
		update_option('tfw_stlw', '' . (string)$_POST["tfw_stlw"] . '');
		update_option('tfw_stldiv', '' . (string)$_POST["tfw_stldiv"] . '');
		update_option('tfw_stlwdiv', '' . (string)$_POST["tfw_stlwdiv"] . '');
		update_option('tfw_cimg', '' . (string)$_POST["tfw_cimg"] . '');
		update_option('tfw_cimgw', '' . (string)$_POST["tfw_cimgw"] . '');
					
		echo "Configuration Updated!";

	    ?></strong></p></div><?php

	} ?>

	<div class="wrap" style="font-size:11pt;padding:0 10pt 10pt 5pt;background:white;">

<h1 style="padding:1px 0 5px 0;">
<a style="border:none;border:0;text-decoration:none;" href="http://www.socializer.info/" target="_blank"><img src="<?=WP_CONTENT_URL.'/plugins/'.plugin_basename(dirname(__FILE__)).'/'?>sclog.gif" style="border:none;border:0;" alt="Home of Socializer!"></a>
<br>
  &nbsp;  <a style="text-decoration:none;border:none;border:0;" href="http://www.socializer.info/share.asp?docurl=http://www.thefreewindows.com/5598/socializer-share-wordpress-posts-pages/&doctitle=Download Socializer! to share easily your web pages" target="_blank"><img style="padding:10px 0 0 150px;border:none;border:0;" src="<?php echo htmlspecialchars(get_option('tfw_cimg')) ?>" alt="Socialize the Socializer!"></a></h1>


<br>&nbsp;<br>


	<form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
	<input type="hidden" name="info_update" id="info_update" value="true" />


	<fieldset class="options"> 
	<legend style="font-size:14pt;letter-spacing:3px;"> &nbsp; Options</legend>

	<div style="padding: 40px 0 10px 30px">
		<label><input type="checkbox" name="tfw_sposts" value="checkbox" <?php if (get_option('tfw_sposts')) echo "checked='checked'"; ?>/> &nbsp; Display on posts</label>

 &nbsp;  &nbsp;  &nbsp; 

		<label><input type="checkbox" name="tfw_spages" value="checkbox" <?php if (get_option('tfw_spages')) echo "checked='checked'"; ?>/> &nbsp; Display on static pages</label>

</div>


	<div style="padding: 20px 0 0 30px">
		<label><input type="checkbox" name="tfw_sindarch" value="checkbox" <?php if (get_option('tfw_sindarch')) echo "checked='checked'"; ?>/> &nbsp; Display on Archives &nbsp;<span style="color:grey;">( Home / Index, Categories, Tags, Dates )</span></label>
	</div>


<div style="line-height:160%;padding: 45px 0 0 30px">
<b>Main position</b>

</div>


	<div style="padding: 30px 0 0 30px;">
		<label><input type="checkbox" name="tfw_spbe" value="checkbox" <?php if (get_option('tfw_spbe')) echo "checked='checked'"; ?>/> &nbsp; Display at the top of content</label>

 &nbsp;  &nbsp;  &nbsp; 

		<label><input type="checkbox" name="tfw_spaf" value="checkbox" <?php if (get_option('tfw_spaf')) echo "checked='checked'"; ?>/> &nbsp; Display at the bottom of content</label>

</div>




<div style="padding: 40px 20px 0 30px">		

&raquo; &nbsp;<a style="color:#2b95ff;text-decoration:none;border:none;letter-spacing:2px;" href="http://www.socializer.info/share.asp?docurl=http://www.thefreewindows.com/5598/socializer-share-wordpress-posts-pages/&doctitle=Socializer! for Wordpress" target="_blank">If you like the Socializer! Share it!</a>

<br>&nbsp;<br>
<br>&nbsp;<br>



You can change the default Sharing buttons, if you need to. At the input fields that follow, you can paste the web address of any button you like. 
<br>&nbsp;<br>
You can have the same or different buttons for sidebar (widget) and content.
<br>&nbsp;<br>
<b>Remember to Update the Settings (at the end of the page).</b>
<br>&nbsp;<br><br>&nbsp;<br>

<span style="padding:3pt;letter-spacing:2px;font-weight:bold;">The CONTENT Button</span><br>&nbsp;<br>
Default is <span style="color:grey;"><?=WP_CONTENT_URL.'/plugins/'.plugin_basename(dirname(__FILE__)).'/'?>scl.gif</span>
<br>
<p><img src="<?=WP_CONTENT_URL.'/plugins/'.plugin_basename(dirname(__FILE__)).'/'?>scl.gif" alt="Default Content Button"></p>

<p style="letter-spacing:2px;margin:10px;">To change the default button above, paste here the url of any button you like ::</p>

<input type="text" style="color:black;border:1px solid silver;margin-left:22px;font-size:11pt;width:80%;" name="tfw_cimg" value="<?php echo htmlspecialchars(get_option('tfw_cimg')) ?>">

<br>&nbsp;<br>
<br>&nbsp;<br>

<div style="margin-left:70px;">
Copy the url of the animated smaller content button (proper for light background):
<br>&nbsp;<br>
<b><?=WP_CONTENT_URL.'/plugins/'.plugin_basename(dirname(__FILE__)).'/'?>scl-anim.gif</b>
<br>
<img src="<?=WP_CONTENT_URL.'/plugins/'.plugin_basename(dirname(__FILE__)).'/'?>scl-anim.gif" alt="Animated Smaller Content Button">
</div>

<br>&nbsp;<br><br>&nbsp;<br>

<span style="padding:3pt;letter-spacing:2px;font-weight:bold;">The WIDGET Button</span><br>&nbsp;<br>
Default is <span style="color:grey;"> <?=WP_CONTENT_URL.'/plugins/'.plugin_basename(dirname(__FILE__)).'/'?>scl-sm.gif </span>
<br>
<p><img src="<?=WP_CONTENT_URL.'/plugins/'.plugin_basename(dirname(__FILE__)).'/'?>scl-sm.gif" alt="Default Widget Button"></p>

<p style="letter-spacing:2px;margin:10px;">Paste here the url of any button that you like ::</p>

<input type="text" style="color:black;border:1px solid silver;margin-left:22px;font-size:11pt;width:80%;" name="tfw_cimgw" value="<?php echo htmlspecialchars(get_option('tfw_cimgw')) ?>">

<br>&nbsp;<br>
<br>&nbsp;<br>

<div style="margin-left:70px;">
Copy the url of the animated and smaller widget button (proper for light background):
<br>&nbsp;<br>
<b><?=WP_CONTENT_URL.'/plugins/'.plugin_basename(dirname(__FILE__)).'/'?>scl-sm-anim.gif</b>
<br>
<img src="<?=WP_CONTENT_URL.'/plugins/'.plugin_basename(dirname(__FILE__)).'/'?>scl-sm-anim.gif" alt="Animated Smaller Widget Button">
</div>
<br>&nbsp;<br>
<br>&nbsp;<br>

<hr style="width:700px;color:silver;margin-bottom:15px;" size="1" align="left">





Customize further (CSS)

<br>&nbsp;<br><br>&nbsp;<br>


<b>Content Button</b>

<br>&nbsp;<br><br>&nbsp;<br>

<span style="letter-spacing:3px;">Image Style</span> ( default is <span style="color:grey;">border:none;margin:8pt;</span> )
<br>&nbsp;<br>
<input type="text" style="color:black;border:1px solid silver;margin-left:22px;font-size:11pt;width:80%;" name="tfw_stl" value="<?php echo htmlspecialchars(stripslashes(get_option('tfw_stl'))) ?>">

<br>&nbsp;<br>

<span style="letter-spacing:3px;">Paragraph (div) Style</span> ( default is <span style="color:grey;">text-align:left;</span> &mdash; the button is aligned to the left )
<br>&nbsp;<br>
<input type="text" style="color:black;border:1px solid silver;margin-left:22px;font-size:11pt;width:80%;" name="tfw_stldiv" value="<?php echo htmlspecialchars(stripslashes(get_option('tfw_stldiv'))) ?>">

<br>&nbsp;<br><br>&nbsp;<br><br>&nbsp;<br>

<b>Widget Button</b> &nbsp;<span style="color:grey;">( To activate the Widget go to <a href="widgets.php" target="_blank" style="text-decoration:none;">Appearance / Widgets</a> )</span>
<br>&nbsp;<br><br>&nbsp;<br>
<span style="letter-spacing:3px;">Image Style</span> ( default is <span style="color:grey;">border:none;margin:8pt;</span> )
<br>&nbsp;<br>
<input type="text" style="color:black;border:1px solid silver;margin-left:22px;font-size:11pt;width:80%;" name="tfw_stlw" value="<?php echo htmlspecialchars(stripslashes(get_option('tfw_stlw'))) ?>">

<br>&nbsp;<br>

<span style="letter-spacing:3px;">Paragraph (div) Style</span> ( default is <span style="color:grey;">text-align:left;</span> &mdash; the button is aligned to the left )
<br>&nbsp;<br>
<input type="text" style="color:black;border:1px solid silver;margin-left:22px;font-size:11pt;width:80%;" name="tfw_stlwdiv" value="<?php echo htmlspecialchars(stripslashes(get_option('tfw_stlwdiv'))) ?>">

<br>&nbsp;<br><br>&nbsp;<br>

 If you prefer to use your style sheet, just define the <b>Socializer</b> and <b>SocializerW</b> css ID (#) tags for the content and the widget buttons respectively.

 

	</div>

	</fieldset>

<br>&nbsp;<br>



	<div class="submit" style="background:#ececec;padding:7pt;margin:32px 42px 32px 22px;-moz-border-radius: 17px;border-radius: 17px;">

		<input style="cursor:pointer;letter-spacing:3px;color:#2b95ff;-moz-border-radius: 17px;border-radius: 17px;border:1px solid white;background:white;padding:2px 9px;" type="submit" name="info_update" value="<?php _e(' Update the Settings '); ?>" />

	</div>
	</form>



<div style="padding: 10px 20px 0 45px">

 &nbsp;&nbsp;  &raquo; <a style="color:#2b95ff;text-decoration:none;" href="http://www.thefreewindows.com/11487/incorporating-socializer-web-scripts-software-creating-manual-sharelinks/" target="_blank">Instructions for Manual Use</a> &mdash; to create occasional share-links or incorporate Socializer! in your own scripts or software.
<br>&nbsp;<br>
 &nbsp;&nbsp;  &raquo; <a style="color:#2b95ff;text-decoration:none;" href="http://www.thefreewindows.com/6035/socializer-wordpress-frequent-questions-answers/" target="_blank">FQA</a> &mdash; read answers, ask questions
<br>&nbsp;<br>
 &nbsp;&nbsp;  &raquo; <a style="color:#2b95ff;text-decoration:none;" href="http://www.socializer.info/" target="_blank">Socializer! Home</a> & <a style="color:#2b95ff;text-decoration:none;" href="http://www.thefreewindows.com/5598/socializer-share-wordpress-posts-pages/" target="_blank">Plugin Page at TheFreeWindows</a>

<br>&nbsp;<br>

<br>&nbsp;<br>

<div align="center" style="text-align:center;margin-top:30px;"> &nbsp;  &nbsp;  &nbsp; <a style="color:silver;text-decoration:none;font-weight:bold;font-size:20pt;letter-spacing:3px;" href="http://www.socializer.info/" target="_blank">www.socializer.info</a></div>
	</div>	



	</div><?php
}

function tfw_generate($content) {	

	$tfw_sposts = get_option('tfw_sposts');
	$tfw_spages = get_option('tfw_spages');	
	$tfw_spbe = get_option('tfw_spbe');
	$tfw_spaf = get_option('tfw_spaf');	
	$tfw_sindarch = get_option('tfw_sindarch');	
	$tfw_stl = get_option('tfw_stl');
	$tfw_stlw = get_option('tfw_stlw');
	$tfw_stldiv = get_option('tfw_stldiv');
	$tfw_stlwdiv = get_option('tfw_stlwdiv');
	$tfw_cimg = get_option('tfw_cimg');
	$tfw_cimgw = get_option('tfw_cimgw');

 	$remsp = array("'","\"");  
	$trm = str_replace($remsp, " ", $tfw_stl);
	$trmdiv = str_replace($remsp, " ", $tfw_stldiv);
	$the_social_stl = stripslashes($trm);
	$the_social_stldiv = stripslashes($trmdiv);
	$imad = str_replace($remsp, " ", $tfw_cimg);

	$the_social = $the_social.'<div id="Socializer" style="'.$the_social_stldiv.';"><a style="border:none;" href="http://www.socializer.info/share.asp?docurl='.urlencode(get_permalink($id)).'&doctitle='.get_the_title("").'" target="_blank"><img  src="'.$imad.'" alt="Share in top social networks!" style="'.$the_social_stl.';"></a></div>';

	$show_socializer = FALSE;

	if (is_single() && $tfw_sposts) {
		$show_socializer = TRUE;
	}

	if (is_page() && $tfw_spages) {
		$show_socializer = TRUE;
	}	

	if (is_category() && $tfw_sindarch) {
		$show_socializer = TRUE;
	}	

	if (is_tag() && $tfw_sindarch) {
		$show_socializer = TRUE;
	}	

	if (is_date() && $tfw_sindarch) {
		$show_socializer = TRUE;
	}	

	if (is_home() && $tfw_sindarch) {
		$show_socializer = TRUE;
	}	

	if (!$show_socializer) {
		return $content;
	}

	if (is_single() && $tfw_spaf && $show_socializer) 
		$content .= $the_social;

	if (is_single() && $tfw_spbe && $show_socializer) 
		$content = $the_social.$content;

	if (is_page() && $tfw_spaf && $show_socializer) 
		$content .= $the_social;

	if (is_page() && $tfw_spbe && $show_socializer) 
		$content = $the_social.$content;

	if  ( ( is_home() || is_category() || is_tag() || is_date() ) && $tfw_spbe && $show_socializer )  
		$content = $the_social.$content;

	if ( (is_home() || is_category() || is_tag() || is_date() ) && $tfw_spaf && $show_socializer )
		$content .= $the_social;

	return $content;

}

class SocializerWidget extends WP_Widget {

    function SocializerWidget() {
        $widget_ops = array('classname' => 'widget_text', 'description' => __('Socializer! Widget'));
        $this->WP_Widget('SocializerWidget', __('Socializer!'), $widget_ops);
    }

    function widget() {

	$tfw_stlw = get_option('tfw_stlw');
	$tfw_stlwdiv = get_option('tfw_stlwdiv');
	$tfw_cimgw = get_option('tfw_cimgw');
 	$remspw = array("'","\"");  
	$trmw = str_replace($remspw, " ", $tfw_stlw);
	$trmwdiv = str_replace($remspw, " ", $tfw_stlwdiv);
	$imadw = str_replace($remspw, " ", $tfw_cimgw);
	$the_social_stlw = stripslashes($trmw);
	$the_social_stlwdiv = stripslashes($trmwdiv);
?>

<div id="SocializerW" style="<?=$the_social_stlwdiv ?>;"><a style="border:none;" href='http://www.socializer.info/share.asp?docurl=http://<?php echo urlencode($_SERVER["HTTP_HOST"]) ?><?php echo urlencode($_SERVER["REQUEST_URI"]); ?>&doctitle=<?php wp_title(); ?> <?php if ( is_home() ) { bloginfo("name"); } ?>' target="_blank"><img src="<?=$imadw ?>" alt="Share in top social networks!" style="<?=$the_social_stlw ?>;"></a></div>
        
<?php
    }
}

function SocializerWidgetInit() {
    register_widget('SocializerWidget');
}

add_filter('the_content', 'tfw_generate', 1000);
add_action('admin_menu', 'tfw_add_option_pages');
add_action('widgets_init', 'SocializerWidgetInit');

?>