<?php

	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		This post is password protected. Enter the password to view comments.
	<?php
		return;
	}
?>

<?php if ( have_comments() ) : ?>
	<div id="comments-wrapper" class="container content-list">
		<h2 id="comments"><?php comments_number('Nenhum comentário', 'Um comentário', '% comentários' );?></h2>
	
		<div class="navigation">
			<div class="next-posts"><?php previous_comments_link('Comentários mais antigos') ?></div>
			<div class="prev-posts"><?php next_comments_link('Comentários mais recentes') ?></div>
		</div>
	
		<ul class="commentlist eight columns">
			<?php wp_list_comments(array('style' => 'ul','type' => 'all')); ?>
		</ol>
	
		<div class="navigation">
			<div class="next-posts"><?php previous_comments_link('Comentários mais antigos') ?></div>
			<div class="prev-posts"><?php next_comments_link('Comentários mais recentes') ?></div>
		</div>
	</div>
 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<p>Comments are closed.</p>

	<?php endif; ?>
	
<?php endif; ?>

<?php if ( comments_open() ) : ?>

<div id="respond" class="eight columns">

	<h2><?php comment_form_title( 'Deixe um comentário', 'Deixe um comentário para %s' ); ?></h2>

	<div class="cancel-comment-reply">
		<?php cancel_comment_reply_link('Cancelar comentário'); ?>
	</div>

	<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
		<p><?php echo esc_attr('Você precisar estar '); ?><a href="<?php echo wp_login_url( get_permalink() ); ?>">logado</a> para comentar.</p>
	<?php else : ?>

	<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform" class="eight columns alpha omega">

		<?php if ( is_user_logged_in() ) : ?>

			<p>Logado como <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>.</p>

		<?php else : ?>

			<div>
				<input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
				<label for="author">Name <?php if ($req) echo "(required)"; ?></label>
			</div>

			<div>
				<input type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
				<label for="email">Mail (will not be published) <?php if ($req) echo "(required)"; ?></label>
			</div>

			<div>
				<input type="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="22" tabindex="3" />
				<label for="url">Website</label>
			</div>

		<?php endif; ?>

		<!--<p>You can use these tags: <code><?php echo allowed_tags(); ?></code></p>-->

		<div>
			<textarea name="comment" id="comment" tabindex="4" class="eight columns alpha omega"></textarea>
		</div>

		<div>
			<input name="submit" type="submit" id="submit" tabindex="5" value="Comentar" />
			<?php comment_id_fields(); ?>
		</div>
		
		<?php do_action('comment_form', $post->ID); ?>

	</form>

	<?php endif; // If registration required and not logged in ?>
	
</div>

<?php endif; ?>
