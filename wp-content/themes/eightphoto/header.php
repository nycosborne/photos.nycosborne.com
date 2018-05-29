<?php
/**
 * The header for our theme.
 *
 * @package eightphoto
 */

$search_option = get_theme_mod('eightphoto_header_settings_search_option','disable');
$header_social = get_theme_mod('eightphoto_social_setting_option_header','disable');
$web_layout = get_theme_mod('eightphoto_webpage_layout','fullwidth');
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>> 
    <header id="masthead" class="site-header">
           
        <div class="foto-container clear">
            <div class="header-logo">
                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                    <?php 
                    if ( function_exists( 'the_custom_logo' ) ) {

                        if ( has_custom_logo() ) : ?>
                            <div class="logo-image">                            
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                                    <?php the_custom_logo(); ?>
                                </a>                                
                            </div>
                        <?php endif; // End logo check.

                    }
                    ?>
                    <div class="site-branding">
                        <h1 class="site-title">
                            <?php bloginfo('name'); ?>
                        </h1>
                        <p class="site-description"><?php bloginfo('description'); ?></p>
                    </div><!-- .site-brandsing -->                                
                </a>                            
                <?php //endif; ?>
            </div>
          
                            
            <?php
            if($web_layout == 'fullwidth'):
            ?>
                <div class="wrap-social-nav">
            <?php
            endif;

                    if(($header_social == 'enable') || ($search_option == 'enable') ){
                    ?>                
                        <div class="search-social-icon">                           
                            <?php                 
                            if($search_option == 'enable'){
                            ?>
                                <div class="search">        
                                    <?php get_search_form();?>      
                                </div>
                            <?php 
                            }
                            ?>   
                            <?php                 
                            if($header_social == 'enable'){
                            ?>                
                                    <div class="header-social-media">
                                     <?php do_action('eightphoto_social'); ?>                   
                                    </div>
                            <?php 
                            }
                            ?>
                        </div>
                    <?php 
                    }
                    ?>    
                    <nav id="site-navigation" class="main-navigation clear">
                        <div class="ed-toggle-nav">
                            <span class="toggle-bar toggle-bar1"></span>
                            <span class="toggle-bar toggle-bar2"></span>
                            <span class="toggle-bar toggle-bar3"></span>
                        </div>
                        <?php wp_nav_menu(array('theme_location' => 'primary', 'menu_id' => 'primary-menu', 'container' => false, 'menu_class'=>'primary-nav-menu default-skin')); ?>
                    </nav><!-- #site-navigation --> 
            <?php 
            if($web_layout == 'fullwidth'):
            ?>
                </div><!--wrap-social-nav-->
            <?php 
            endif;
            ?>
        </div>

    </header><!-- #masthead -->   

    <div id="page" class="hfeed site <?php if (!(is_home() || is_front_page())) { echo $class = 'inner'; } ?>">
        <?php
            if (is_front_page() && !is_home()) :
                eightphoto_main_slider();
            endif;
        ?>
        <div id="content" class="site-content">