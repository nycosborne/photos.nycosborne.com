<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package eightphoto
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
   <?php        
        if( has_post_thumbnail() ) : 
            the_post_thumbnail();
        endif;
    ?>
    <div class="entry-content">
        <?php the_content(); ?>
        <?php
            wp_link_pages(array(
                'before' => '<div class="page-links">' . esc_html__('Pages:', 'eightphoto'),
                'after' => '</div>',
            ));
        ?>
    </div><!-- .entry-content -->

    <footer class="entry-footer">
        <?php edit_post_link(esc_html__('Edit', 'eightphoto'), '<span class="edit-link">', '</span>'); ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-## -->

