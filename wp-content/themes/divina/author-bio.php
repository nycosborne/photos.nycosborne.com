<?php
/**
 * The template for displaying Author bios
 *
 * @package Divina
 */

?>

<div class="author-info">
	
	<div class="author-avatar">
		<?php echo get_avatar( get_the_author_meta( 'user_email' ), 90 ); ?>
	</div><!-- .author-avatar -->

	<div class="author-description">
		<h3 class="author-title"><a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?php echo get_the_author(); ?></a></h3>

		<p class="author-bio">
			<?php the_author_meta( 'description' ); ?>
		</p><!-- .author-bio -->

	</div><!-- .author-description -->
</div><!-- .author-info -->
