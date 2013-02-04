<?php 

function ecs_slider_noticias($ecs_div_id, $ecs_title, $ecs_posts_num, $ecs_author) {
	?>
	<div id="<?php echo $ecs_div_id; ?>" class="sixteen columns slider-wrapper alpha omega">
		<h3><?php echo esc_attr($ecs_title); ?></h3>
		<ul id="notfoo" class="slider">
			<!-- <div class="slider-center-flourish one-third column offset-by-five omega"></div> -->
			<?php $ecs_posts = new WP_Query(); ?>
			<?php $ecs_posts->query('showposts='.$ecs_posts_num.'&author='.$ecs_author); ?>
			<?php while ($ecs_posts->have_posts()) : $ecs_posts->the_post(); ?>
			<li class="one-third column omega" style="background-image: url(<?php echo get_first_image(); ?>); height: 200px;">
				<div>
					<h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
				</div>
			</li>
			<?php endwhile; ?>
		</ul>
	</div>
<?php } ?>