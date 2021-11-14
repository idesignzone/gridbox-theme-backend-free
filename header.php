<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package gridbox-theme
 */

 // Customizer Logo
$custom_logo_id = get_theme_mod( 'custom_logo' );
$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<title><?php single_post_title(); ?></title>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php
		if (has_site_icon()) {
			echo '<link rel="shortcut icon" type="image/jpg" href="' . get_site_icon_url() . '"/>';
		}
    ?>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<div class="gridbox">

	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'test' ); ?></a>

    <!-- Preloader -->
    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- /End Preloader -->

	<header class="uk-position-top">
  		<div data-uk-sticky="self-target: .uk-navbar-container; cls-active: uk-background-default uk-box-shadow-small uk-navbar-sticky; top: 50vh; animation: uk-animation-slide-top-small">
            <nav class="uk-container uk-container-expand uk-navbar-container" data-uk-navbar>
                <div class="uk-navbar-left">
                    <a class="uk-navbar-item uk-logo uk-padding-remove" href="<?php echo home_url(); ?>">

                        <!-- Logo -->
                        <?php
                        if ( has_custom_logo() ) {
                            echo '<img src="' . esc_url( $logo[0] ) . '" alt="' . get_bloginfo( 'name' ) . '">';
                        } else {
                            echo '<img src="' . get_template_directory_uri() . '/assets/images/gridbox-logo.svg' . '" alt="Gridbox WordPress Theme" >';
                        }
                        ?>

                        <!-- Logo Title -->
                        <?php
                            if ( display_header_text()==true ) {
                                echo '<span class="uk-padding-small site-title">' . get_bloginfo( 'name' );
                                if ( get_bloginfo( 'tagline' ) ) {
                                    echo '<span class="uk-text-small uk-display-block site-description" style="margin-top: -8px;">' . get_bloginfo( 'tagline' ) . '</span>';
                                }
                                 echo '</span>';
                            }
                        ?>

                    </a>
                </div>

                <!-- Header Navigation Menu -->
                <div class="uk-navbar-center nav-overlay uk-visible@m">
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'header-menu',
                            'container_class'      => '',
                            'container_id'         => '',
                            'menu_class'           => 'uk-navbar-nav uk-visible@s',
                            'menu_id'              => '',
                        )
                    );
                    ?>
                </div>

                <!-- Header Search Form -->
                <div class="nav-overlay uk-navbar-left uk-flex-1" hidden>
                    <div class="uk-navbar-item uk-width-expand">
                        <?php get_search_form(); ?>
                    </div>
                    <a href="#" class="uk-navbar-toggle search-close-toggle" data-uk-close data-uk-toggle="target: .nav-overlay; animation: uk-animation-fade" href="#"></a>
                </div>

                <!-- Header Right -->
                <div class="uk-navbar-right">

                    <div class="uk-navbar-item">

                        <!-- Header Search Icon -->
                            <a class="uk-navbar-toggle uk-visible@s nav-overlay" data-uk-toggle="target: .nav-overlay; animation: uk-animation-fade" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="20">
                                    <path d="M508.5 481.6l-129-129c-2.3-2.3-5.3-3.5-8.5-3.5h-10.3C395 312 416 262.5 416 208 416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c54.5 0 104-21 141.1-55.2V371c0 3.2 1.3 6.2 3.5 8.5l129 129c4.7 4.7 12.3 4.7 17 0l9.9-9.9c4.7-4.7 4.7-12.3 0-17zM208 384c-97.3 0-176-78.7-176-176S110.7 32 208 32s176 78.7 176 176-78.7 176-176 176z"/>
                                </svg>
                            </a>
        
                    </div>

                    <!-- Header off-canvas Icon -->

                        <a class="uk-navbar-toggle uk-padding-remove-right" data-uk-toggle="target: #offcanvas">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="24">
                                <path d="M442 114H6a6 6 0 0 1-6-6V84a6 6 0 0 1 6-6h436a6 6 0 0 1 6 6v24a6 6 0 0 1-6 6zm0 160H6a6 6 0 0 1-6-6v-24a6 6 0 0 1 6-6h436a6 6 0 0 1 6 6v24a6 6 0 0 1-6 6zm0 160H6a6 6 0 0 1-6-6v-24a6 6 0 0 1 6-6h436a6 6 0 0 1 6 6v24a6 6 0 0 1-6 6z"/>
                            </svg>
                        </a>


                </div>
            </nav>
        </div>
	</header><!-- #masthead -->