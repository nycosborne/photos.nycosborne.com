<?php
/**
 * eightphoto functions and definitions
 *
 * @package eightphoto
 */

if ( ! function_exists( 'eightphoto_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function eightphoto_setup() {

	if ( ! isset( $content_width ) ) $content_width = 900;
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on eightphoto, use a find and replace
	 * to change 'eightphoto' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'eightphoto', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'eightphoto-grid-medium', 600, 300, true);
	add_image_size( 'eightphoto-grid-large', 600, 600, true);
	// Our Services 
	add_image_size( 'eightphoto-our-services', 640, 790, true);
	// team 
	add_image_size('eightphoto-team-grid-image',640,1000,true);
	add_image_size( 'eightphoto-sly', 1280, 720, true);
	add_image_size( 'eightphoto-blog-section', 370, 250, true);
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'eightphoto' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'image'
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'eightphoto_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	add_theme_support( 'custom-logo' , array(
	 	'header-text' => array( 'site-title', 'site-description' ),
	 	));
	
	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif; // eightphoto_setup
add_action( 'after_setup_theme', 'eightphoto_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
if ( ! function_exists( 'eightphoto_content_width' ) ) :
	function eightphoto_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'eightphoto_content_width', 640 );
	}
	add_action( 'after_setup_theme', 'eightphoto_content_width', 0 );
endif;
/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
if ( ! function_exists( 'eightphoto_widgets_init' ) ) :
function eightphoto_widgets_init() {
    register_sidebar( 
		array(
			'name'          => esc_html__( 'Sidebar', 'eightphoto' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'eightphoto' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h4 class="widget-title"><span>',
			'after_title'   => '</span></h4>',
			) 
		);

    register_sidebar( array(
		'name'          => __( 'Right Sidebar Widget Area', 'eightphoto' ),
		'id'            => 'eightphoto-right-sidebar',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title"><span>',
		'after_title'   => '</span></h4>',
	) );

	register_sidebar( array(
		'name'          => __( 'Left Sidebar Widget Area', 'eightphoto' ),
		'id'            => 'eightphoto-left-sidebar',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title"><span>',
		'after_title'   => '</span></h4>',
	) );	

    register_sidebar( array(
		'name'          => __( 'Footer Widget Area One', 'eightphoto' ),
		'id'            => 'eightphoto_footer_one',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title"><span>',
		'after_title'   => '</span></h4>',
	) );
    register_sidebar( array(
		'name'          => __( 'Footer Widget Area Two', 'eightphoto' ),
		'id'            => 'eightphoto_footer_two',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title"><span>',
		'after_title'   => '</span></h4>',
	) );
    register_sidebar( array(
		'name'          => __( 'Footer Widget Area Three', 'eightphoto' ),
		'id'            => 'eightphoto_footer_three',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title"><span>',
		'after_title'   => '</span></h4>',
	) );
    register_sidebar( array(
		'name'          => __( 'Footer Widget Area Four', 'eightphoto' ),
		'id'            => 'eightphoto_footer_four',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title"><span>',
		'after_title'   => '</span></h4>',
	) );
    
}
add_action( 'widgets_init', 'eightphoto_widgets_init' );
endif;
/**
 * Enqueue scripts and styles.
 */
function eightphoto_scripts() {
	 /*****************************
	 * Use google fonts          **
	 ******************************/
	$query_args = array( 
	    'family' => 'Lato:300,400,700|Open+Sans:400,400italic,600,600italic,700,700italic,800,800italic|Yanone+Kaffeesatz:400,200,300,700|Playfair+Display|Unica+One|Pompiere'
	);
	wp_enqueue_style( 'eightphoto-google-fonts', add_query_arg( $query_args, "//fonts.googleapis.com/css" ) );
	
   	//Main Slider
	wp_enqueue_style('bxslider',get_template_directory_uri() . '/css/jquery.bxslider.css', true );
	wp_enqueue_style('animate',get_template_directory_uri() . '/css/animate.css', true );	
	//font-awesome
	wp_enqueue_style('font-awesome',get_template_directory_uri() . '/css/font-awesome.css',true );
	// Image Popup css
	wp_enqueue_style('prettyPhoto',get_template_directory_uri() . '/single/css/prettyPhoto.css');
	wp_enqueue_style('customscroll',get_template_directory_uri() . '/css/jquery.custom-scrollbar.css');
	wp_enqueue_style( 'eightphoto-style', get_stylesheet_uri() );
	wp_enqueue_style('eightphoto-responsive',get_template_directory_uri() . '/css/responsive.css', true );

	wp_enqueue_script('jquery-bxslider',get_template_directory_uri() . '/js/jquery.bxslider.js', array('jquery'), '1.3', true );
	wp_enqueue_script( 'jquery-isotope', get_template_directory_uri() . '/js/isotope.pkgd.js', array('jquery'), 'v2.2.2', true);	
	// Image Popup
	wp_enqueue_script( 'jquery-prettyPhoto', get_template_directory_uri() . '/single/js/jquery.prettyPhoto.js', array('jquery'), '20150705', true);	
    wp_enqueue_script( 'jquery-counterup', get_template_directory_uri() . '/js/counterup.js', array('jquery'), '20150706', true);

    wp_enqueue_script( 'jquery-waypoints', get_template_directory_uri() . '/js/waypoints.min.js', array('jquery'), '20150706', true);

    wp_enqueue_script( 'jquery-imagesloaded', get_template_directory_uri() . '/js/imagesloaded.js', array('jquery'), '20150706', true);    
	wp_enqueue_script('jquery-scrollbar', get_template_directory_uri() . '/js/jquery.custom-scrollbar.js', array('jquery'), '', true );

	wp_enqueue_script('eightphoto-custom', get_template_directory_uri() . '/js/custom.js', array('jquery'), '', true );
   
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

if(is_single())
{
// Folio View Script & Css
	wp_enqueue_style('lightGallerycss',get_template_directory_uri() . '/single/css/lightGallery.css');
    
// SLY Gallery
	global $post;
	$layouts = esc_attr(get_post_meta( $post->ID, 'eightphoto_gallery_layouts', true ));
 	if( $layouts == 'sly' && is_single()) {
		wp_enqueue_script( 'sly-min', get_template_directory_uri() . '/single/js/sly.js', array('jquery'), '20150703', true);	
	}
	wp_enqueue_script( 'jquery.easing', get_template_directory_uri() . '/single/js/jquery.easing.1.3.js', array('jquery'), '20150703', true);
// photoswipe
	wp_enqueue_style('photoswipe-css',get_template_directory_uri() . '/single/css/photoswipe.css');
	wp_enqueue_style('default-skin-css',get_template_directory_uri() . '/single/css/default-skin/default-skin.css');
	
	wp_enqueue_script( 'lightGallery-js', get_template_directory_uri() . '/single/js/lightGallery.js', array('jquery'));
// Photoswipe
	wp_enqueue_script( 'photoswipe-js', get_template_directory_uri() . '/single/js/photoswipe.js', array('jquery'), '20150731', true);
	wp_enqueue_script( 'photoswipe-ui-default-min-js', get_template_directory_uri() . '/single/js/photoswipe-ui-default.min.js', array('jquery'), '20150731', true);
	wp_enqueue_script( 'single-custom-js', get_template_directory_uri() . '/single/js/custom.js');
}

}
add_action( 'wp_enqueue_scripts', 'eightphoto_scripts' );


function eightphoto_sly_gallery_layout(){
	if(!is_404()){
		global $post;	
		$layouts = esc_attr(get_post_meta( $post->ID, 'eightphoto_gallery_layouts', true ));
	 	if( $layouts == 'sly' && is_single()) {
		?>
			<script type="text/javascript">

				jQuery(document).ready(function ($) {
				var $frame = jQuery('#ed-sly-gallery');
	    		var $wrap  = $frame.parent();
				var options = {
				    horizontal: 1,
					itemNav: 'centered',
					smart: 1,
					activateOn: 'click',
					activateMiddle: 1,
					mouseDragging: 1,
					touchDragging: 1,
					releaseSwing: 1,
					startAt: 0,
					scrollBar: $wrap.find('.scrollbar'),
					scrollBy: 0,
					speed: 3000,
					elasticBounds: 1,
					easing: 'easeOutExpo',
					dragHandle: 1,
					dynamicHandle: 1,
					clickBar: 1,
					keyboardNavBy: 0,
					prev: $frame.find('.prev'),
					next: $frame.find('.next')
					};

				if($('.frame').length > 0) {
					var frame = new Sly('.frame', options).init();
				}

				jQuery('html body').on('keydown', function(event){

				    if (event.which == 39) {
				      var list = jQuery('.frame ul li.active');
				      var position = jQuery('.frame ul li').index(list);
				      var length = jQuery('.frame ul li').length;
				      var next_position = position + 1;
				      if (next_position < length) {
				        var sel = '.frame ul li:eq('+ next_position +')';
				        jQuery(sel).click();
				      }
				    } else if (event.which == 37) {
				      var list = jQuery('.frame ul li.active');
				      var position = jQuery('.frame ul li').index(list);
				      var prev_position = position - 1;
				      if (prev_position > -1) {
				        var sel = '.frame ul li:eq('+ prev_position +')';
				        jQuery(sel).click();
				      }
				    }
				});

			    function getGalleryHeight(){

				    var headerHeight = jQuery('#masthead').outerHeight();
				    var windowHeight = jQuery(window).height();
				    var footerHeight = jQuery('.site-info').outerHeight();

				    var contentHeight = windowHeight - headerHeight - footerHeight - 137;

				    return contentHeight;
				}


		        function resize_frame(){
			    if(jQuery('.frame').length ){

			        var imagesParentWidth = 0;
			        var imageProportions = 0;

			        jQuery('.frame ul li').each(function(){
			          imagesParentWidth += parseInt(parentHeight*imageProportions, 10);

			          var imageDataHeight = jQuery(this).find('img').data('height');
			          var imageDataWidth = jQuery(this).find('img').data('width');
			          var parentHeight = getGalleryHeight();

			          imageProportions = imageDataWidth/imageDataHeight;

			          imageProportionsWidth = parseInt(parentHeight*imageProportions, 10);


			            jQuery(this).height(parentHeight);
			            jQuery(this).width(imageProportionsWidth);

			            jQuery(this).find('img').height(parentHeight);
			            jQuery(this).find('img').width(imageProportionsWidth);

			         
			        });

			        jQuery('.frame ul').width(imagesParentWidth);

			        frame.reload();
			        }
			}

	        jQuery(window).on('resize',function(){
			    jQuery('#ed-sly-gallery .frame').height( getGalleryHeight());
	            resize_frame();
	        }).resize();
							
			});
			</script>
		<?php
		}
	}
}
add_action('wp_footer','eightphoto_sly_gallery_layout');

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Implement Repeater Control
 */
require get_template_directory() . '/inc/class-repeater.php';


/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Implement the custom metabox feature
 */
require get_template_directory() . '/inc/eightphoto-functions.php';


/**
 * Implement the theme info
 */
require get_template_directory() . '/inc/about-theme.php';


 /**
 * @param string $code name of the shortcode
 * @param string $content
 * @return string content with shortcode striped
 */
function eightphoto_strip_shortcode($code, $content){
    global $shortcode_tags;
    $stack = $shortcode_tags;
    $shortcode_tags = array($code => 1);
    $content = strip_shortcodes($content);
    $shortcode_tags = $stack;
    return $content;
}
