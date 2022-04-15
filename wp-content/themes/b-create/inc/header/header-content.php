<?php
/** 
 * Định nghĩa các chức năng dùng để hiển thị header page
 * @package WordPress
 * @subpackage B-Create_Theme
 * @since B-Create 1.0
 */


/**
 * lấy thông tin site logo
 */
if( !function_exists( 'bcreate_logo' ) ) {
    function bcreate_logo() {
        $logo = get_custom_logo();
        echo $logo;
    }
}

if( !function_exists( 'bcreate_main_menu' ) ) {
    function bcreate_main_menu() {
        wp_nav_menu( array( 'theme_location' => 'primary-menu' ) );
    }
} 

/**
 * hiển thị bố cục header
 */
// Lý do tôi sử dụng hook để hiển thị header là vì 
// tôi có thể thêm điều kiện để kiểm tra hiển thị hoặc không hiển thị ở 1 điều kiện nào đó

if( !function_exists( 'site_header_content' ) ) {
    function site_header_content() { 
        global $wp_query;
        if( is_single() && get_post_format( $wp_query->post ) == 'video' ) {
            return false;
        }
    ?>
        <div class="header-container">
            <div class="container">
                <div class="row">
                    <div class="site-logo">
                        <?php bcreate_logo() ?>
                    </div>
                </div>
                <div class="row header-menus">
                    <?php bcreate_main_menu() ?>
                </div>
            </div>
        </div>
    <?php
    }
    add_action( 'header_page', 'site_header_content', 10, 1 );
}