<?php
//Cleans the author dashboard and removes unecessary menu items
function zazu_clean_author_dashboard() {
	//Remove dashboard widgets 
	if( current_user_can('author') ) {
		remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
		remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
		remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );
		remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
	}
}
function zazu_clean_author_menu() {
	//Remove dashboard menus
	if( current_user_can('author') ) {
		remove_menu_page('tools.php');
	}
}

//Hooking zazu_clean_author_dashboard() and zazu_clean_author_menu()
add_action('wp_dashboard_setup', 'zazu_clean_author_dashboard' );
add_action('admin_menu', 'zazu_clean_author_menu' );

//Disables the admin bar
add_filter( 'show_admin_bar', '__return_false' );

//Displays the welcome widget
function zazu_author_dashboard_welcome_widget() {
	?>
	<h2>Seja bem vindo, meu caro zazulista.</h2>
	<p>Ainda temos pouco a oferecer, mas sinta-se a vontade.</p>
	<p>Utilize o QuickPress para publicar conteudo rapidamente.</p>
	<?php 
}

// Adds widgets to the author dashboard
function zazu_add_author_dashboard_widgets() {
	wp_add_dashboard_widget('welcome_dashboard_widget', 'Bem vindo!', 'zazu_author_dashboard_welcome_widget');
}

// Hooking zazu_add_author_dashboard_widgets()
add_action('wp_dashboard_setup', 'zazu_add_author_dashboard_widgets' );

//Displays extra fields in the profile edit page
function show_extra_profile_fields( $user ) {
	?><table class="form-table">
			<tr>
			<th><label for="epiteto"><?php echo esc_attr("Epíteto"); ?></label></th>
				<td>
					<input type="text" name="epiteto" id="epiteto" value="<?php echo esc_attr(get_the_author_meta('epiteto', $user -> ID)); ?>" class="regular-text" /><br />
					<span class="description"><?php echo esc_attr("Escreva um breve título que constará no seu perfil ao lado do seu nome."); ?></span>
				</td>
			</tr>
	</table><?php
}

//Salva as informações dos campos extras no perfil do usuário
add_action( 'personal_options_update', 'save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_profile_fields' );
	
function save_extra_profile_fields( $user_id ) {

	if ( !current_user_can( 'edit_user', $user_id ) )
	return false;

	update_usermeta( $user_id, 'epiteto', $_POST['epiteto'] );
}

// Hooking the functions to display extra user profile fields
add_action( 'show_user_profile', 'show_extra_profile_fields' );
add_action( 'edit_user_profile', 'show_extra_profile_fields' );
?>