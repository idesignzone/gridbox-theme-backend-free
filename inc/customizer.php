<?php
/**
 * gridbox-theme Theme Customizer
 *
 * @package gridbox-theme
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function gridbox_theme_customize_register( $wp_customize ) {

	// Netlify Deployment
	$wp_customize->add_section( 'gridbox_deployment' , array(
		'title' => __( 'Netlify Deployment', 'gridbox')
	) );
	class gridbox_deployment_Control extends WP_Customize_Control {
		
		public $type = 'text';
		public function render_content() {
			
			echo '<label>';
				echo '<span class="customize-control-title">' . esc_html( $this-> label ) . '</span>';
				echo '<input style ="width: 100%;"';
				$this->link();
				echo '></input>';
			echo '</label>';
			
		}
	}
	$wp_customize->add_setting( 'gridbox_Build_Hook_URL', array (
		'default' => __( '', 'gridbox' )
	) );
	$wp_customize->add_control( new gridbox_deployment_Control(
		$wp_customize,
		'gridbox_Build_Hook_URL',
		array( 
			'label' => __( 'Build Hook URL', 'gridbox' ),
			'section' => 'gridbox_deployment',
			'settings' => 'gridbox_Build_Hook_URL'
	)));

	$wp_customize->add_setting( 'gridbox_Netlify_Api_ID', array (
		'default' => __( '', 'gridbox' )
	) );
	$wp_customize->add_control( new gridbox_deployment_Control(
		$wp_customize,
		'gridbox_Netlify_Api_ID',
		array( 
			'label' => __( 'Netlify API ID', 'gridbox' ),
			'section' => 'gridbox_deployment',
			'settings' => 'gridbox_Netlify_Api_ID'
	)));


	// Header Title and tagline
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title',
				'render_callback' => 'gridbox_theme_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'gridbox_theme_customize_partial_blogdescription',
			)
		);
	}
}
add_action( 'customize_register', 'gridbox_theme_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function gridbox_theme_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function gridbox_theme_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function gridbox_theme_customize_preview_js() {
	wp_enqueue_script( 'gridbox-theme-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
}
add_action( 'customize_preview_init', 'gridbox_theme_customize_preview_js' );
