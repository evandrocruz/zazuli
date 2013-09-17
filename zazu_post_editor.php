<?php 
//Caixas expansíveis pra texto
function zazu_expansible_text_box($atts = null, $content) {
	$content = '<div class="expansible-box"><h2><a class="expansible-link hand-cursor"> + ' . $atts['title'] . '</a></h2><div class="expansible-content">' . $content . '</div></div>';
	return $content;
}

add_shortcode('expansivel', 'zazu_expansible_text_box');
 
?>