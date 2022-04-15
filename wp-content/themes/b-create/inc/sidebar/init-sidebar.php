<?php
/** 
 * Create sidebars
 * @package WordPress
 * @subpackage B-Create_Theme
 * @since B-Create 1.0
 */

if( !function_exists( 'bcreate_init_sidebars' ) ) {
    function bcreate_init_sidebars() {
        $sidebar = array(
            "name" => __("Home Sidebar", THEME_TEXT_DOMAIN),
            "id" => "home-sidebar",
            "description" => "Home sidebar",
            "class" => "home-sidebar",
            "before_title" => "<h3 class='widgettitle'>",
            "after_title" => "</h3>"
        );
        register_sidebar( $sidebar );

        $sidebar = array(
            "name" => __("Category Sidebar", THEME_TEXT_DOMAIN),
            "id" => "category-sidebar",
            "description" => "Category sidebar",
            "class" => "category-sidebar",
            "before_title" => "<h3 class='widgettitle'>",
            "after_title" => "</h3>"
        );
        register_sidebar( $sidebar );

        $sidebar = array(
            "name" => __("Post Sidebar", THEME_TEXT_DOMAIN),
            "id" => "post-sidebar",
            "description" => "Post sidebar",
            "class" => "post-sidebar",
            "before_title" => "<h3 class='widgettitle'>",
            "after_title" => "</h3>"
        );
        register_sidebar( $sidebar );

        $sidebar = array(
            "name" => __("Footer Sidebar", THEME_TEXT_DOMAIN),
            "id" => "footer-sidebar",
            "description" => "Footer sidebar",
            "class" => "footer-sidebar",
            "before_title" => "<h3 class='widgettitle'>",
            "after_title" => "</h3>"
        );
        register_sidebar( $sidebar );
    }
    add_action ( "init", "bcreate_init_sidebars" );
}