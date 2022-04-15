<?php
/** 
 * Create widgets
 * @package WordPress
 * @subpackage B-Create_Theme
 * @since B-Create 1.0
 */

require_once THEME_URL . '/inc/widgets/widget-popular-posts.php';

// init các widget
if( !function_exists('bcreate_init_widgets') ) {
    function bcreate_init_widgets(  ) {
        if( class_exists('BCREATE_PopularPosts') ) {
            register_widget('BCREATE_PopularPosts');
        }
    }
    add_action( 'widgets_init', 'bcreate_init_widgets', 20 );
}
