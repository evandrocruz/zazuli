<?php 
function ecs_get_attachment_text( $attachment_id ){
	$attachment = get_post( $attachment_id );
	$att_text = $attachment->post_title;
	if($att_text){
		return $att_text;
	}else {
		$att_text = get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true );
		if($att_text){
			return $att_text;
		}else {
			return basename ( get_attached_file( $attachment->ID ) );
		}
	}
}
?>