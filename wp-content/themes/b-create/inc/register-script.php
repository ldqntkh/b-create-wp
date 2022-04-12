<?php


/**
 * Enqueue styles.
 */
if( !function_exists( 'bcreate_enqueue_styles' ) ) {
    function bcreate_enqueue_styles() {
        wp_register_style( 'b-create-style', THEME_URI . '/assets/css/custom-style.css', array(), THEME_VERSION );
        wp_enqueue_style( 'b-create-style' );
    }
    add_action( 'wp_enqueue_scripts', 'bcreate_enqueue_styles' );
}

/**
 * Enqueue js
 */

if( !function_exists( 'bcreate_enqueue_script' ) ) {
    function bcreate_enqueue_script() {
        wp_register_script( 'b-create-script-head', THEME_URI . '/assets/js/app-head.js', array(), THEME_VERSION, false );
        wp_enqueue_script( 'b-create-script-head' );

        wp_register_script( 'b-create-script-footer', THEME_URI . '/assets/js/app-footer.js', array(), THEME_VERSION, true );
        wp_enqueue_script( 'b-create-script-footer' );
    }
    add_action( 'wp_enqueue_scripts', 'bcreate_enqueue_script' );
}
