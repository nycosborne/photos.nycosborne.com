<?php
/**
 * Template part for displaying posts.
 *
 * @package eightphoto
 */
$cat_team = get_theme_mod('eightphoto_team_archive_section_select');
$cat_testimonial = get_theme_mod('eightphoto_testimonial_archive_section_select');
$cat_blog = get_theme_mod('eightphoto_homepage_blog_cat');
if(!empty($cat_blog) && is_category() && is_category($cat_blog)): 
    $blog_layout = esc_attr(get_theme_mod('eightphoto_blog_page_archive_section','largeimagelistview'));
    if( has_post_thumbnail() ) {
        if(!empty($blog_layout) && $blog_layout == 'alternateimagelistview'){
          $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'eightphoto-grid-large', true); 
        }else{
            $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'eightphoto-sly', true);
    }
    }
    $blog_author = esc_attr(get_theme_mod('eightphoto_blog_author_archive_section','yes'));
    $blog_postdate = esc_attr(get_theme_mod('eightphoto_blog_postdate_archive_section','yes'));
    $blog_meta_cat = esc_attr(get_theme_mod('eightphoto_blog_metacategory_archive_section','yes'));
    ?>
    <div class="blog-post-wrap clear">
        <?php if( has_post_thumbnail() ) :?>
        <div class="ed-blog-list-thumb"> 
            <img src="<?php echo esc_url($image[0]); ?>" alt="<?php the_title_attribute();?>" title="<?php the_title();?>">                 
        </div> 
        <?php endif;?>
        <div class="ed-blog-list-detail">
            <h5>
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>                                                      
            </h5>                  
            <div class="entry-meta">                              
                <?php if ($blog_author == 'yes') : ?>
                    <span><i class="fa fa-user"></i> <?php the_author(); ?></span>
                <?php endif; ?>
                <?php if ($blog_postdate == 'yes') : ?>
                    <span><i class="fa fa-clock-o"></i><?php the_time(get_option('date_format')); ?></span>
                <?php endif; ?> 
                <?php if ($blog_meta_cat == 'yes') : ?>
                    <span><i class="fa fa-folder-open"></i> <?php the_category(','); ?></span>
                <?php endif; ?>               
            </div>

            <div class="ed-blog-list-excerpt">
                <?php echo eightphoto_word_count(get_the_excerpt(), 250); ?>
                <div class="bttn-wrap">
                    <a class="bttn" href="<?php the_permalink(); ?>"><?php _e('Read More','eightphoto'); ?></a>
                </div>
            </div>   
        </div>
    </div> 
<?php

elseif(!empty($cat_team) && is_category() && is_category($cat_team)): 
    $team_layout = get_theme_mod('eightphoto_team_archive_section_layout','grid');
    switch ( $team_layout ) {
        case 'list':
            $image_size = 'eightphoto-grid-large';
            break;
        
        default:
            $image_size = 'eightphoto-team-grid-image';
            break;
    }
    $image_id = get_post_thumbnail_id();
    $image_path = wp_get_attachment_image_src( $image_id, $image_size, true );
?>
    
<div class="ed-team-list-wrap">
<?php if( has_post_thumbnail() ) { ?>
    <div class="ed-team-list-thumb">
        <a href="<?php the_permalink(); ?>">
            <img src="<?php echo esc_url( $image_path[0] );?>" alt="<?php the_title(); ?>" />
        </a>
    </div>
<?php } ?>

    <div class="ed-team-list-detail">
        <h5>
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>                                                      
        </h5>     
        <div class="ed-team-list-excerpt">
            <?php the_excerpt(); ?>
        </div>   
    </div> 
</div> 
    
<?php
elseif(!empty($cat_testimonial) && is_category() && is_category($cat_testimonial)): 
    $testimonial_layout = get_theme_mod('eightphoto_testimonial_archive_section_layout','list');
    if( has_post_thumbnail() ) {
        $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'eightphoto-testimonial-image', true); 
    }else{
        $image[0] = '';
    }
?>
    <div class="ed-testimonial-list-wrap">
        <div class="ed-testimonial-list-thumb">
            <a href="<?php the_permalink(); ?>">
                <img src="<?php echo esc_url($image[0]); ?>" alt="<?php the_title_attribute(); ?>" />
            </a>
        </div>   
        <div class="ed-testimonial-list-detail">
            <h5>
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>                                    
            </h5>     
            <div class="ed-testimonial-list-excerpt">
                <?php the_excerpt(); ?>                
            </div>   
        </div>
    </div>  

<?php
elseif(is_archive()): 
    $archive_layout = get_theme_mod('eightphoto_archive_archive_section_layout','list');
    if( has_post_thumbnail() ) {
      $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'eightphoto-grid-large', true); 
    }

?>
    <div class="ed-archive-list-wrap">
        <div class="ed-archive-list-thumb">
        <?php
        if( has_post_thumbnail() ) {
            ?>
            <a href="<?php the_permalink(); ?>">
                <img src="<?php echo esc_url($image[0]); ?>" alt="<?php the_title_attribute(); ?>" />
            </a>
            <?php
        }
        ?>
        </div>   
        <div class="ed-archive-list-detail">
            <h5>
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>                                    
            </h5>     
            <div class="ed-archive-list-excerpt">
                <?php echo eightphoto_word_count(get_the_excerpt(), 250); ?>
                <div class="bttn-wrap">
                    <a class="bttn" href="<?php the_permalink(); ?>"><?php _e('Read More','eightphoto'); ?></a>
                </div>
            </div>   
        </div>
    </div>  
<?php
else:
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php
                the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
            

        if ( 'post' === get_post_type() ) : ?>
        <div class="entry-meta">
            <?php eightphoto_posted_on(); ?>
        </div><!-- .entry-meta -->
        <?php
        endif; ?>
    </header><!-- .entry-header -->

    <div class="entry-content">
        <?php
            the_content( sprintf(
                /* translators: %s: Name of current post. */
                wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'eightphoto' ), array( 'span' => array( 'class' => array() ) ) ),
                the_title( '<span class="screen-reader-text">"', '"</span>', false )
            ) );

            wp_link_pages( array(
                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'eightphoto' ),
                'after'  => '</div>',
            ) );
        ?>
    </div><!-- .entry-content -->

    <footer class="entry-footer">
        <?php eightphoto_entry_footer(); ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-## -->

<?php
endif;
?>