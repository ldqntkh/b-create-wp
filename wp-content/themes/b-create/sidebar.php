<?php
/** 
 * Template hiển thị nội dung của sidebar
 * @package WordPress
 * @subpackage B-Create_Theme
 * @since B-Create 1.0
 */

    if ( is_active_sidebar('home-sidebar') ) {
        dynamic_sidebar( 'home-sidebar' );
    } else {
        _e('This is widget area. Go to Appearance -> Widgets to add some widgets.', THEME_TEXT_DOMAIN);
    }
?>