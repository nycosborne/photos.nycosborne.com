<?php
/**
 * The default template for displaying square content
 *
 * @package Divina
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<figure>
		<?php divina_post_thumbnail(); ?>
		
		<div class="figcaption">
	
			<header class="entry-header">
				<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
			</header>
	
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
	
			<footer class="entry-footer">
			
				<div class="divina-more">
					<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span> <?php esc_html_e( 'Read more...', 'divina' ); ?></a>
					<?php edit_post_link( esc_html__( 'Edit', 'divina' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .divina-more -->

				<?php $format = get_post_format(); ?>
				<?php if ( current_theme_supports( 'post-formats', $format ) ) : ?>
					<?php $formaticon = ''; ?>
					<?php if ( 'video' === $format ) { ?>
						<?php $formaticon = 'film'; ?>
					<?php } elseif ( 'gallery' === $format ) { ?>
						<?php $formaticon = 'picture'; ?>
					<?php } elseif ( 'audio' === $format ) { ?>
						<?php $formaticon = 'music'; ?>
					<?php } else { ?>
						<?php $formaticon = 'camera'; ?>
					<?php } ?>
					<div class="divina-format"><span class="glyphicon glyphicon-<?php echo esc_html( $formaticon ); ?>" aria-hidden="true"></span></div>
					<div class="divina-format-link">
						<a href="<?php echo esc_url( get_post_format_link( $format ) ); ?>"><span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span> <?php echo esc_html__( 'Other ', 'divina' ) . esc_html( $format ) . esc_html__( ' posts', 'divina' ); ?></a>
					</div><!-- .divina-format-link -->
				<?php endif; ?>

			</footer><!-- .entry-footer -->

			<?php if ( is_sticky() && is_home() && ! is_paged() ) { ?>
				<div class="divina-sticky"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span></div>
			<?php } ?>

		</div><!-- .figcaption -->
	
	</figure>
	
</article><!-- #post-## -->
