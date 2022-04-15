<?php
/** 
 * Template hiển thị nội dung của sidebar home page
 * @package WordPress
 * @subpackage B-Create_Theme
 * @since B-Create 1.0
 */

    if ( is_active_sidebar('main-sidebar') ) {
        dynamic_sidebar( 'main-sidebar' );
    }
?>