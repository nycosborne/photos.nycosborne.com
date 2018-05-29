<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package eightphoto
 */
get_header();
?>

<header class="page-header">
    <h1 class="page-title"><?php single_cat_title( '', true ); ?></h1>
    <?php eightphoto_breadcrumbs(); ?>
</header>

<div class="foto-container">
    
    <div id="primary" class="content-area">
        
        <?php   if (have_posts()) : ?>
        <?php 
                $cat_team = get_theme_mod('eightphoto_team_archive_section_select','');
                $cat_testimonial = get_theme_mod('eightphoto_testimonial_archive_section_select','');
                $cat_blog = get_theme_mod('eightphoto_homepage_blog_cat','');
                $team_layout = get_theme_mod('eightphoto_team_archive_section_layout','list');
                $testimonial_layout = get_theme_mod('eightphoto_testimonial_archive_section_layout','list');
                $blog_layout = get_theme_mod('eightphoto_blog_page_archive_section','largeimagelistview');
                $archive_layout=get_theme_mod('eightphoto_archive_archive_section_layout','list');
                if(is_category($cat_team)){
                            $cat =  'team-'.$team_layout; 
                        }
                        elseif(is_category($cat_testimonial)){
                            $cat =  'testimonial-'.$testimonial_layout;
                        }
                        else if(is_category($cat_blog)){
                            $cat =  'blog-'.$blog_layout;
                        }                       
                        else{
                            $cat = 'archive-'.$archive_layout;
                        }
        ?>    
            <div class="<?php echo esc_attr($cat); ?> ">
            <?php /* Start the Loop */ ?>
            <?php while (have_posts()) : the_post(); ?>

                <?php
                    get_template_part('template-parts/content');
                ?>

            <?php endwhile;
                the_posts_navigation();            
            ?>
            </div>
        <?php else : ?>

            <?php get_template_part('template-parts/content', 'none'); ?>

        <?php endif; ?>
    </div><!-- #primary -->

   <?php 
   get_sidebar();
        ?>
</div>
<?php get_footer(); ?>