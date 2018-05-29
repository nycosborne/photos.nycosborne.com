<?php
/**
 * The template for displaying the footer
 *
 * @package Divina
 */

?>
	<footer id="colophon" class="site-footer" role="contentinfo">

		<div class="row">
				<?php get_sidebar(); ?>
				<?php get_sidebar( '2' ); ?>
		</div><!-- .row -->

		<div class="site-info">
			<a rel="nofollow" href="<?php echo esc_url( 'http://wp-themes.it/divina-theme/' ); ?>"><?php esc_html_e( 'Divina WordPress theme by Pasquale Bucci', 'divina' ); ?></a>
		</div><!-- .site-info -->
	</footer><!-- .site-footer -->

	</div><!-- .site-content -->

</div><!-- .site -->

<?php wp_footer(); ?>

</body>
</html>
