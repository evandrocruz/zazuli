<?php

function zazu_atualizar_notificacoes(){
    	$usuario_atual = wp_get_current_user();
		
		$notificacoes = get_user_meta($usuario_atual->ID, 'notificacoes', TRUE);
		$notificacoes = zazu_filtrar_nao_lidas($notificacoes);
		
		//if(!empty($notificacoes)){
			/*
			foreach ($notificacoes as $k => $v) {
				if($v['lida'] === 'N'){
					get_header_notificacoes();
					break;
				}
			}
			 */
			 get_header_notificacoes();
		//}
		die();
	}

function zazu_marcar_notificacao_como_lida(){
	$usuario_atual = wp_get_current_user();
	$id_notificacao = $_POST['id_notificacao'];
	
	$notificacoes = get_user_meta($usuario_atual->ID, 'notificacoes', TRUE);
	
	foreach ($notificacoes as $k => &$v) {
		if($v['id'] == $id_notificacao){
			$v['lida'] = 'S';
		}
	}
	update_user_meta($usuario_atual->ID, 'notificacoes', $notificacoes);
	
	die();
}

	//add_action( 'wp_ajax_nopriv_zazu_atualizar_notificacoes', 'zazu_atualizar_notificacoes' );  
	add_action( 'wp_ajax_zazu_atualizar_notificacoes', 'zazu_atualizar_notificacoes' );
	add_action( 'wp_ajax_zazu_marcar_notificacao_como_lida', 'zazu_marcar_notificacao_como_lida' );

?>