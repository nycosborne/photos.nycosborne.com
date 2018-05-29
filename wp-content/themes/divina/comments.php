<?php
/**
 * The template for displaying comments
 *
 * @package Divina
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( // WPCS: XSS OK.
				esc_html( _nx( 'One comment', '%1$s comments', get_comments_number(), 'comments title', 'divina' ) ), number_format_i18n( get_comments_number() ), get_the_title() );
			?>
		</h2>

		<?php divina_comment_nav(); ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 60,
				) );
			?>
		</ol><!-- .comment-list -->

		<?php divina_comment_nav(); ?>

	<?php endif; // Have Comments. ?>

	<?php
	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'divina' ); ?></p>
	<?php endif; ?>

	<?php $comments_args = array(
		'comment_field' => '<div class="row"><div class="comment-form-comment col-md-12"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="' . esc_attr__( 'Write your comment here...', 'divina' ) . '"></textarea></div></div>',
	); ?>
	
	<?php comment_form( $comments_args ); ?>
	
</div><!-- .comments-area -->
