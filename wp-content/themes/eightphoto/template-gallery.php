<?php
/**
 * Template Name: Gallery Layout
 *
 * @package eightphoto
 */
get_header();

$gallery_layout = esc_attr(get_theme_mod('eightphoto_gallery_page_section','gridview'));
$gallery_author = esc_attr(get_theme_mod('eightphoto_gallery_author_section','yes'));
$gallery_postdate = esc_attr(get_theme_mod('eightphoto_gallery_postdate_section','yes'));
$gallery_meta_cat = esc_attr(get_theme_mod('eightphoto_gallery_meta_category_section','yes'));
$limit = esc_attr(get_theme_mod('eightphoto_gallelry_desc_section',50));
$cageory_id = esc_attr(get_theme_mod('eightphoto_cstmzr_categories_gallery'));
?>

<?php do_action('eightphoto_title'); ?>

<div class="foto-container">    

        
        <?php
        if (!empty($gallery_layout) && $gallery_layout == 'gridview') {
            $gallery_layout_class = 'ed-grid-view';
        } else if (!empty($gallery_layout) && $gallery_layout == 'sortable') {
            $gallery_layout_class = 'ed-sortable-grid';
        } else if (!empty($gallery_layout) && $gallery_layout == 'mediumthumbslistview') {
            $gallery_layout_class = 'ed-thumb-list-view';
        } else if (!empty($gallery_layout) && $gallery_layout == 'largethumbslistview') {
            $gallery_layout_class = 'ed-large-thumbs-list-view';
        } else {
            $gallery_layout_class = 'ed-large-thumbs-list-view';
        }
        ?>

        <?php if ($gallery_layout == 'largethumbslistview') { ?>
            <div id="primary" class="content-area">
            <?php } else{ ?>

                <div class="full-content-area">
                <?php 
                } 
                if($cageory_id != 0){
                ?>

                    <?php 
                    
                        if (!empty($gallery_layout) && $gallery_layout == 'sortable') : ?>
                        <header class="sort-table"> 
                            <?php
                            $categories = explode(',', $cageory_id);

                            if (!empty($categories) && !is_wp_error($categories)):
                                echo "<ul class='button-group filters-button-group'>";
                                if (!empty($categories)) {
                                    echo '<li class="button is-checked" data-filter="*">' . __('All', 'eightphoto') . '</li>';
                                }
                                foreach ($categories as $category) :
                                    $cat_detail = get_category($category);
                                    echo '<li class="button" data-filter=.' . esc_attr($cat_detail->slug) . '>' . $cat_detail->name . '</li>';
                                endforeach;
                                echo "</ul>";
                            endif;
                            wp_reset_postdata();
                            ?>
                        </header>
                    <?php endif; ?>

                    <section class="<?php echo esc_attr($gallery_layout_class); ?> clear">
                            <?php                            
                                 $post_category = explode(',', $cageory_id);
                                 $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
                                 $args = array('post_type' => 'post', 'paged' => $paged, 'posts_per_page'=>12,
                                     'tax_query' => array(
                                         array(
                                             'taxonomy' => 'category',
                                             'field' => 'id',
                                             'terms' => $post_category
                                         )
                                     )
                                 );

                                 $query = new WP_Query($args);//print_r($query);die();
                                 if ($query->have_posts()): while ($query->have_posts()) : $query->the_post();
                                         $term_lists = wp_get_post_terms($post->ID, 'category', array("fields" => "all"));
                                         $term_slugs = array();
                                         foreach ($term_lists as $term_list) {
                                             $term_slugs[] = $term_list->slug;
                                         }
                                         $term_slugs = join(' ', $term_slugs);
                                         ?>               
                                <div class="ed-gallery <?php if (!empty($gallery_layout) && $gallery_layout == 'sortable') { echo 'element-item '; echo esc_attr($term_slugs); } ?>">                

                                    <?php
                                    if (has_post_thumbnail()) :
                                        if ($gallery_layout == 'gridview' || $gallery_layout == 'sortable') {
                                            $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'eightphoto-grid-large', true);
                                        }
                                        if ($gallery_layout == 'largethumbslistview') {
                                            $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'eightphoto-sly', true);
                                        }

                                        if ($gallery_layout == 'mediumthumbslistview') {
                                            $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'eightphoto-grid-medium', true);
                                        }
                                    endif;
                                    $full_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', true);
                                    ?>
                                    <?php if ($gallery_layout == 'gridview' || $gallery_layout == 'sortable') { ?>
                                        <div class="ed-grid-img">
                                            <a href="<?php the_permalink(); ?>">
                                            <?php if(!empty($image[0])) : ?>
                                                <img src="<?php echo esc_url($image[0]); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                                            <?php else : $slides_noimage = get_template_directory_uri().'/images/noimage1.jpg'; ?>
                                                <img src="<?php echo esc_url($slides_noimage); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                                            <?php endif; ?>
                                            </a>
                                        </div>

                                        <div class="ed-grid-hover">
                                            <h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>

                                            <div class="gallery-open-link">
                                                <a href="<?php echo esc_url($full_image[0]); ?>" rel="gallryLight"><i class="fa fa-eye"></i></a>
                                               <a href="<?php the_permalink(); ?>"><i class="fa fa-link"></i></a>
                                            </div>

                                            <div class="ed-masonary-gallery-cat">
                                                <?php if ($gallery_author == 'yes') : ?>
                                                    <span><i class="fa fa-user"></i> <?php the_author(); ?></span>
                                                <?php endif; ?>
                                                <?php if ($gallery_postdate == 'yes') : ?>
                                                    <span><i class="fa fa-clock-o"></i> <?php the_time(get_option('date_format')); ?></span>
                                                <?php endif; ?> 
                                                <?php if ($gallery_meta_cat == 'yes') : ?>
                                                    <span><i class="fa fa-folder-open"></i> <?php the_category(','); ?></span>
                                                <?php endif; ?>               
                                            </div>

                                        </div>
                                    <?php } ?>

                                    <!-- Mid Thumbinal view -->
                                    <?php if ($gallery_layout == 'mediumthumbslistview' || $gallery_layout == 'largethumbslistview') { ?>
                                        <div class="clear">        
                                        <div class="ed-gallery-list-thumb" style="background-image: url(<?php echo esc_url($image[0]); ?>) ">                  
                                        </div>      
                 
                                        <div class="ed-gallery-list-detail">
                                            <h5>
                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>                                                      
                                            </h5>                  
                                            <div class="entry-meta">                              
                                                <?php if ($gallery_author == 'yes') : ?>
                                                    <span><i class="fa fa-user"></i> <?php the_author(); ?></span>
                                                <?php endif; ?>
                                                <?php if ($gallery_postdate == 'yes') : ?>
                                                    <span><i class="fa fa-clock-o"></i><?php the_time(get_option('date_format')); ?></span>
                                                <?php endif; ?> 
                                                <?php if ($gallery_meta_cat == 'yes') : ?>
                                                    <span><i class="fa fa-folder-open"></i> <?php the_category(','); ?></span>
                                                <?php endif; ?>               
                                            </div>

                                            <div class="ed-gallery-list-excerpt">
                                                <?php echo eightphoto_word_count(get_the_excerpt(), esc_attr($limit)); ?>
                                                <div class="bttn-wrap">
                                                <a class="bttn" href="<?php the_permalink(); ?>"><?php _e('Read More','eightphoto'); ?></a></div>
                                            </div>
                                        </div>    
                                        </div>                                
                                    <?php } ?>

                                </div>
                                <?php
                            endwhile;
                            if ( $gallery_layout == 'gridview' || $gallery_layout == 'mediumthumbslistview' || $gallery_layout == 'largethumbslistview') {
                                ?>
                                <nav class="navigation posts-navigation" role="navigation">
                                    <h2 class="screen-reader-text">Posts navigation</h2>
                                    <div class="nav-links"><div class="nav-previous"><?php next_posts_link('Older Posts', $query->max_num_pages ); ?></div></div>
                                    <div class="nav-links"><div class="nav-next"><?php previous_posts_link('Newer Posts', $query->max_num_pages ); ?></div></div>
                                </nav>
                                <?php
                            }  
                        endif;
                        wp_reset_postdata();
                        ?>
                    </section>
                
                <?php 
                     
                }
                ?>
                </div>
            </div>        


</div>

<?php get_footer(); 