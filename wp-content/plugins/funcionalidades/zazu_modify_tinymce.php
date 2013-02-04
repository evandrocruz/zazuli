<?php
function zazu_modify_tinymce($init){
    $init['theme_advanced_blockformats'] = 'p,h1,h2,h3';
	
	$init['theme_advanced_disable'] = 'forecolor';

	return $init;
}

add_filter('tiny_mce_before_init','zazu_modify_tinymce');
?>