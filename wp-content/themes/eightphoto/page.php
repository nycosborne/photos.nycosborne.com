<?php
/**
 * The template for displaying all pages.
 *
 * @package eightphoto
 */
get_header();

do_action('eightphoto_title'); 
?>

<div class="foto-container clear">
        <div id="primary" class="content-area">
        
        <?php while (have_posts()) : the_post(); ?>

            <?php get_template_part('template-parts/content', 'page'); ?>                    

        <?php endwhile; // End of the loop. ?>

        </div>    

        <?php get_sidebar(); ?>       
</div>
<?php get_footer(); 