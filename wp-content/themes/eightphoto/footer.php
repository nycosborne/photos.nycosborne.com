<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package eightphoto
 */

$footer_social= get_theme_mod('eightphoto_social_setting_option_footer','disable');
?>
</div><!-- #content -->

<footer id="colophon" class="site-footer">
    <?php
    if ( is_active_sidebar( 'eightphoto_footer_one' ) ||  is_active_sidebar( 'eightphoto_footer_two' )  || is_active_sidebar( 'eightphoto_footer_three' )  || is_active_sidebar( 'eightphoto_footer_four' )) : ?>
        <div class="top-footer">
            <div class="foto-container">
                <div class="footer-wrap clear">
                    <div class="footer-block">
                    <?php dynamic_sidebar('eightphoto_footer_one'); ?>
                    </div>

                    <div class="footer-block">
                    <?php dynamic_sidebar('eightphoto_footer_two'); ?>
                    </div>

                    <div class="footer-block">
                    <?php dynamic_sidebar('eightphoto_footer_three'); ?>
                    </div>

                    <div class="footer-block">
                    <?php dynamic_sidebar('eightphoto_footer_four'); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php
    endif;
    ?>
        
    
    <div class="site-info">
        <div class="foto-container">
            <div class="copyright">
                <?php
                $copyright = get_theme_mod('eightphoto_copyright','');
                if($copyright && $copyright!=""){
                    echo wp_kses_post($copyright)." ";
                }?>
                <?php _e( 'WordPress Theme : ', 'eightphoto' );  ?><a  title="<?php echo __('Free WordPress Theme','eightphoto');?>" href="<?php echo esc_url( __( 'https://8degreethemes.com/wordpress-themes/eightphoto/', 'eightphoto' ) ); ?>"><?php _e( 'Eightphoto', 'eightphoto' ); ?> </a>
                <span><?php echo __(' by 8Degree Themes','eightphoto');?></span>
              
            </div>

            <?php                 
                if($footer_social == 'enable'){
                    ?>                
                            <div class="footer-social-media">
                             <?php do_action('eightphoto_social'); ?>                   
                            </div>
                    <?php 
                    }
            ?>
        </div>
    </div><!-- .site-info -->
</footer><!-- #colophon -->

<!-- Go To Top Button here -->
<a href="#" id="back-to-top" title="<?php _e('Back to top','eightphoto');?>">&uarr;</a>

<?php if(is_single()) : ?>
<!-- photoswipe gallery popup div section -->
 <div id="gallery" class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="pswp__bg"></div>
    <div class="pswp__scroll-wrap">

      <div class="pswp__container">
        <div class="pswp__item"></div>
        <div class="pswp__item"></div>
        <div class="pswp__item"></div>
      </div>

      <div class="pswp__ui pswp__ui--hidden">

        <div class="pswp__top-bar">

            <div class="pswp__counter"></div>

            <button class="pswp__button pswp__button--close" title="<?php _e('Close (Esc)','eightphoto')?>"></button>

            <button class="pswp__button pswp__button--share" title="<?php _e('Share','eightphoto')?>"></button>

            <button class="pswp__button pswp__button--fs" title="<?php _e('Toggle fullscreen','eightphoto')?>"></button>

            <button class="pswp__button pswp__button--zoom" title="<?php _e('Zoom in/out','eightphoto')?>"></button>

            <div class="pswp__preloader">
                <div class="pswp__preloader__icn">
                  <div class="pswp__preloader__cut">
                    <div class="pswp__preloader__donut"></div>
                  </div>
                </div>
            </div>
        </div>

        <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
            <div class="pswp__share-tooltip">
            </div>
        </div>

        <button class="pswp__button pswp__button--arrow--left" title="<?php _e('Previous (arrow left)','eightphoto')?>"></button>
        <button class="pswp__button pswp__button--arrow--right" title="<?php _e('Next (arrow right)','eightphoto')?>"></button>
        <div class="pswp__caption">
          <div class="pswp__caption__center">
          </div>
        </div>
      </div>
    </div>
</div>
<?php endif; ?>
</div><!-- #page -->
<?php 
    wp_footer();
    
?>
</body>
</html>