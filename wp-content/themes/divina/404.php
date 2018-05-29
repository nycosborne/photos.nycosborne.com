<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Divina
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<p class="page-404"><?php esc_html_e( '404', 'divina' ); ?></p>
					<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'divina' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'divina' ); ?></p>

					<?php get_search_form(); ?>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>
