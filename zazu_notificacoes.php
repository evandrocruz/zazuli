<?php
	//Inclui o Commander pras requisições ajax.
	include ("zazu_notificacoes_commander.php");
	
    function zazu_salvar_notificacao($id_comentario){
		$zazu_comm = get_comment($id_comentario);
		$zazu_comm_autor = $zazu_comm->user_id;
		$zazu_comm_post = get_post($zazu_comm->comment_post_ID);
		$zazu_post_autor = $zazu_comm_post->post_author;
		$id_publicacao = '';
		/* Define o tipo de notificacao.
		 * comentario: Comentário feito em outro comentário.
		 * post: Comentário sem pai, diretamente no post.
		 */
		$tipo = '';
		//Se tiver um comentário pai, é um comentário em comentário. Se não tiver, é um comentário diretamente no post. 
		if($zazu_comm->comment_parent != 0){
			$tipo = 'comentario';
			$id_publicacao = $zazu_comm->comment_ID;
		}else{
			$tipo = 'post';
			$id_publicacao = $zazu_comm->comment_post_ID;
		}
		
		$notificacao_atual = array('id' => '0', 'tipo' => $tipo, 'data' => $zazu_comm->comment_date_gmt ,'autor_comentario' => $zazu_comm_autor, 'id_publicacao' => $id_publicacao, 'lida' => 'N', 'com_par' => $zazu_comm->comment_parent);
		$notificacoes[] = $notificacao_atual;

		//Verifica a existencia do id da ultima notificação nos metadados. Se não existir, cria. Se existir, adiciona um e atualiza nos metadados.
		$notificacoes_ultimo_id = 0;	
		if(!metadata_exists('user', $zazu_post_autor, 'notificacoes_ultimo_id')){
			add_user_meta($zazu_post_autor, 'notificacoes_ultimo_id', $notificacoes_ultimo_id);
		} else {
			$notificacoes_ultimo_id = get_user_meta($zazu_post_autor, 'notificacoes_ultimo_id', TRUE);
			$notificacoes_ultimo_id = $notificacoes_ultimo_id + 1;
			
			update_user_meta($zazu_post_autor, 'notificacoes_ultimo_id', $notificacoes_ultimo_id);
		}
		
		/* Verifica a existencia da estrutura de notificacoes nos metadados do usuário.
		 * Se não existir, cria. Se existir, adiciona a entrada atual à matriz e atualiza os metadados.
		 */
		if(!metadata_exists('user', $zazu_post_autor, 'notificacoes')){
			add_user_meta($zazu_post_autor, 'notificacoes', $notificacoes);
			
		} else{
			unset($notificacoes);
			$notificacoes = get_user_meta($zazu_post_autor, 'notificacoes', TRUE);
			//Atualizar o id: conta o numero de notificações que o usuário ja tem. O id começa do zero, pra bater com a numeração das matrizes.
			$notificacao_atual['id'] = $notificacoes_ultimo_id;
			$notificacoes[] = $notificacao_atual;
			update_user_meta($zazu_post_autor, 'notificacoes', $notificacoes);
			
		}

	}
	
	function zazu_excluir_notificacao(){
		if(!(get_user_meta($zazu_post_autor, 'notificacoes', TRUE))){
			add_user_meta($zazu_post_autor, 'notificacoes', $notificacoes);
		}
	}
	
	function zazu_mostrar_notificacoes($id_usuario, $novas = FALSE){
		$notificacoes = zazu_pegar_notificacoes($id_usuario, '', $novas);
		
		$numero_de_notificacoes = count($notificacoes[0]);
		$numero_total_de_notificacoes = $numero_de_notificacoes;
		
		if($novas == TRUE){
			$notificacoes = zazu_filtrar_nao_lidas($notificacoes, 4);
			$numero_de_notificacoes = count($notificacoes[0]);
		}
		
		?><div id="notificacoes">	
		<?php
		if (!($notificacoes[0][0])) {
			unset($notificacoes);
			$notificacao_atual = array(array('id' => '0', 'tipo' => 'vazio', 'data' => $zazu_comm->comment_date_gmt ,'autor_comentario' => '', 'id_publicacao' => '', 'lida' => 'N', 'com_par' => $zazu_comm->comment_parent));
			$notificacoes[0] = $notificacao_atual;
			$numero_de_notificacoes = 1;
		}
			for ($i=0; $i < $numero_de_notificacoes; $i++) {
				$usuario_comentador = get_user_by('id', $notificacoes[0][$i]['autor_comentario']);
				$id_notificacao = $notificacoes[0][$i]['id'];
				$tipo_notificacao = $notificacoes[0][$i]['tipo'];
				$link = '';
				$titulo_comentado = '';
				switch ($tipo_notificacao) {
					case 'post':
						$titulo_comentado = get_the_title($notificacoes[0][$i]['id_publicacao']);
						$link = get_permalink($notificacoes[0][$i]['id_publicacao']);
						break;
					case 'comentario':
						$comentario = get_comment($notificacoes[0][$i]['id_publicacao']);
						$titulo_comentado = get_the_title($comentario->comment_post_ID);
						$link = get_comment_link($comentario);
						break;
				}				
				?><div class="notificacao">
					<input type="hidden" class="id-notificacao" value="<?php echo $id_notificacao; ?>">
					<?php 
					
					switch($tipo_notificacao) {
						case "comentario":
							?><p><a href="<?php echo $link; ?>"><?php echo $usuario_comentador->display_name; echo esc_attr(' comentou em seu comentário em '); echo $titulo_comentado; ?></a></p><?php
							break;
						case "post":
							?><p><a href="<?php echo $link; ?>"><?php echo $usuario_comentador->display_name; echo esc_attr(' comentou em '); echo $titulo_comentado; ?></a></p><?php
							break;
						case "vazio":
							?><p><a href='<?php echo get_permalink(get_page_by_title('Notificações')); ?>'><?php echo esc_attr('Nenhuma notificação nova...'); ?></a></p><?php	
							break;
					}?>
				</div><?php
			}
		?></div><?php
	}
	
	function zazu_pegar_notificacoes($id_usuario, $quantia = 0, $novas_notificacoes = FALSE){
		$notificacoes = get_user_meta($id_usuario, 'notificacoes');
		
		//Inverte a ordem pra deixar em ordem cronológica crescente.
		//$notificacoes[0] = array_reverse($notificacoes[0]);
		$numero_de_notificacoes = count($notificacoes[0]);
		
		//Se a flag 'lidas' for verdadeira, eliminar as notificacoes que ja tiverem sido lidas.
		if($novas_notificacoes == TRUE){
			for ($i=0; $i < $numero_de_notificacoes; $i++) { 
				if($notificacoes[0][$i]['lida'] === 'S'){
					unset($notificacoes[0][$i]);
				}
			}
		}
		
		if($quantia != 0){
			$notificacoes[0] = array_slice($notificacoes[0], -$quantia);
		}
		
		//Inverte a ordem pra deixar em ordem cronológica decrescente(mais novos primeiro).
		if($notificacoes[0]){
			$notificacoes[0] = array_reverse($notificacoes[0]);
		}
		
		return $notificacoes;
	}
	
	function zazu_pegar_numero_de_notificacoes(){
		$usuario = wp_get_current_user();
		$notificacoes = zazu_pegar_notificacoes($usuario->ID, '', TRUE);
		
		return(count($notificacoes[0]));
	}
	//Filtra uma array com notificacoes deixando apenas as notificações não lidas. Limita também o número de notificações($quantia), trazendo as mais recentes sempre.
	function zazu_filtrar_nao_lidas($notificacoes, $quantia = 0){
		if($notificacoes[0] && $quantia != 0){
			$notificacoes[0] = array_slice($notificacoes[0], 0, $quantia);
		}
		
		return $notificacoes;
	}
	
	add_action('comment_post', 'zazu_salvar_notificacao', $id_comentario);
	do_action('comment_post', $id_comentario);
	
	
	function zazu_reset_user_metadata(){
		$users = get_users();
		foreach ($users as $key => $value) {
			delete_user_meta($value->ID, 'notificacoes');
			delete_user_meta($value->ID, 'notificacoes_ultimo_id');	
		}
	}
	
	
	function get_header_notificacoes(){
	?><a id="notificacoes-link" class="destaque-sublinhado" href="#"><p id="numero-notificacoes" class="notificacoes-apagado"><?php echo zazu_pegar_numero_de_notificacoes(); ?></p></a>
	<div id="notificacoes-wrapper" class="three columns janela">
		<?php zazu_mostrar_notificacoes(get_current_user_id(), TRUE); ?>
		<a href="<?php echo get_permalink(get_page_by_title('Notificações')); ?>">mais</a>
	</div>
	<?php
	}
	
	//Resetar o metadados do admin pra teste:
	//zazu_reset_user_metadata();
?>