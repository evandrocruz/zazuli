<?php

function add_videos_button() {
   // Don't bother doing this stuff if the current user lacks permissions
   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
     return;
 
   // Add only in Rich Editor mode
   if ( get_user_option('rich_editing') == 'true') {
     add_filter("mce_external_plugins", "add_videos_tinymce_plugin");
     add_filter('mce_buttons', 'register_videos_button');
   }
}
 
function register_videos_button($buttons) {
   array_push($buttons, "|", "youryoutube", "yourvimeo");
   return $buttons;
}
 
// Load the TinyMCE plugin : editor_plugin.js (wp2.5)
function add_videos_tinymce_plugin($plugin_array) {
   $plugin_array['yourvideos'] = get_bloginfo('template_url').'/js/editor_plugin_botoes_video.js';
   return $plugin_array;
}
 
function my_refresh_mce($ver) {
  $ver += 3;
  return $ver;
}

// init process for button control
add_filter( 'tiny_mce_version', 'my_refresh_mce');
add_action('init', 'add_videos_button');


?>