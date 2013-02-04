<?php
global $wp;
$current_url = add_query_arg( $wp->query_string, '', home_url( $wp->request ) )
?>
<div id="area-de-login" class="offset-by-ten four columns form-wrapper">
	<form class="four columns alpha omega" action="<?php echo wp_login_url($current_url); ?>" method="post">
		<div class="input-area-de-login two columns alpha">
			<input type="text" value="email" name="log" class="username"/>
		</div>
		<div class="input-area-de-login two columns omega">
			<input type="text" value="senha" class="fake-password"/>
			<input type="password" value="" name="pwd" class="password"/>
		</div>
		<div id="cadastrar-se" class="two columns alpha">
			<a href="<?php echo site_url(); ?>/wp-login.php?action=register">Cadastrar-se</a>
		</div>
		<div id="botao-entrar" class="two columns omega">
			<input type="submit" value="Entrar"/>
		</div>
	</form>
	<?php include( TEMPLATEPATH . '/searchform_header.php' ); ?>
</div>