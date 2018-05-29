<?php
/**
 * Template part for displaying single posts.
 *
 * @package eightphoto
 */
?>
<?php
    $post_id = get_the_ID();
    $post_format = get_post_format($post_id);
    $post_sidebar = esc_attr(get_post_meta($post->ID, 'eightphoto_page_layouts', true));
?>

<?php if ($post_format == 'image') : ?>
    <div class="image-gallery-format clear">
        <?php get_template_part('template-parts/gallery', 'single'); ?>
    </div>

<?php else : ?>
                               
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>> 
        <div class="entry-image"> 
            <?php        
                if( has_post_thumbnail() ) : 
                    the_post_thumbnail();
                endif;
            ?>
        </div>
        <div class="entry-meta">
            <span><i class="fa fa-user"></i> <?php the_author(); ?></span>
            <span><i class="fa fa-clock-o"></i> <?php the_time(get_option('date_format')); ?></span>
            <span><i class="fa fa-folder-open"></i> <?php the_category(', ') ?></span>
        </div><!-- .entry-meta -->

        <div class="entry-content">         
            <?php
                the_content();
                wp_link_pages(array(
                    'before' => '<div class="page-links">' . esc_html__('Pages:', 'eightphoto'),
                    'after' => '</div>',
                ));
            ?>
        </div><!-- .entry-content --> 
    </article><!-- #post-## -->
<?php endif; ?>

