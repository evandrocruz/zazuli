<?php 

function get_first_image() {
	$files = get_children('post_parent='.get_the_ID().'&post_type=attachment&post_mime_type=image');
	if($files) :
	    $keys = array_reverse(array_keys($files));
	    $j=0;
	    $num = $keys[$j];
		$ecgfi_imgurl = wp_get_attachment_image_src($num, array(400,230));
		if($ecgfi_imgurl[0]):
			return $ecgfi_imgurl[0];
		endif;
	else:
		return bloginfo("template_directory") . "/images/default_slider_image.jpg";	
    endif;
}

?>