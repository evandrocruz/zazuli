<?php get_header(); ?>
	<div id="content">
		<div class="container">
			<?php $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author)); ?>
			<div class="row"><!-- wrapping basic user profile info -->
				<div class="four columns">
					<?php userphoto($wp_query->get_queried_object()) ?>
				</div>
				<div class="twelve columns">
					<h1><?php echo $curauth->display_name; ?>,</h1>
					<h2><?php the_author_meta('epiteto', $curauth->id); ?></h2>
					<h3><?php echo $curauth->description; ?></h3>
				</div>
			</div><!-- end basic user profile info wrapper -->
			<div id="user-content" class="sixteen columns">
				<div id="latest-articles" class="eight columns">
					<h3><?php echo esc_attr("Notícias por $curauth->display_name"); ?></h3>
					<ul>
						<?php $artigosRecentes = new WP_Query(); ?>
						<?php $artigosRecentes->query("showposts=4&author=$curauth->id"); ?>
						<?php while ($artigosRecentes->have_posts()) : $artigosRecentes->the_post(); ?>
							<li>
								<h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
								<p><?php the_author(); ?> as <?php the_time(); ?>, <?php the_date(); ?></p>
							</li>
						<?php endwhile; ?>
					</ul>
				</div>
				
				<?php //ecs_slider_noticias("autor-slider-noticias", "Notícias por " . $curauth->display_name, "20", $curauth->id); ?>
				<?php ecs_slider_imagens("autor-slider-imagens", "Imagens por " . $curauth->display_name, "20", $curauth->id); ?>
				<h3><?php //echo esc_attr("Videos por "); echo $curauth->display_name; ?></h3>
			</div>
		</div>
	</div>
<?php get_footer(); ?>