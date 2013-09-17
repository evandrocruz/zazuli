<?php 

function get_first_image() {
	$files = get_children('post_parent='.get_the_ID().'&post_type=attachment&post_mime_type=image');
	if($files) :
	    $keys = array_reverse(array_keys($files));
	    $j=0;
	    $num = $keys[$j];
		//$ecgfi_imgurl = wp_get_attachment_image_src($num, array(400,230));
		$ecgfi_imgurl = wp_get_attachment_image_src($num, array(800,500));
		if($ecgfi_imgurl[0]):
			return $ecgfi_imgurl[0];
		endif;
	else:
		return get_bloginfo("template_directory") . "/images/default_slider_image.jpg";	
    endif;
}

function get_random_image_from_tag($tag_name) {
        $min_width = 400;
        $min_height = 200;
        $imgs = array(0);
        $post_offset_num = 0;
        while ( !array_key_exists( 10, $imgs ) && $imgs[0] !== "fim" ) :
            $args = array(
                'offset' => $post_offset_num,
		'orderby' => 'meta_value',
                'meta_key' => 'pontuacao',
                'order' => 'DESC',
                'showposts' => 10,
                'tag_slug__in' => $tag_name
            );
            $wp_query = new WP_Query( $args );
            if ( $wp_query->have_posts() ) :
                while ($wp_query->have_posts()) :
                    $wp_query->the_post();
                    $files = get_children('numberposts=1&post_parent='.get_the_ID().'&post_type=attachment&post_mime_type=image');
                    if($files) :
                        $keys = array_reverse(array_keys($files));
                        $k=0;
                        $num = $keys[$k];
                            $imgurl = wp_get_attachment_image_src($num, 'full');
                            if( isset( $imgurl[0] )):
                                array_push($imgs, $imgurl[0]);
                            endif;
                    else:
                        $post_offset_num =+ 10;
                    endif;
                endwhile;
            else:
                if( !array_key_exists( 1, $imgs ) ):
                    return;
                else:
                    $imgs[0] = "fim";
                endif;
            endif;
        endwhile;
        
        $imgs_size = count($imgs);
        $imgs_size--;
        $random_img_index = rand(1,$imgs_size);

        return $imgs[$random_img_index];
        //return 'xala';
}

?>