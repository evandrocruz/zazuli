<?php

    function zazu_mar_de_noticias($ecs_posts_num){
	?>
	<div id="mar-de-noticias-wrapper" class="sixteen columns alpha omega">
			<?php $ecs_posts = new WP_Query(); ?>
			<?php $ecs_posts->query('showposts='.$ecs_posts_num); ?>
			<div id="mar-de-noticias" class="sixteen columns alpha omega">
				<?php while ($ecs_posts->have_posts()) : $ecs_posts->the_post(); ?>
				<?php if(strcmp(get_first_image() , get_bloginfo('template_directory') . '/images/default_slider_image.jpg') == 0): ?>
					<div class="four columns omega alpha noticia-do-mar" style="background: #777777;">
				<?php else: ?>
					<div class="five columns omega alpha noticia-do-mar" style="background: #777777 url(<?php echo get_first_image(); ?>) no-repeat center center;">
				<?php endif; ?>
					<div>
						<h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
						<p><a href="<?php the_permalink() ?>"><?php the_excerpt(); ?></a></p>
					</div>
				</div>
				<?php endwhile; ?>
			</div>
	</div>
<?php

	}
        
        function zazu_mar_de_noticias_tag($ecs_posts_num, $zazu_mar_tag){
	?>
	<div id="mar-de-noticias-wrapper" class="sixteen columns alpha omega">
			<?php $ecs_posts = new WP_Query(); 
                        $args = array(
                            'showposts' => $ecs_posts_num,
                            'tag_slug__in' => array($zazu_mar_tag)
                        );
                        $ecs_posts->query($args); ?>
			<div id="mar-de-noticias" class="sixteen columns alpha omega">
				<?php while ($ecs_posts->have_posts()) : $ecs_posts->the_post(); ?>
				<?php if(strcmp(get_first_image() , get_bloginfo('template_directory') . '/images/default_slider_image.jpg') == 0): ?>
					<div class="four columns omega alpha noticia-do-mar" style="background: #777777;">
				<?php else: ?>
					<div class="five columns omega alpha noticia-do-mar" style="background: #777777 url(<?php echo get_first_image(); ?>) no-repeat center center;">
				<?php endif; ?>
					<div>
						<h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
						<p><a href="<?php the_permalink() ?>"><?php the_excerpt(); ?></a></p>
					</div>
				</div>
				<?php endwhile; ?>
			</div>
	</div>

<?php
	}        
?>