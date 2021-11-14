<?php
/**
 * gridbox-theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package gridbox-theme
 */

// Define path and URL to the ACF plugin.
define( 'MY_ACF_PATH', get_template_directory() . '/inc/acf/' );
define( 'MY_ACF_URL', get_template_directory_uri() . '/inc/acf/' );

// Customize the url setting to fix incorrect asset URLs.
add_filter('acf/settings/url', 'my_acf_settings_url');
function my_acf_settings_url( $url ) {
    return MY_ACF_URL;
}

// Include the ACF plugin.
include_once( MY_ACF_PATH . 'acf.php' );

// Add External CSS to ACF Admin Head
function gridbox_acf_head_input() {
    echo '<style>
            .acf-repeater .acf-row-handle .acf-icon { margin: 2px 0 0 -2px !important; }
            .block-editor-block-contextual-toolbar { margin-bottom: 0 !important; }
            .editor-post-featured-image img[src$=".svg"] { position: relative; }
         </style>';
}
add_action('acf/input/admin_head', 'gridbox_acf_head_input');

//Save ACF fields
add_filter('acf/settings/save_json', 'my_acf_json_save_point');
function my_acf_json_save_point( $path ) {

    // update path
    $path = get_template_directory() . '/inc/acf-json';


    // return
    return $path;

}

// Load ACF Fields
// add_filter('acf/settings/load_json', 'my_acf_json_load_point');
// function my_acf_json_load_point( $paths ) {

//    // remove original path (optional)
//    unset($paths[0]);


//    // append path
//    $paths[] = get_template_directory() . '/inc/acf-json/acf-load-json';


//    // return
//    return $paths;

// }


if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'gridbox_theme_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function gridbox_theme_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on gridbox-theme, use a find and replace
		 * to change 'gridbox-theme' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'gridbox-theme', get_template_directory() . '/languages' );

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
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'gridbox_theme_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'gridbox_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function gridbox_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'gridbox_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'gridbox_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function gridbox_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'gridbox-theme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'gridbox-theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'gridbox_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function gridbox_theme_scripts() {

	wp_enqueue_style( 'uikit', get_template_directory_uri() . '/assets/css/uikit.min.css',false,'all');
	wp_enqueue_style( 'gridbox-theme-style', get_stylesheet_uri(), array(), _S_VERSION );

    wp_enqueue_script( 'uikit-script', get_template_directory_uri() . '/assets/js/uikit.min.js', array(), true );
    wp_enqueue_script( 'main-script', get_template_directory_uri() . '/assets/js/main.js', array(), _S_VERSION, true );
    wp_enqueue_script( 'fontawesome-script', get_template_directory_uri() . '/assets/fonts/font-awesome/js/all.js', array(), false );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'gridbox_theme_scripts' );

// Wordpress editor setup
function gridbox_setup() {
    // Add support for editor styles.
    add_theme_support( 'editor-styles' );

    // Enqueue editor styles.
    add_editor_style( '/assets/css/uikit.min.css');
    add_editor_style( '/style.css');

}
add_action( 'after_setup_theme', 'gridbox_setup' );

// Add External JS to Admin
function gridbox_admin_scripts() {
    wp_enqueue_script( 'uikit', get_template_directory_uri() . '/assets/js/uikit.min.js', array(), _S_VERSION, true );
    wp_enqueue_script( 'fontawesome-icons', get_template_directory_uri() . '/assets/fonts/font-awesome/js/all.js', array(), _S_VERSION, true );
}
add_action( 'admin_enqueue_scripts', 'gridbox_admin_scripts' );

// Register Sidebars
add_action( 'widgets_init', 'gridbox_register_sidebars' );
function gridbox_register_sidebars() {
    register_sidebar(
        array(
            'id'            => 'sidebar-1',
            'name'          => esc_html__( 'Primary' ),
            'description'   => esc_html__( 'Add widgets here.' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
            'show_in_graphql' => true
        )
    );
    register_sidebar(
        array(
            'id'            => 'blog',
            'name'          => __( 'Blog' ),
            'description'   => __( 'Sidebar for Blog page.' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            'show_in_graphql' => true
        )
    );
    register_sidebar(
        array(
            'id'            => 'footer',
            'name'          => __( 'Footer' ),
            'description'   => __( 'Global footer sidebar' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            'show_in_graphql' => true
        )
    );
}

// Get Breadcrumbs
function the_breadcrumb() {
    if (!is_home()) {
        echo '<li><a href="';
        echo '/';
        echo '">';
        echo 'Home';
        echo "</a></li>  ";
        if (is_category() || is_single()) {
            the_category(' ');
            if (is_single()) {
                echo "  <span></span>  ";
                the_title();
            }
        } elseif (is_page()) {

            echo '<li><a href="#"></a>';
            echo the_title();
            echo '</li>';
        }
    }
}

// Enable support for Post Thumbnails on posts and pages.
add_theme_support( 'post-thumbnails' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

