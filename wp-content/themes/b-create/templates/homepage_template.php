<?php
/** 
 * Page template hiển thị nội dung của trang chủ
 * @package WordPress
 * @subpackage B-Create_Theme
 * @since B-Create 1.0
 * Template Name: B-CREATE homepage template
 */


get_header();
?>

<div id="homepage" class="container">
    <div class="primary" id="homepage-posts">
        <?php echo do_shortcode( '[new_posts]' ); ?>
    </div>

    <div class="home-sidebar sidebar">
        <?php
            if ( is_active_sidebar('home-sidebar') ) {
                dynamic_sidebar( 'home-sidebar' );
            }
        ?>
    </div>
</div>

<?php
get_footer();