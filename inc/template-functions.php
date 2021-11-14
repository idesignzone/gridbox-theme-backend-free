<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package gridbox-theme
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function gridbox_theme_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'gridbox_theme_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function gridbox_theme_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'gridbox_theme_pingback_header' );


//Include TGM Plugin
require_once('tgm.php');

/* Add new Menu Location "HEADER_MENU" */
function register_my_menu() {
    register_nav_menu('header-menu',__( 'Header Menu' ));
    register_nav_menu('offcanvas-menu',__( 'Off-canvas Menu' ));
}
add_action( 'init', 'register_my_menu' );

/* Add class to submenu items */
function submenu_css_class( $classes ) {
    $classes[] = 'uk-navbar-dropdown';
    $classes[] = 'uk-nav-sub';
    return $classes;
}
add_action('nav_menu_submenu_css_class', 'submenu_css_class');

/* Add active class to menu item */
function special_nav_class($classes, $item){
    if( in_array('current-menu-item', $classes) ){
        $classes[] = 'uk-active ';
    }
    return $classes;
}
add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

/* Add parent class to menu items in off-canvas menu */
class My_Walker_Nav_Menu extends Walker_Nav_Menu {
    public function display_element($el, &$children, $max_depth, $depth = 0, $args, &$output){
        $id = $this->db_fields['id'];

        if(isset($children[$el->$id]))
            $el->classes[] = 'uk-parent';

        parent::display_element($el, $children, $max_depth, $depth, $args, $output);
    }
}

// Numeric Pagination
function page_navi($before = '', $after = '') {
    global $wpdb, $wp_query;
    $request = $wp_query->request;
    $posts_per_page = intval(get_query_var('posts_per_page'));
    $paged = intval(get_query_var('paged'));
    $numposts = $wp_query->found_posts;
    $max_page = $wp_query->max_num_pages;
    if ( $numposts <= $posts_per_page ) { return; }
    if(empty($paged) || $paged == 0) {
        $paged = 1;
    }
    $pages_to_show = 7;
    $pages_to_show_minus_1 = $pages_to_show-1;
    $half_page_start = floor($pages_to_show_minus_1/2);
    $half_page_end = ceil($pages_to_show_minus_1/2);
    $start_page = $paged - $half_page_start;
    if($start_page <= 0) {
        $start_page = 1;
    }
    $end_page = $paged + $half_page_end;
    if(($end_page - $start_page) != $pages_to_show_minus_1) {
        $end_page = $start_page + $pages_to_show_minus_1;
    }
    if($end_page > $max_page) {
        $start_page = $max_page - $pages_to_show_minus_1;
        $end_page = $max_page;
    }
    if($start_page <= 0) {
        $start_page = 1;
    }

    echo $before.'<nav class=""><ul class="uk-pagination" uk-margin>'."";
    if ($paged > 1) {
        $first_page_text = "<span uk-icon=\"icon: chevron-double-left; ratio: 1.3\"></span>";
        echo '<li class="page-item"><a class="page-link" href="'.get_pagenum_link().'" title="First">'.$first_page_text.'</a></li>';
    }

    $prevposts = get_previous_posts_link('<span uk-icon="icon: chevron-left"></span>');
    if($prevposts) { echo '<li class="previous">' . $prevposts  . '</li>'; }
    else { echo '<li class="uk-disabled page-item"><a class="page-link" href="#"><span uk-pagination-previous></span></a></li>'; }

    for($i = $start_page; $i  <= $end_page; $i++) {
        if($i == $paged) {
            echo '<li class="uk-active page-item"><a class="page-link" href="#">'.$i.'</a></li>';
        } else {
            echo '<li class="page-item"><a class="page-link" href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
        }
    }
    echo '<li class="page-item next">';
    next_posts_link('<span uk-pagination-next></span>');
    echo '</li>';
    if ($end_page < $max_page) {
        $last_page_text = "<span uk-icon=\"icon: chevron-double-right; ratio: 1.3\"></span>";
        echo '<li class="page-item"><a class="page-link" href="'.get_pagenum_link($max_page).'" title="Last">'.$last_page_text.'</a></li>';
    }
    echo '</ul></nav>'.$after."";
}

//Pagination for WP_Query
function pagination($pages = '', $range = 4)
{
    $showitems = ($range * 2)+1;

    global $paged;
    if(empty($paged)) $paged = 1;

    if($pages == '')
    {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if(!$pages)
        {
            $pages = 1;
        }
    }

    if(1 != $pages)
    {
        echo "<ul class='uk-pagination'><li><a class='uk-disabled'>Page ".$paged." of ".$pages."</a></li>";
        if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link(1)."'>&laquo; First</a></li>";
        if($paged > 1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a></li>";

        for ($i=1; $i <= $pages; $i++)
        {
            if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
            {
                echo ($paged == $i)? "<li class='uk-active'><a>".$i."</a></li>":"<li><a href='".get_pagenum_link($i)."' class=''>".$i."</a></li>";
            }
        }

        if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">Next &rsaquo;</a>";
        if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($pages)."'>Last &raquo;</a></li>";
        echo "</ul>\n";
    }
}

// Remove archive title prepend text
add_filter( 'get_the_archive_title', function ($title) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_author() ) {
        $title = '<span class="vcard">' . get_the_author() . '</span>' ;
    } elseif ( is_tax() ) { //for custom post types
        $title = sprintf( __( '%1$s' ), single_term_title( '', false ) );
    } elseif (is_post_type_archive()) {
        $title = post_type_archive_title( '', false );
    }
    return $title;
});

// Date for footer copyright
function comicpress_copyright() {
    global $wpdb;
    $copyright_dates = $wpdb->get_results("
SELECT
YEAR(min(post_date_gmt)) AS firstdate,
YEAR(max(post_date_gmt)) AS lastdate
FROM
$wpdb->posts
WHERE
post_status = 'publish'
");
    $output = '';
    if($copyright_dates) {
        $copyright = "&copy; " . $copyright_dates[0]->firstdate;
        if($copyright_dates[0]->firstdate != $copyright_dates[0]->lastdate) {
            $copyright .= '-' . $copyright_dates[0]->lastdate;
        }
        $output = $copyright;
    }
    return $output;
}

// Dashboard Widget
add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');

function my_custom_dashboard_widgets() {
    global $wp_meta_boxes;

    wp_add_dashboard_widget('deployment_status_widget', 'Deployment', 'dashboard_deployment_status');
}

function dashboard_deployment_status($build_hook) {

    $build_hook = get_theme_mod( 'gridbox_Build_Hook_URL' );
    $netlify_api_id = get_theme_mod( 'gridbox_Netlify_Api_ID' );

    if ($build_hook) {
        echo '<div style="display: flex;justify-content: space-between;align-items: center;">
        <a onclick="document.getElementById(\'deployToNetlify\').submit();" target="_blank">
        <form id="deployToNetlify" method="post" action="' . $build_hook . '"></form>
        <img src="https://www.netlify.com/img/deploy/button.svg" style="cursor: pointer;">
        </a>';
        if ($netlify_api_id) {
            echo '<a href="https://app.netlify.com/sites/pedantic-joliot-ad890e/deploys" target="_blank"><img src="https://api.netlify.com/api/v1/badges/'. $netlify_api_id .'/deploy-status" alt="Netlify Status"></a>
            <a style="cursor:pointer" onClick="window.location.reload();"><span class="dashicons dashicons-update"></span></a>';
        }
        echo '</div>';
    }
    if ($build_hook == null) {
        echo '<div id="the-comment-list"><div class="unapprove">Enter build Hook URL in <a href="'.get_site_url().'/wp-admin/customize.php?">Netlify Deployment</a></div></div>';
    }
}


if ( is_category() ) {
    $title = single_cat_title( '', false );
}

//Fix Rest API on site address change
add_filter('rest_url', function($url) {
    $siteURL = site_url();
    $url = str_replace(home_url(), $siteURL, $url);
    return $url;
});

// Declaring WooCommerce Support
function gridbox_add_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

add_action( 'after_setup_theme', 'gridbox_add_woocommerce_support' );

// Add customizer data to GraphQL data Layer
add_action( 'graphql_register_types', function() {

	register_graphql_field( 'RootQuery', 'siteLogo', [
		'type' => 'MediaItem',
		'description' => __( 'The logo set in the customizer', 'gridbox_theme' ),
		'resolve' => function() {

			$logo_id = get_theme_mod( 'custom_logo' );

			if ( ! isset( $logo_id ) || ! absint( $logo_id ) ) {
				return null;
			}

			$media_object = get_post( $logo_id );
			return new \WPGraphQL\Model\Post( $media_object );

		}
	]  );

} );
// Add customizer data to GraphQL data Layer
add_action( 'graphql_register_types', function() {
  $field_config = [
    'type' => 'String',
    'resolve' => function( $source, $args, $context, $info ) {
      return get_theme_mod('gridbox_Build_Hook_URL');
    },
  ];
    register_graphql_field( 'RootQuery', 'gridbox_Build_Hook_URL', $field_config);
});
// Add customizer data to GraphQL data Layer
add_action( 'graphql_register_types', function() {
  $field_config = [
    'type' => 'String',
    'resolve' => function( $source, $args, $context, $info ) {
      return get_theme_mod('gridbox_Netlify_Api_ID');
    },
  ];
    register_graphql_field( 'RootQuery', 'gridbox_Netlify_Api_ID', $field_config);
});