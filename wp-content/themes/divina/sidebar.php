<?php
/**
 * The sidebar containing the main widget area
 *
 * @package Divina
 */

if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
	<div id="secondary" class="secondary col-md-6">
		<div id="widget-area" class="widget-area" role="complementary">
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</div><!-- .widget-area -->
	</div><!-- .secondary -->
<?php endif; ?>
