<?php
	function zazu_adicionar_lista_pontuacao_post(){
		$pontuacao = zazu_get_current_post_pontuacao();
		if(is_user_logged_in()){
			$pontuacao_escolhida = zazu_pontuacao_voto_atual('post', get_the_ID());
		}else{
			$pontuacao_escolhida = 0;
		}
		 $pontuacao_elemento =
		'<div class="pontuacao-wrapper eight columns">
			<h2><small>Pontuação: </small><span class="pontuacao">' . $pontuacao . '</span></h2>';
			if(is_user_logged_in()){
				switch ($pontuacao_escolhida) {
					case '-1':
						$pontuacao_elemento = $pontuacao_elemento . '<ul class="pontuacao-regua pontuacao-post">
							<li class="destaque-regua"><a href="#">-1</a></li>
							<li><a href="#">0</a></li>
							<li><a href="#">+1</a></li>
							<li><a href="#">+2</a></li>
						</ul>';		
						break;
					
					case '0':
						$pontuacao_elemento = $pontuacao_elemento . '<ul class="pontuacao-regua pontuacao-post">
							<li><a href="#">-1</a></li>
							<li class="destaque-regua"><a href="#">0</a></li>
							<li><a href="#">+1</a></li>
							<li><a href="#">+2</a></li>
						</ul>';		
						break;
						
						case '+1':
						$pontuacao_elemento = $pontuacao_elemento . '<ul class="pontuacao-regua pontuacao-post">
							<li><a href="#">-1</a></li>
							<li><a href="#">0</a></li>
							<li class="destaque-regua"><a href="#">+1</a></li>
							<li><a href="#">+2</a></li>
						</ul>';		
						break;
						
						case '+2':
						$pontuacao_elemento = $pontuacao_elemento . '<ul class="pontuacao-regua pontuacao-post">
							<li><a href="#">-1</a></li>
							<li><a href="#">0</a></li>
							<li><a href="#">+1</a></li>
							<li class="destaque-regua"><a href="#">+2</a></li>
						</ul>';		
						break;
				}
			}
			
			$pontuacao_elemento = $pontuacao_elemento . '<input type="hidden" class="pontuacao-post-id" value="' .  get_the_ID() . '" />
				</div>';
		
		//$content = $pontuacao_elemento . $content;
		
    	echo $pontuacao_elemento;
		
		return $pontuacao;
	}
	
	function zazu_adicionar_lista_pontuacao_comentario($content){
		 $pontuacao_elemento =
		'<div class="pontuacao-wrapper">
			<ul class="pontuacao-regua pontuacao-comentario">
				<li><a href="#">-1</a></li>
				<li><a href="#">0</a></li>
				<li><a href="#">1</a></li>
				<li><a href="#">2</a></li>
			</ul>
			<input type="hidden" class="pontuacao-comentario-id" value="' .  get_comment_ID()  . '" />
		</div>';
		$debug3 = "<br/>" . zazu_debug3();
		$content = $content . $pontuacao_elemento . $debug3;
    	return $content;
	}
	
	function zazu_atualizar_pontuacao_post() {
		$pontuacao_post_id = $_POST['id_post'];
		$valor_pontuacao = intval($_POST['valor']);
		
		if(metadata_exists('post', $pontuacao_post_id, 'pontuacao')){
			$valor_atual = get_post_meta($pontuacao_post_id, 'pontuacao', TRUE);
			update_post_meta($pontuacao_post_id, 'pontuacao', $valor_atual + $valor_pontuacao);
		} else {
			add_post_meta($pontuacao_post_id, 'pontuacao', $valor_pontuacao);
			$metasdopost = get_post_meta($pontuacao_post_id, 'pontuacao', true);
		var_dump($metasdopost);
		}
		
		if(zazu_pontuacao_ja_votou('post', $pontuacao_post_id)){
			zazu_desfazer_pontuacao('post', $pontuacao_post_id);
		}
		zazu_atualizar_historico_pontuacao_usuario('post', $pontuacao_post_id, $valor_pontuacao);
		
		die();
	}
	
	function zazu_atualizar_pontuacao_comentario() {

		$pontuacao_comentario_id = $_POST['id_comentario'];
		$valor_pontuacao = intval($_POST['valor']);
		
		if(metadata_exists('comment', $pontuacao_comentario_id, 'pontuacao')){
			$valor_atual = get_comment_meta($pontuacao_comentario_id, 'pontuacao', TRUE);
			update_comment_meta($pontuacao_comentario_id, 'pontuacao', $valor_atual + $valor_pontuacao);
		} else {
			add_comment_meta($pontuacao_comentario_id, 'pontuacao', $valor_pontuacao);
			$metasdocomentario = get_comment_meta($pontuacao_comentario_id, 'pontuacao', true);
		var_dump($metasdocomentario);
		}
		
		if(zazu_pontuacao_ja_votou('comentario', $pontuacao_comentario_id)){
			zazu_desfazer_pontuacao('comentario', $pontuacao_comentario_id);
		}
		zazu_atualizar_historico_pontuacao_usuario('comentario', $pontuacao_comentario_id, $valor_pontuacao);
		
		die();
	}
	
	function zazu_atualizar_historico_pontuacao_usuario($tipo, $id_publicacao, $pontuacao) {
		$usuario_atual = get_current_user_id();
		$pontuacao_ultimo_id = 1;
		
		if(!metadata_exists('user', $usuario_atual, 'historico_pontuacao_ultimo_id')){
			add_user_meta($usuario_atual, 'historico_pontuacao_ultimo_id', $pontuacao_ultimo_id);
		} else {
			$pontuacao_ultimo_id = get_user_meta($usuario_atual, 'historico_pontuacao_ultimo_id', TRUE);
		}
		
		if(!metadata_exists('user', $usuario_atual, 'historico_pontuacao')){
			$novo_historico_pontuacao = array('id' => 1, 'tipo' => $tipo, 'id_publicacao' => $id_publicacao, 'pontuacao' =>$pontuacao);
			$historico_pontuacao[] = $novo_historico_pontuacao; 
			add_user_meta($usuario_atual, 'historico_pontuacao', $historico_pontuacao);
		} else {
			$pontuacao_id_atual = $pontuacao_ultimo_id + 1;
			$historico_pontuacao = get_user_meta($usuario_atual,  'historico_pontuacao', TRUE);
			$novo_historico_pontuacao = array('id' => $pontuacao_id_atual, 'tipo' => $tipo, 'id_publicacao' => $id_publicacao, 'pontuacao' =>$pontuacao);
			$historico_pontuacao[] = $novo_historico_pontuacao;
			
			update_user_meta($usuario_atual, 'historico_pontuacao', $historico_pontuacao);
		}
	}

	function zazu_pontuacao_ja_votou($tipo, $id_publicacao) {
		$usuario_atual = get_current_user_id();
		$historico_pontuacao = get_user_meta($usuario_atual,  'historico_pontuacao', TRUE);
		
		if($historico_pontuacao){
			foreach ($historico_pontuacao as $key => $value) {
				if($value['tipo'] === $tipo && $value['id_publicacao'] === $id_publicacao) {
					return true;
				}
			}
		}
		return false;
	}

	function zazu_pontuacao_voto_atual($tipo, $id_publicacao){
		$usuario_atual = get_current_user_id();
		$historico_pontuacao = get_user_meta($usuario_atual,  'historico_pontuacao', TRUE);
		$id_publicacao = strval($id_publicacao);

		if($historico_pontuacao){
			foreach ($historico_pontuacao as $key => $value) {
				if($value['tipo'] === $tipo && $value['id_publicacao'] === $id_publicacao) {
					return $value['pontuacao'];
				}
			}
		}
		return 0;
	}

	function zazu_desfazer_pontuacao($tipo, $id_publicacao) {
		$usuario_atual = get_current_user_id();
		$historico_pontuacao = get_user_meta($usuario_atual,  'historico_pontuacao', TRUE);
		
		foreach ($historico_pontuacao as $key => &$value) {
			if( ( $value['tipo'] === $tipo ) && ( $value['id_publicacao'] === $id_publicacao ) ) {
				if($tipo === 'post'){
					$pontuacao_atual = get_post_meta($id_publicacao, 'pontuacao', TRUE);
				} elseif ($tipo === 'comentario') {
					$pontuacao_atual = get_comment_meta($id_publicacao, 'pontuacao', TRUE);
				}
				
				$nova_pontuacao = intval($pontuacao_atual) - intval($value['pontuacao']);
				
				if($tipo === 'post'){
					update_post_meta($id_publicacao, 'pontuacao', $nova_pontuacao);
				} elseif ($tipo === 'comentario') {
					update_comment_meta($id_publicacao, 'pontuacao', $nova_pontuacao);
				}
				
				unset($historico_pontuacao[$key]);
			}
		}

	update_user_meta(get_current_user_id(), 'historico_pontuacao', $historico_pontuacao);

	}
	
	function zazu_get_current_post_pontuacao(){
		if(metadata_exists('post', get_the_ID(), 'pontuacao')){
			$pontuacao = get_post_meta(get_the_ID(), 'pontuacao', TRUE);
		} else {
			return 0;
		}
		return $pontuacao;
	}
	
	function zazu_debug(){
		if(metadata_exists('post', get_the_ID(), 'pontuacao')){
			$valor_atual = get_post_meta(get_the_ID(), 'pontuacao', TRUE);
		} else {
			$valor_atual = 'ioleihuskar';
		}
		
		return($valor_atual);
	}
	
	function zazu_debug2(){
		if(metadata_exists('user', get_current_user_id(), 'historico_pontuacao')){
			$valor_atual = get_user_meta(get_current_user_id(),  'historico_pontuacao', TRUE);
		} else {
			$valor_atual = 'ioleihuskar';
		}
		
		return(var_dump($valor_atual));
	}
	
	function zazu_debug3(){
		if(metadata_exists('comment', get_comment_ID(), 'pontuacao')){
			$valor_atual = get_comment_meta(get_comment_ID(), 'pontuacao', TRUE);
		} else {
			$valor_atual = 'ioleihuskar';
		}
		
		return($valor_atual);
	}

	function zazu_reset_user_metadata_pont(){
		$users = get_users();
		foreach ($users as $key => $value) {
			delete_user_meta($value->ID, 'historico_pontuacao');
			delete_user_meta($value->ID, 'historico_pontuacao_ultimo_id');	
		}
		
		$posts = get_posts();
		foreach ($posts as $key => $value) {
			delete_post_meta($value->ID, 'pontuacao');
		}
		
		$comm = get_comments();
		foreach ($comm as $key => $value) {
			delete_comment_meta($value->comment_ID, 'pontuacao');
		}
	}
	
	//zazu_reset_user_metadata_pont();
	
	//add_action('the_content', 'zazu_adicionar_lista_pontuacao_post');
	//add_action('comment_text', 'zazu_adicionar_lista_pontuacao_comentario');
	
	add_action( 'wp_ajax_zazu_atualizar_pontuacao_post', 'zazu_atualizar_pontuacao_post' );
	add_action( 'wp_ajax_zazu_atualizar_pontuacao_comentario', 'zazu_atualizar_pontuacao_comentario' );
	
?>