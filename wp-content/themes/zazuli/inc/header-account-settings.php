<?php
global $wp;
$current_url = add_query_arg( $wp->query_string, '', home_url( $wp->request ) )
?>
<div id="area-perfil" class="offset-by-four ten columns">
	<div class="four columns alpha">
		<?php include( TEMPLATEPATH . '/searchform_header.php' ); ?>
	</div>
	<?php $current_user = wp_get_current_user(); ?>
	<div class="offset-by-three three columns omega">
		<p><?php echo esc_attr('Olá, '); echo $current_user->user_firstname; ?></p>
		<a id="mesa-escritor-link" class="destaque-sublinhado" href="#">Mesa do Escritor</a>
		<ul id="menu-mesa">
			<li><p><a href="<?php echo get_admin_url(); ?>post-new.php">Escrever notícia</a></p></li>
			<li><p><a href="<?php echo get_admin_url(); ?>profile.php">Alterar perfil</a></p></li>
			<li><p id="logout-link"><a href="<?php echo wp_logout_url($current_url); ?> ">Sair</a></p></li>
		</ul>
	</div>
</div>