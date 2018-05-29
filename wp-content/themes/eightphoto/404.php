<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package eightphoto
 */
get_header();
?>

<header class="page-header">
    <h1 class="page-title">
        <?php esc_html_e('Oops! That page can&rsquo;t be found.', 'eightphoto'); ?>
    </h1>
    <?php eightphoto_breadcrumbs(); ?>
</header> 

<div class="foto-container clear">
    <div class="number404">
        <?php esc_html_e('404','eightphoto'); ?>
        <span><?php esc_html_e('error','eightphoto'); ?></span>   
    </div>
</div>

<?php get_footer(); 