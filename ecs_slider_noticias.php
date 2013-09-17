<?php 

function ecs_slider_noticias($ecs_div_id, $ecs_title, $ecs_posts_num, $ecs_author) {
	?>
	<div id="<?php echo $ecs_div_id; ?>" class="sixteen columns slider-wrapper alpha omega">
		<h3><?php echo esc_attr($ecs_title); ?></h3>
		<ul id="notfoo" class="slider">
			<!-- <div class="slider-center-flourish one-third column offset-by-five omega"></div> -->
			<?php $ecs_posts_args = array(
					'author' => $ecs_author,
					'showposts' => $ecs_posts_num,
				    'post_type' => 'post',
				    'meta_key' => 'pontuacao',
				    'orderby' => 'meta_value',
				    'order' => 'DESC'
        		); ?>
			<?php $ecs_posts = new WP_Query($ecs_posts_args); ?>
			<?php //$ecs_posts->query(); ?>
			<?php while ($ecs_posts->have_posts()) : $ecs_posts->the_post(); ?>
			<li class="one-third column omega" style="background-image: url(<?php echo get_first_image(); ?>); height: 200px;">
				<div>
					<h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
				</div>
			</li>
			<?php endwhile; ?>
		</ul>
	</div>
<?php } 

function ecs_slider_tags($ecs_div_id, $ecs_title, $ecs_tags_num) {
	?>
	<div id="<?php echo $ecs_div_id; ?>" class="sixteen columns slider-wrapper alpha omega">
		<h2><?php echo esc_attr($ecs_title); ?></h2>
		<ul id="notfoo" class="slider">
			<!-- <div class="slider-center-flourish one-third column offset-by-five omega"></div> -->
			<?php $ecs_tags_args = array(
                                    'number' => $ecs_tags_num,
				    'orderby' => 'meta_value_num',
                                    'meta_key' => 'pontuacao',
				    'order' => 'DESC'
        		); ?>
			<?php $ecs_tags = get_tags($ecs_tags_args); ?>
			<?php foreach ($ecs_tags as $tag ) {
                            $tag_link = get_tag_link( $tag->term_id );
                            ?>
                            <li class="one-third column omega" style="background-image: url(<?php echo get_first_tag_image($tag->name); ?>); height: 200px;">
                                <div>
                                    <h4><a href="<?php echo $tag_link; ?>"><?php echo $tag->name; ?></a></h4>
				</div>
                            </li>
                            <?php
                        }?>
		</ul>
	</div>
<?php } 

function ecs_slider_from_tag($ecs_div_id, $ecs_posts_num, $ecs_tag) {
	?>
	<div id="<?php echo $ecs_div_id; ?>" class="sixteen columns slider-wrapper alpha omega">
		<ul id="notfoo" class="slider">
			<?php $ecs_tag_args = array(
                                    'number' => 9,
				    'orderby' => 'meta_value_num',
                                    'meta_key' => 'pontuacao',
				    'order' => 'DESC',
                                    'showposts' => $ecs_posts_num,
                                    'tag_slug__in' => $ecs_tag
        		); 
			$ecs_posts = new WP_Query($ecs_tag_args);
			while ($ecs_posts->have_posts()) : $ecs_posts->the_post(); ?>
			<li class="one-third column omega" style="background-image: url(<?php echo get_first_image(); ?>); height: 200px;">
				<div>
					<h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
				</div>
			</li>
			<?php endwhile; ?>
		</ul>
	</div>
<?php } 

?>