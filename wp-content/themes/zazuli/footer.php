
		<div id="footer">
			<div class="container">
				<?php wp_nav_menu( array( 'menu' => 'rodape' ) ); ?>
				<div class="footer-icons">
					<a href="http://pt.wordpress.org/"><img src="<?php bloginfo('template_directory'); ?>/images/wordpress_logo.png" /></a>
					<a href="<?php echo get_permalink( get_page_by_path( 'copyleft' ) ); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/copyleft.png" /></a>
				</div>
			</div>
		</div>
</div> <!-- #wrapper -->
	<?php wp_footer(); ?>
	
	<!-- Don't forget analytics -->
	
</body>

</html>
