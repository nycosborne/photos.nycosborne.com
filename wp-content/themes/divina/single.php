<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package Divina
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			/*
			 * Include the post format-specific template for the content. If you want to
			 * use this in a child theme, then include a file called called content-___.php
			 * (where ___ is the post format) and that will be used instead.
			 */
			get_template_part( 'content', get_post_format() );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

			// Previous/next post navigation.
			echo '<div class="row">';
			the_post_navigation( array(
				'prev_text' => '<div class="col-xs-6"><div class="divina-post-nav"><img class="post-nav-img-prev" src="' . divina_post_nav_image( 'prev' ) . '"  alt="%title"><h3 class="meta-nav" aria-hidden="true">' . esc_html__( 'Previous', 'divina' ) . '</h3><span class="screen-reader-text">' . esc_html__( 'Previous post:', 'divina' ) . '</span><span class="post-title">%title</span></div></div>',
				'next_text' => '<div class="col-xs-6"><div class="divina-post-nav"><img class="post-nav-img-next" src="' . divina_post_nav_image( 'next' ) . '" alt="%title"><h3 class="meta-nav" aria-hidden="true">' . esc_html__( 'Next', 'divina' ) . '</h3><span class="screen-reader-text">' . esc_html__( 'Next post:', 'divina' ) . '</span><span class="post-title">%title</span></div></div>',
			) );
			echo '</div>';

			// End the loop.
		endwhile;
		?>

		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>
