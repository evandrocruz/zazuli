<?php get_header(); ?>
	<div id="content">
		<div class="container content-list">
			<div class="twelve columns">
				<?php if (have_posts()) : ?>

					<?php $post = $posts[0]; // Set $post to use the_date(). ?>

					<?php /* If this is a tag archive */ if( is_tag() ) { ?>
						<h2>Postagens com a tag: &#8216;<?php single_tag_title(); ?>&#8217;</h2>
					<?php } ?>

					<?php include (TEMPLATEPATH . '/inc/nav.php' ); ?>

					<?php while (have_posts()) : the_post(); ?>
						
						<div <?php post_class() ?>>
						
								<h2 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
							
								<small><?php include (TEMPLATEPATH . '/inc/meta-tags.php' ); ?></small>

								<div class="entry destaque-sublinhado">
									<?php the_excerpt(); ?>
									<a href="<?php the_permalink() ?>">leia mais</a>
								</div>

						</div>

					<?php endwhile; ?>

					<?php include (TEMPLATEPATH . '/inc/nav.php' ); ?>
						
				<?php else : ?>
					<h2>Nothing found</h2>
				<?php endif; ?>
			</div>
			<?php //include (TEMPLATEPATH . '/inc/register.php' ); ?>
		</div>
	</div>

<?php get_footer(); ?>
