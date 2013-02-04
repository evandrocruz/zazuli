<?php 

function ecs_slider_imagens($ecs_div_id, $ecs_title, $ecs_posts_num, $ecs_author) {
	?>
	<div id="<?php echo $ecs_div_id; ?>" class="sixteen columns slider-wrapper alpha omega">
		<h3><?php echo esc_attr($ecs_title); ?></h3>
		<ul id="imgfoo" class="slider">
			<!-- <div class="slider-center-flourish one-third column offset-by-five omega"></div> -->
			<?php $ecs_posts = new WP_Query( array( 'post_type' => 'attachment', 'post_status' => 'inherit', 'author' => $ecs_author, 'showposts' => $ecs_posts_num) ); ?>
			<?php while ($ecs_posts->have_posts()) : $ecs_posts->the_post(); ?>
			<?php $ecs_imgurl = wp_get_attachment_image_src(get_the_ID(), array(400,230)); ?>
			<li class="one-third column omega" style="background-image: url(<?php echo $ecs_imgurl[0]; ?>); height: 200px;">
				<div>
					<h4><a href="<?php the_permalink() ?>"><?php echo ecs_get_attachment_text(get_the_ID()); ?></a></h4>
				</div>
			</li>
			<?php endwhile; ?>
		</ul>
	</div>
<?php } ?>