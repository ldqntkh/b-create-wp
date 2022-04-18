<?php
/** 
 * Post template hiển thị nội dung giống sản phẩm
 * @package WordPress
 * @subpackage B-Create_Theme
 * @since B-Create 1.0
 * Template Name: B-CREATE product template
 */


get_header();
?>

<div id="product-page" class="container">

    <?php
        /**
         * hiển thị image - galerry - shortcontent + price
         * Hiển thị content - sidebar
         */
        $pageId = get_the_ID();
        /* Hoặc có thể lấy như sau

        global $post;
        $pageId = $post->ID;
        */

        $price = get_field( 'price', $pageId );
        $short_description = get_field( 'short_description', $pageId );
        $gallery_0 = get_the_post_thumbnail_url( $post );
        $gallery_1 = get_field( 'gallery_1', $pageId );
        $gallery_2 = get_field( 'gallery_2', $pageId );
        $gallery_3 = get_field( 'gallery_3', $pageId );
        $gallery_4 = get_field( 'gallery_4', $pageId );

    ?>

    
    <div class="product-main">
        <div class="primary">
            <div class="product-header">
                <div class="product-title">
                    <h3><?= get_the_title() ?></h3>
                </div>
                <div class="product-head">
                    <div class="product-images">
                        <div id="main-img">
                            <img src="<?= $gallery_0 ?>" alt="" />
                        </div>
                        <div id="gallery">
                            <img src="<?= $gallery_0 ?>" alt="" />
                            <img src="<?= $gallery_1 ?>" alt="" />
                            <img src="<?= $gallery_2 ?>" alt="" />
                            <img src="<?= $gallery_3 ?>" alt="" />
                            <!-- <img src="<?= $gallery_4 ?>" alt="" /> -->
                        </div>
                    </div>
                    <div class="product-shortdesc">
                        <aside><?= $short_description ?></aside>
                        <p>
                            <button class="btn btn-lg btn-danger">
                                <?= apply_filters('bcreate_product_price', $price) ?>
                            </button>
                        </p>
                    </div>
                </div>
            </div>
            <div class="product-content"> 
                <h2><?= __("Chi tiết sản phẩm", THEME_TEXT_DOMAIN) ?></h2>    
                <?= get_the_content() ?>
                <div class="text-left"><?php bcreate_post_tags() ?></div>
            </div>
        </div>

        <div class="sidebar">
            <?php
                if ( is_active_sidebar('home-sidebar') ) {
                    dynamic_sidebar( 'home-sidebar' );
                }
            ?>
        </div>
    </div>
</div>

<?php
get_footer();