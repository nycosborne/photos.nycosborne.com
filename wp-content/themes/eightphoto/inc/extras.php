<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package eightphoto
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function eightphoto_body_classes( $classes ) {
    
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

    if(is_home() && !is_page_template() ){
        $post_sidebar = 'rightsidebar';
        $classes[] .= $post_sidebar;
    }
    if(is_search()):
        $classes[] .= 'rightsidebar';
    endif;

    if(is_singular(array('post','page')) && !is_home()){
        global $post;
        $post_sidebar = get_post_meta($post->ID, 'eightphoto_page_layouts', true);
        if(!$post_sidebar){
            $post_sidebar = 'rightsidebar';
        }
        $classes[] .= $post_sidebar;
    }
    if(is_archive()  ){
            $post_sidebar = get_theme_mod( 'eightphoto_archive_page_layout', 'rightsidebar');
                if(!$post_sidebar){
                    $post_sidebar = 'rightsidebar';
            }
        $classes[] .= $post_sidebar;
    }
    
	return $classes;
}
add_filter( 'body_class', 'eightphoto_body_classes' );



 /************************************************************
 ** Breadcrumb Settings                                     **
 ************************************************************/
 if ( ! function_exists( 'eightphoto_breadcrumbs' ) ) :
    function eightphoto_breadcrumbs() {
        global $post;
        $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
        $delimiter = '>';        
        $home = __('Home', 'eightphoto'); // text for the 'Home' link
        $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
        $before = '<span class="current">'; // tag before the current crumb
        $after = '</span>'; // tag after the current crumb
        $homeLink = esc_url(home_url());
            if (is_home() || is_front_page()) {
                if ($showOnHome == 1)
                    echo '<div id="eightphoto-breadcrumb"><a href="' . $homeLink . '">' . $home . '</a></div></div>';
            } else {
                echo '<div id="eightphoto-breadcrumb"><a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';

            if (is_category()) {
                $thisCat = get_category(get_query_var('cat'), false);
                if ($thisCat->parent != 0)
                    echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
                echo $before . single_cat_title('', false) .  $after;
            } elseif (is_search()) {
                echo $before . __('Search results for','eightphoto'). '"' . get_search_query() . '"' . $after;
            } elseif (is_day()) {
                echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
                echo '<a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
                echo $before . get_the_time('d') . $after;
            } elseif (is_month()) {
                echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
                echo $before . get_the_time('F') . $after;
            } elseif (is_year()) {
                echo $before . get_the_time('Y') . $after;
            } elseif (is_single() && !is_attachment()) {
                if (get_post_type() != 'post') {
                    $post_type = get_post_type_object(get_post_type());
                    $slug = $post_type->rewrite;
                    echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
                    if ($showCurrent == 1)
                        echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
                } else {
                    $cat = get_the_category();
                    $cat = $cat[0];
                    $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
                    if ($showCurrent == 0)
                        $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
                    echo $cats;
                    if ($showCurrent == 1)
                        echo $before . get_the_title() . $after;
                }
            } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
                $post_type = get_post_type_object(get_post_type());
                echo $before . $post_type->labels->singular_name . $after;
            } elseif (is_attachment()) {
                $parent = get_post($post->post_parent);
                $cat = get_the_category($parent->ID);
                $cat = $cat[0];
                echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
                echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
                if ($showCurrent == 1)
                    echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
            } elseif (is_page() && !$post->post_parent) {
                if ($showCurrent == 1)
                    echo $before . get_the_title() . $after;
            } elseif (is_page() && $post->post_parent) {
                $parent_id = $post->post_parent;
                $breadcrumbs = array();
                while ($parent_id) {
                    $page = get_page($parent_id);
                    $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
                    $parent_id = $page->post_parent;
                }
                $breadcrumbs = array_reverse($breadcrumbs);
                for ($i = 0; $i < count($breadcrumbs); $i++) {
                    echo $breadcrumbs[$i];
                    if ($i != count($breadcrumbs) - 1)
                        echo ' ' . $delimiter . ' ';
                }
                if ($showCurrent == 1)
                    echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
            } elseif (is_tag()) {
                echo $before . __('Posts tagged','eightphoto').' "' . single_tag_title('', false) . '"' . $after;
            } elseif (is_author()) {
                global $author;
                $userdata = get_userdata($author);
                echo $before . __('Articles posted by ','eightphoto'). $userdata->display_name . $after;
            } elseif (is_404()) {
                echo $before . 'Error 404' . $after;
            }

            if (get_query_var('paged')) {
                if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
                    echo $delimiter.' (';
                        echo __('Page', 'eightphoto') . ' ' . get_query_var('paged');
                        if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
                            echo ')';
            }

        echo '</div>';
        }
    }
endif;


 if ( ! function_exists( 'eightphoto_page_title' ) ) :
    function eightphoto_page_title(){
    ?>
    	<header class="page-header">
            <div class="foto-container">
                <h1><?php the_title(); ?></h1>
                <?php echo eightphoto_breadcrumbs(); ?>
            </div>
        </header>
    <?php
    }
endif;
add_action('eightphoto_title','eightphoto_page_title');
