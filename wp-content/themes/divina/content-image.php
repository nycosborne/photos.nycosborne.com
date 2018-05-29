<?php
/**
 * The default template for displaying post format image content
 *
 * @package Divina
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<div class="divina-divider"><a href="<?php echo esc_url( get_post_format_link( 'image' ) ); ?>"><span class="divina-post-format glyphicon glyphicon-camera" aria-hidden="true"></span></a></div>
	</header><!-- .entry-header -->
	
	<div class="entry-content">
		<?php
			/* translators: %s: Name of current post */
			the_content( sprintf(
				esc_html__( 'Continue reading %s', 'divina' ),
				the_title( '<span class="screen-reader-text">', '</span>', false )
			) );

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'divina' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'divina' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php divina_entry_meta(); ?>
		<?php edit_post_link( esc_html__( 'Edit', 'divina' ), '<span class="edit-link">', '</span>' ); ?>
		<?php
		// Author bio.
		if ( is_single() && get_the_author_meta( 'description' ) ) :
			get_template_part( 'author-bio' );
		endif;
		?>
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
