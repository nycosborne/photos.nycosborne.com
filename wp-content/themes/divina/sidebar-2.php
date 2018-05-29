<?php
/**
 * The sidebar containing the main widget area
 *
 * @package Divina
 */

if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
	<div id="tertiary" class="tertiary col-md-6">
		<div id="widget-area2" class="widget-area" role="complementary">
			<?php dynamic_sidebar( 'sidebar-2' ); ?>
		</div><!-- .widget-area -->
	</div><!-- .secondary -->
<?php endif; ?>
