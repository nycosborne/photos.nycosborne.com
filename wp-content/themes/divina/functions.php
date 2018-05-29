<?php
/**
 * Divina functions and definitions
 *
 * @package Divina
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1150;
}

if ( ! function_exists( 'divina_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 */
	function divina_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 */
		load_theme_textdomain( 'divina', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
	 	* Let WordPress manage the document title.
	 	*/
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1150, 540, true );
		add_image_size( 'divina-square', 400, 400, true );
		add_image_size( 'divina-rect', 560, 230, array( 'center', 'top' ) );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus( array(
			'primary' => __( 'Primary Menu', 'divina' ),
			'bottom'  => __( 'Bottom Menu', 'divina' ),
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
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		 */
		add_theme_support( 'post-formats', array(
			'image',
			'video',
			'gallery',
			'audio',
		) );

	}
endif;
add_action( 'after_setup_theme', 'divina_setup' );

if ( ! function_exists( 'divina_fonts_url' ) ) :
	/**
	 * Register Google fonts for Divina.
	 */
	function divina_fonts_url() {
		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';

		/*
		 * Translators: If there are characters in your language that are not supported
		 * by Noto Sans, translate this to 'off'. Do not translate into your own language.
		 */
		if ( 'off' !== _x( 'on', 'Raleway font: on or off', 'divina' ) ) {
			$fonts[] = 'Raleway:200,400,600';
		}

		/*
	 	* Translators: If there are characters in your language that are not supported
	 	* by Noto Serif, translate this to 'off'. Do not translate into your own language.
	 	*/
		if ( 'off' !== _x( 'on', 'Niconne font: on or off', 'divina' ) ) {
			$fonts[] = 'Niconne';
		}

		/*
		 * Translators: To add an additional character subset specific to your language,
		 * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.
		 */
		$subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'divina' );

		if ( 'cyrillic' === $subset ) {
			$subsets .= ',cyrillic,cyrillic-ext';
		} elseif ( 'greek' === $subset ) {
			$subsets .= ',greek,greek-ext';
		} elseif ( 'devanagari' === $subset ) {
			$subsets .= ',devanagari';
		} elseif ( 'vietnamese' === $subset ) {
			$subsets .= ',vietnamese';
		}

		if ( $fonts ) {
			$fonts_url = add_query_arg( array(
				'family' => urlencode( implode( '|', $fonts ) ),
				'subset' => urlencode( $subsets ),
			), '//fonts.googleapis.com/css' );
		}

		return $fonts_url;
	}
endif;

/**
 * JavaScript Detection.
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 */
function divina_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'divina_javascript_detection', 0 );

/**
 * Enqueue scripts and styles.
 */
function divina_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'divina-fonts', divina_fonts_url(), array(), null );

	// Load our main stylesheet.
	wp_enqueue_style( 'divina-style', get_stylesheet_uri() );

	// Load nanoscroller stylesheet.
	wp_enqueue_style( 'divina-nanoscroller-style', get_template_directory_uri() . '/css/nanoscroller.css', array(), '0.8.7' );

	// Load theme stylesheet.
	wp_enqueue_style( 'divina-custom-style', get_template_directory_uri() . '/css/divina-theme.css', array(), '1.0' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Load fittext js.
	wp_enqueue_script( 'divina-fittext-script', get_template_directory_uri() . '/js/jquery.fittext.js', array( 'jquery' ), '1.2', true );

	// Load nanoscroller js.
	wp_enqueue_script( 'divina-nanoscroller-script', get_template_directory_uri() . '/js/jquery.nanoscroller.min.js', array( 'jquery' ), '0.8.7', true );

	// Load custom functions js.
	wp_enqueue_script( 'divina-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '1.0', true );

}
add_action( 'wp_enqueue_scripts', 'divina_scripts' );

/**
 * Register widget areas.
 */
function divina_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Footer Area 1', 'divina' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your footer area.', 'divina' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Area 2', 'divina' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your footer area.', 'divina' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'divina_widgets_init' );

if ( ! function_exists( 'divina_add_search_box_to_divina_menu' ) ) :
	/**
	 * Add search box to menu
	 * @param mixed  $items menu item.
	 * @param object $args menu args.
	 */
	function divina_add_search_box_to_divina_menu( $items, $args ) {
		if ( $args->theme_location === 'primary' ) {
			$form = '<form role="search" method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >
    		<div><label for="s"><span class="divinasearch glyphicon glyphicon-search" aria-hidden="true"></span></label>
    		<input type="text" value="' . get_search_query() . '" name="s" id="s" />
    		</div>
    		</form>';
			return $items.'<li class="menu-item menu-item-search">'.$form.'</li>';
		}
		return $items;
	}
endif;
add_filter( 'wp_nav_menu_items', 'divina_add_search_box_to_divina_menu', 10, 2 );

if ( ! function_exists( 'divina_comment_nav' ) ) :
	/**
	 * Display navigation to next/previous comments when applicable.
	 */
	function divina_comment_nav() {
		// Are there comments to navigate through?
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
		?>
		<nav class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'divina' ); ?></h2>
			<div class="nav-links">
				<?php
				if ( $prev_link = get_previous_comments_link( __( 'Older Comments', 'divina' ) ) ) :
					printf( '<div class="nav-previous">%s</div>', esc_url( $prev_link ) );
				endif;

				if ( $next_link = get_next_comments_link( __( 'Newer Comments', 'divina' ) ) ) :
					printf( '<div class="nav-next">%s</div>', esc_url( $next_link ) );
				endif;
				?>
			</div><!-- .nav-links -->
		</nav><!-- .comment-navigation -->
		<?php
		endif;
	}
endif;

if ( ! function_exists( 'divina_wrap_embed_with_div' ) ) :
	/**
	 * Adding a wrapping div to Video embeds for responsiveness.
	 * @param mixed  $html The HTML result, stored in post meta.
	 * @param string $url The attempted embed URL.
	 * @param array  $attr An array of shortcode attributes.
	 */
	function divina_wrap_embed_with_div( $html, $url, $attr ) {
		return '<div class="responsive-container">' . $html . '</div>';
	}
endif;
add_filter( 'embed_oembed_html', 'divina_wrap_embed_with_div', 10, 3 );

if ( ! function_exists( 'divina_entry_meta' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags.
	 */
	function divina_entry_meta() {

		if ( in_array( get_post_type(), array( 'post', 'attachment' ) ) ) {

			if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
				$time_string = '<time class="updated" datetime="%3$s">%4$s</time>';
			} else {
				$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
			}

			$time_string = sprintf( $time_string,
				esc_attr( get_the_date( 'c' ) ),
				esc_html( get_the_date() ),
				esc_attr( get_the_modified_date( 'c' ) ),
				esc_html( get_the_modified_date() )
			);

			printf( // WPCS: XSS OK.
				'<span class="posted-on"><a href="%1$s" rel="bookmark">%2$s</a></span>',
				esc_url( get_permalink() ),
				$time_string
			);
		}

		if ( 'post' === get_post_type() ) {
			if ( is_singular() || is_multi_author() ) {
				printf( '<span class="byline"><span class="author vcard">%1$s <a class="url fn n" href="%2$s">%3$s</a></span></span>',
					esc_html_x( 'By', 'Used before post author name.', 'divina' ),
					esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
					get_the_author()
				);
			}

			$categories_list = get_the_category_list( esc_html_x( ', ', 'Used between list items, there is a space after the comma.', 'divina' ) );
			if ( $categories_list ) {
				printf( // WPCS: XSS OK.
					'<span class="cat-links">%1$s %2$s</span>',
					esc_html_x( 'In', 'Used before category names.', 'divina' ),
					$categories_list
				);
			}

			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'Used between list items, there is a space after the comma.', 'divina' ) );
			if ( $tags_list ) {
				printf( // WPCS: XSS OK.
					'<span class="tags-links">%1$s %2$s</span>',
					esc_html_x( 'Tags:', 'Used before tag names.', 'divina' ),
					$tags_list
				);
			}
		}

		if ( is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link( __( 'Leave a comment', 'divina' ), __( '1 Comment', 'divina' ), __( '% Comments', 'divina' ) );
			echo '</span>';
		}
	}
endif;

if ( ! function_exists( 'divina_post_thumbnail' ) ) :
	/**
	 * Display post thumbnail.
	 */
	function divina_post_thumbnail() {
		if ( ! has_post_thumbnail() && ! is_single() && ! is_page() ) {
			?>
			<div class="post-thumbnail">
				<img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/divina-square.png" alt="<?php echo get_the_title(); ?>">
			</div>
			<?php
		}
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
		?>

		<div class="post-thumbnail">
			<?php the_post_thumbnail(); ?>
		</div><!-- .post-thumbnail -->

		<?php else : ?>

		<div class="post-thumbnail">
			<?php
				the_post_thumbnail( 'divina-square', array( 'alt' => get_the_title() ) );
			?>
		</div>

		<?php endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'divina_excerpt_more' ) && ! is_admin() ) :
	/**
	 * Replaces "[...]" (appended to automatically generated excerpts) with ... .
	 * @param string $more The string shown within the more link.
	 */
	function divina_excerpt_more( $more ) {
		return '...';
	}
endif;
add_filter( 'excerpt_more', 'divina_excerpt_more' );

if ( ! function_exists( 'divina_excerpt_length' ) && ! is_admin() ) :
	/**
	 * Control Excerpt Length.
	 * @param int $length The number of words.
	 */
	function divina_excerpt_length( $length ) {
		return 10;
	}
endif;
add_filter( 'excerpt_length', 'divina_excerpt_length', 999 );

if ( ! function_exists( 'divina_comment_form_fields' ) ) :
	/**
	 * Custom comment form fields
	 * @param array $fields The default comment fields.
	 */
	function divina_comment_form_fields( $fields ) {
		// Include these if you intend to use them.
		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );

		// Your code here!
		$fields = array(

		'author' =>
		'<div class="row"><div class="comment-form-author col-md-4"><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
		'" size="30"' . $aria_req . ' placeholder="' . __( 'Your full name', 'divina' ) . ( $req ? '*' : '' ) . '" /></div>',

		'email' =>
		'<div class="comment-form-email col-md-4"><input id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) .
		'" size="30"' . $aria_req . ' placeholder="' . __( 'Email address', 'divina' ) . ( $req ? '*' : '' ) . '" /></div>',

		'url' =>
		'<div class="comment-form-url col-md-4"><input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
		'" size="30" placeholder="' . __( 'Website', 'divina' ) . '" /></div></div>',
		);
		// Return.
		return $fields;
	}
endif;
add_filter( 'comment_form_default_fields', 'divina_comment_form_fields' );

if ( ! function_exists( 'divina_post_nav_image' ) ) :
	/**
	 * Add featured image to post navigation elements.
	 * @param string $direc Next or Prev.
	 */
	function divina_post_nav_image( $direc ) {
		$prevthumb = get_stylesheet_directory_uri() . '/images/divina-rect.png';
		$nextthumb = get_stylesheet_directory_uri() . '/images/divina-rect.png';
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		if ( is_attachment() && 'attachment' === $previous->post_type ) {
			return;
		}

		if ( $previous &&  has_post_thumbnail( $previous->ID ) ) {
			$prevthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $previous->ID ), 'divina-rect' )[0];
		}

		if ( $next && has_post_thumbnail( $next->ID ) ) {
			$nextthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $next->ID ), 'divina-rect' )[0];
		}

		if ( 'next' === $direc ) {
			return $nextthumb;
		} elseif ( 'prev' === $direc ) {
			return $prevthumb;
		} else {
			return;
		}
	}
endif;

if ( ! function_exists( 'divina_prepend_attachment' ) ) :
	/**
	 * Set default image size on the attachment pages.
	 */
	function divina_prepend_attachment() {
		return '<p>' . wp_get_attachment_link( 0, 'full', false ) . '</p>';
	}
endif;
add_filter( 'prepend_attachment', 'divina_prepend_attachment' );
