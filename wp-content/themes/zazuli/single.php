<?php get_header(); ?>
	<div id="content" class="news">
		<div class="container content-list">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
				
				<h1><?php the_title(); ?></h1>
				
				<?php include (TEMPLATEPATH . '/inc/meta.php' ); ?>

				<div class="entry">
					
					<?php the_content(); ?>

					<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
					
					<h3><?php the_tags( 'Tags: ', ', ', ''); ?></h3>

				</div>
				
				<?php edit_post_link('Edit this entry','','.'); ?>
				
			</div>
			<?php print PostRatings()->getControl(); ?>
			<?php comments_template(); ?>

			<?php endwhile; endif; ?>
		</div>
	</div>
<?php get_footer(); ?>