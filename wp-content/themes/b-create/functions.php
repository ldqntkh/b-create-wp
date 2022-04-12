<?php
/** 
 * @package WordPress
 * @subpackage B-Create_Theme
 * @since B-Create 1.0
 */

/**
 * Thiết lập các hằng dữ liệu quan trọng
 * THEME_URL = get_stylesheet_directory() – đường dẫn tới thư mục theme
**/
define( "THEME_URL", get_stylesheet_directory() );
define( "THEME_URI", get_stylesheet_directory_uri() );
define( "THEME_VERSION", "1.0.0" );
define( "THEME_TEXT_DOMAIN", "b-create" );

/**
 * Thiết lập $content_width để khai báo kích thước chiều rộng của nội dung
**/
if ( ! isset( $content_width ) ) {
    $content_width = 720;
    /**
     * content_width biến này dùng để xác định chiều rộng tối đa mà các phần nội dung có thể hiển thị 
     * Ví dụ: nếu bạn nhúng 1 đoạn mã hiển thị vào website, dựa vào content_width này mà đoạn mã nhúng đó sẽ hiển thị chiều rộng tối đa 720 nếu kích thước của nó có lớn hơn 
     */
}

/**
 * Thiết lập các chức năng sẽ được theme hỗ trợ
**/
  if ( ! function_exists( "bcreate_setup_theme" ) ) {
    /*
     * Nếu chưa có hàm bcreate_setup_theme() thì sẽ tạo mới hàm đó
     */
    function bcreate_setup_theme() {
        /**
         * Thiết lập theme có thể dịch được
         * "b-create" chính là tên text-domain đã thiết lập trong file style.css
         * "/languages" chính là languages folder thiết lập trong file style.css
         */
        
        $language_folder = THEME_URL . "/languages";
        load_theme_textdomain( THEME_TEXT_DOMAIN, $language_folder );

        /**
         * Tự chèn RSS Feed links trong <head>
         */
        add_theme_support( "automatic-feed-links" );

        /**
         * Thêm chức năng post thumbnail
         */
        add_theme_support( "post-thumbnails" );

        /**
         * Thêm chức năng title-tag để tự thêm <title>
         */
        add_theme_support( "title-tag" );

        /**
         * Thêm chức năng post format
         */
        add_theme_support( "post-formats",
            array(
                "image",
                "video",
                "gallery",
                "quote",
                "link"
            )
        );

        /**
         * Tạo menu cho theme
         */
        register_nav_menu ( "primary-menu", __("Primary Menu", THEME_TEXT_DOMAIN) );

        /**
         * Tạo sidebar cho theme
         */
        $sidebar = array(
            "name" => __("Main Sidebar", THEME_TEXT_DOMAIN),
            "id" => "main-sidebar",
            "description" => "Main sidebar",
            "class" => "main-sidebar",
            "before_title" => "<h3 class='widgettitle'>",
            "after_title" => "</h3>"
        );
        register_sidebar( $sidebar );
    }
    add_action ( "init", "bcreate_setup_theme" );
}

function set_posts_per_page_for_towns_cpt( $query ) {
    if ( !is_admin() && $query->is_main_query() ) {
        $query->set( 'posts_per_page', '5' );
    }
}
add_action( 'pre_get_posts', 'set_posts_per_page_for_towns_cpt' );

/**
 * require các file cần thiết
 */
require_once THEME_URL . '/inc/helper-functions.php';

require_once THEME_URL . '/inc/register-script.php';