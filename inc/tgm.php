<?php

/* Configure TGM Plugin */
require_once dirname(__FILE__) . '/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'gridbox_require_plugins' );

function gridbox_require_plugins() {

    $plugins = array(
        array(
            'name'               => 'WP GraphQL',
            'slug'               => 'wp-graphql',
            'required'           => false, // this plugin is required
            'version'            => '1.6.7', // the user must use version 1.1 (or higher) of this plugin
            'force_activation'   => false, // this plugin is going to stay activated unless the user switches to another theme
        ),
        array(
            'name'               => 'WPGraphQL for Advanced Custom Fields',
            'slug'               => 'wp-graphql-acf-develop',
            'source'             => get_template_directory() . '/lib/plugins/wp-graphql-acf-develop.zip', // The "internal" source of the plugin.
            'required'           => false, // this plugin is required
            'version'            => '0.4.1', // the user must use version 1.1 (or higher) of this plugin
            'force_activation'   => false, // this plugin is going to stay activated unless the user switches to another theme
        ),
        array(
            'name'               => 'WPGraphQL Widgets',
            'slug'               => 'wp-graphql-widgets',
            'source'             => get_template_directory() . '/lib/plugins/wp-graphql-widgets.zip', // The "internal" source of the plugin.
            'required'           => false, // this plugin is required
            'version'            => '0.0.3', // the user must use version 1.1 (or higher) of this plugin
            'force_activation'   => false, // this plugin is going to stay activated unless the user switches to another theme
        )

    );
    $config = array(
        'id'           => 'gridbox-tgmpa', // your unique TGMPA ID
        'default_path' => '', // default absolute path
        'menu'         => 'gridbox-install-required-plugins', // menu slug
        'has_notices'  => true, // Show admin notices
        'dismissable'  => true, // the notices are NOT dismissable
        'dismiss_msg'  => 'I really, really need you to install these plugins, okay?', // this message will be output at top of nag
        'is_automatic' => true, // automatically activate plugins after installation
    );

    tgmpa( $plugins, $config );

};
