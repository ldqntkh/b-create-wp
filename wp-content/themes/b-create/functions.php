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
         * theme logo
         */
        add_theme_support( 'custom-logo' );

        /**
         * Tạo menu cho theme
         */
        register_nav_menu ( "primary-menu", __("Primary Menu", THEME_TEXT_DOMAIN) );

        register_post_type( 'custom_product',
            array(
                'labels' => array( 'name' => __( 'Custom Product' ) ),
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true, 
                'show_in_menu' => true, 
                'query_var' => true,
                'rewrite' => array('slug'=>'product'),  // chỉnh lại slug url
                'capability_type' => 'post',
                'has_archive' => true, 
                'hierarchical' => false,
                'menu_position' => 10,
                'supports' => array('title', 'editor', 'thumbnail', 'custom-fields', 'revisions', 'page-attributes', 'tags'),
                'taxonomies'  => array( 'category', 'post_tag' ),
            )
        );


    }
    add_action ( "init", "bcreate_setup_theme" );
}

add_filter('pre_get_posts', 'query_post_type');
function query_post_type($query) {
    if( is_category() || is_tag() ) {
        $query->set( 'post_type', array( 'post', 'custom_product' ) );
        return $query;
    }
}


add_filter( 'gutenberg_use_widgets_block_editor', '__return_false' );
add_filter( 'use_widgets_block_editor', '__return_false' );


/**
 * require các file cần thiết
 */
require_once THEME_URL . '/inc/sidebar/init-sidebar.php';

require_once THEME_URL . '/inc/widgets/init-widget.php';

require_once THEME_URL . '/inc/helper-functions.php';

require_once THEME_URL . '/inc/shortcode/init-shortcode.php';

require_once THEME_URL . '/inc/header/header-content.php';

require_once THEME_URL . '/inc/register-script.php';