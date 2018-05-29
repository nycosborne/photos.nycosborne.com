<?php
/**
 * The main template file
 *
 * @package Divina
 */
get_header();
 ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php if ( have_posts() ) : ?>

				<div class="grid">

					<?php

					// Start the loop.
					while ( have_posts() ) : the_post(); ?>
						<div class="col-sm-6 col-lg-4">
      						<?php
									get_template_part( 'content', 'square' );
									?>
    					</div>
					<?php
					// End the loop.
					endwhile; ?>

				</div><!-- .grid -->

				<?php
				the_posts_pagination( array( 'mid_size' => 2, 'prev_text' => '<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>', 'next_text' => '<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>' ) );

				// If no content, include the "No posts found" template.
			else :
				get_template_part( 'content', 'none' );
			endif;
			?>

		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php

get_footer();
?>
