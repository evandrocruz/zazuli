<div id="area-de-login" class="offset-by-ten four columns form-wrapper">
	<form class="four columns alpha omega" action="<?php home_url(); ?>/wp-login.php?action=register" method="post">
		<div class="input-area-de-login two columns alpha">
			<input type="text" name="user_login" value="nome"/>
		</div>
		<div class="input-area-de-login two columns omega">					
			<input type="text" name="user_email" value="email"/>
		</div>
		<div id="botao-entrar" class="two columns omega">
			<input type="hidden" name="redirect_to" value="" /> 
			<input type="submit" name="wp-submit" value="Cadastrar"/>
		</div>
	</form>
</div>