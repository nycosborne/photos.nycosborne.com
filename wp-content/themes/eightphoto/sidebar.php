<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package eightphoto
 */
if(!empty($post)){
	$post_sidebar = esc_attr(get_post_meta($post->ID, 'eightphoto_page_layouts', true));
}
else
	$post_sidebar = 'rightsidebar';

if(!$post_sidebar){
	$post_sidebar = 'rightsidebar';
}
if(is_archive()  ){
    $post_sidebar = get_theme_mod( 'eightphoto_archive_page_layout', 'rightsidebar');
        if(!$post_sidebar){
            $post_sidebar = 'rightsidebar';
    }
}
if ( $post_sidebar ==  'nosidebar' ) {
	return;
}


if( $post_sidebar == 'rightsidebar' && is_active_sidebar('eightphoto-right-sidebar')){
	?>
		<div id="secondary" class="widget-area rightsidebar">
			<?php dynamic_sidebar( 'eightphoto-right-sidebar' ); ?>
		</div><!-- #secondary -->
	<?php
}

if( $post_sidebar == 'leftsidebar' && is_active_sidebar('eightphoto-left-sidebar')){
	?>
		<div id="secondary" class="widget-area leftsidebar">
			<?php dynamic_sidebar( 'eightphoto-left-sidebar' ); ?>
		</div><!-- #secondary -->
	<?php
}
if(is_home() && !is_page_template() ){	
?>		
	<div id="secondary" class="widget-area " role="complementary">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div><!-- #secondary -->    
<?php
}