<?php
/**
 * Template Name: Home Page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package eightphoto
 */
get_header();
?>
<?php
$post_cat = esc_attr(get_theme_mod('eightphoto_cstmzr_categories'));
$category_all = __('All', 'eightphoto');
$call_action = esc_attr(get_theme_mod('eightphoto_homepage_call_action_option'));
$portfolio = esc_attr(get_theme_mod('eightphoto_homepage_our_portfolio_option'));
$show_about=get_theme_mod('eightphoto_homepage_about_page','0');
$show_gallery=get_theme_mod('eightphoto_cstmzr_categories','0');
$show_blog=get_theme_mod('eightphoto_homepage_blog_cat','0');
$show_services_one=get_theme_mod('eightphoto_homepage_services_page_one','0');
$show_services_two=get_theme_mod('eightphoto_homepage_services_page_two','0');
$show_services_three=get_theme_mod('eightphoto_homepage_services_page_three','0');
?>
<div id="inner-content" class="wrap clear">
    <div id="main" class="twelvecol first clear" role="main">

        <?php if (esc_attr(get_theme_mod('eightphoto_homepage_about_option','disable')) == 'enable') { 
                if($show_about!= 0){
        ?>
                    <section class="ed_aboutus">
                        <div class="foto-container clear">
                            <?php                                
                                    eightphoto_aboutus();                                 
                            ?>
                        </div>
                    </section>
        <?php 
                }
        } ?>
        <?php 
            if (esc_attr(get_theme_mod('eightphoto_homepage_our_service_option','disable')) == 'enable') { 
                if(($show_services_one != 'disable') && ($show_services_two != 'disable') && ($show_services_three != 'disable')){
        ?>
                <section class="ed_service_section">
                    <?php eightphoto_our_services(); ?>
                </section>
        <?php
                }
            } 
        ?>
        <?php
             $count_section = get_theme_mod('eightphoto_homepage_about_count_option','disable');
            if(!empty($count_section) && $count_section == 'enable') {
        ?>
                <section class="counter-section">
                    <div class="foto-container">
                        <?php eightphoto_counter(); ?>
                    </div>
                </section>
        <?php } ?>
        <?php 
            $gallery_section = get_theme_mod('eightphoto_homepage_gallery_option','disable');
            if(!empty($gallery_section) && $gallery_section == 'enable') {
                if($show_gallery!= 0){
        ?>
            <section class="ed_gallery_section">
                <div class="section-title">
                    <span><?php echo esc_attr(get_theme_mod('eightphoto_homepage_gallery_main_title',__('Gallery','eightphoto'))); ?></span>   
                </div>

                <div id="ed_gallery_wrap">
                            <div id="ed-grid-gallery-view">          
                                <?php
                                $post_category = explode(',', $post_cat);
                                $args = array('post_type' => 'post', 'posts_per_page' => 8,
                                    'tax_query' => array(
                                        array(
                                            'taxonomy' => 'category',
                                            'field' => 'id',
                                            'terms' => $post_category
                                        )
                                    )
                                );
                                $query = new WP_Query($args);
                                if ($query->have_posts()): while ($query->have_posts()) : $query->the_post();
                                
                                    $img_src_full = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', true);
                                        
                                        $term_lists = wp_get_post_terms($post->ID, 'category', array("fields" => "all"));
                                        $term_slugs = array();
                                        foreach ($term_lists as $term_list) {
                                            $term_slugs[] = $term_list->slug;
                                        }
                                        $term_slugs = join(' ', $term_slugs);
                                        ?>               
                                        <div class="<?php echo esc_attr($term_slugs); ?>">
                                            <?php             
                                                $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'eightphoto-grid-large', true);
                                            ?>                               
                                            <div class="ed-gallery-hover">
                                                <div class="gallery-img">
                                                    <img src="<?php echo esc_url($image[0]); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
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
                                        </div>
                                        <?php
                                    endwhile;
                                endif;
                                wp_reset_postdata();
                                ?>
                            </div>

                </div>
            </section>
        <?php 
                }
            }
        ?>
        <?php 
            if (esc_attr(get_theme_mod('eightphoto_homepage_call_action_option','disable')) == 'enable') : 
        ?>            
                    <section class="home_caltoaction">
                        <?php eightphoto_call_to_action() ?>
                    </section>
        <?php 
            endif; 
        ?>
        <?php   
            if (esc_attr(get_theme_mod('eightphoto_homepage_blogs_option','disable')) == 'enable') {
                if($show_blog != '0'){

        ?>
                    <section class="ed-blog-section">
                        <div class="foto-container">
                            <?php eightphoto_homeblogs(); ?>
                        </div>
                    </section>
        <?php 
                }
            } 
        ?>  

        <?php if (esc_attr(get_theme_mod('eightphoto_homepage_quick_contact_info','disable')) == 'enable') : ?>
                <section class="quick_contact_section">
                    <div class="foto-container clear">
                        <?php eightphoto_quick_contact(); ?>
                    </div>
                </section>
        <?php endif; ?>

<?php get_footer();