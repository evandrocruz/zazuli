<?php get_header(); ?>
	<div id="description" class="highlighted-text-box">
		<div class="container">
			<p class="eight columns highlighted-text"><?php echo esc_attr("Praticando jornalismo coletivo em suas multiplicidades.") ?></p>
			<p class="eight columns light-highlighted-text"><?php echo esc_attr("Acreditamos que a transparência é fundamental para a construção da Liberdade de Imprensa.");?><br /><?php echo esc_attr("O Zazu é um espaço para isso: o jornalismo livre e com fontes abertas, produzido, discutido e expandido por todos nós - leitores, comentadores e escritores."); ?></p>
		</div>
	</div>
	<div id="notice" class="highlighted-text-box centered-text top-shadow">
		<p class="light-highlighted-text"><a href="<?php echo get_permalink( get_page_by_path( 'ferramentas_alfa' ) ); ?>"><?php echo esc_attr("Ajude-nos a aprimorar a experiência do Zazu") ?></a></p>
	</div>
	<div id="content" class="top-shadow">
		<div class="container">
			<?php ecs_slider_noticias("artigos-mais-populares", "Artigos mais populares", "10",""); ?>
			<div id="latest-articles" class="eight columns">
				<h3>Artigos mais recentes</h3>
				<ul>
					<?php $artigosRecentes = new WP_Query(); ?>
					<?php $artigosRecentes->query('showposts=4'); ?>
					<?php while ($artigosRecentes->have_posts()) : $artigosRecentes->the_post(); ?>
						<li>
							<h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
							<p><?php the_author_posts_link(); ?> as <?php the_time(); ?>, <?php the_date(); ?></p>
						</li>
					<?php endwhile; ?>
				</ul>
			</div>
			<div id="tags" class="eight columns">
				<h3>Tags</h3>
				<?php wp_tag_cloud('smallest=16&largest=28&number=20&orderby=count'); ?>
				<img src="" alt="" />
				<p><a href="<?php echo bloginfo("") ?>">mais tags</a></p>
			</div>
		</div><!-- fim de #container -->
	</div><!-- fim de #content -->
<?php get_footer(); ?>