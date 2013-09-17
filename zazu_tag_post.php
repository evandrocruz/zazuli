<?php
function zazu_tag_post() {
    $post_ID = $_POST['post_ID'];
    $tags = $_POST['tags'];
    
    wp_set_post_tags( $post_ID, $tags, TRUE );    
    die();
}

function zazu_load_tags(){
    $post_ID = $_POST['post_ID'];
    $query_args = array(
        'p' => $post_ID
    );
    $post = new WP_Query($query_args);
    
    if ($post->have_posts()) : $post->the_post(); endif;
    
    ?><h3 class="tags"><?php the_tags( 'Tags: ', ', ', ''); ?></h3><?php
    
    die();
}

add_action( 'wp_ajax_zazu_tag_post', 'zazu_tag_post' );
add_action( 'wp_ajax_zazu_load_tags', 'zazu_load_tags' );
?>
