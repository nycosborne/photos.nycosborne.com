<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package eightphoto
 */

    if( has_post_thumbnail() ) : ?>
    <?php
        
        $image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'eightphoto-grid-large');
        $img_src_full = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
    ?>
        <div class="ed-gallery  element-item">           
                <div class="ed-grid-img">
                    <img src="<?php echo esc_url($image[0]); ?>" alt="<?php the_title_attribute(); ?>">
                </div>
                
                <div class="ed-grid-hover"> 
                    <h6>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                        </a>                                                            
                    </h6>

                    <div class="gallery-open-link">
                        <a href="<?php echo esc_url($img_src_full[0]); ?>" rel="gallryLight"><i class="fa fa-eye"></i></a>
                        <a href="<?php the_permalink(); ?>"><i class="fa fa-link"></i></a>
                    </div>

                    <div class="ed-masonary-gallery-cat">
                        <?php the_category(', '); ?>
                    </div>

                </div>
        </div> 
    <?php
    endif; 