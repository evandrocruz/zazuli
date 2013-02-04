<?php get_header(); ?>
	<div id="content">
		<div class="container content-list">
			<div class="twelve columns">
				<?php if (have_posts()) : ?>
			
					<h2>Resultados da busca:</h2>
			
					<?php include (TEMPLATEPATH . '/inc/nav.php' ); ?>
			
					<?php while (have_posts()) : the_post(); ?>
			
						<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
			
							<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			
							<?php include (TEMPLATEPATH . '/inc/meta.php' ); ?>
			
							<div class="entry destaque-sublinhado">
			
								<?php the_excerpt(); ?>
			
							</div>
			
						</div>
			
					<?php endwhile; ?>
			
					<?php include (TEMPLATEPATH . '/inc/nav.php' ); ?>
			
				<?php else : ?>
			
					<h2>No posts found.</h2>
			
				<?php endif; ?>
			</div>
		</div>
	</div>
	
<?php get_footer(); ?>
