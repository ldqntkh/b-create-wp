<?php
/** 
 * Template hiển thị nội dung của post-video
 * @package WordPress
 * @subpackage B-Create_Theme
 * @since B-Create 1.0
 */
?>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-content">
        <?php
            // lấy nội dung của custom field ACF post video
            $video_url = get_field("post_youtube_url");
            // embed url youtube video
            if( !empty( $video_url ) ) : ?>
                <iframe width="100%" class="iframe-video" src="<?= $video_url ?>?rel=0?version=3&autoplay=1&controls=0&&showinfo=0&loop=1" title="<?= the_title() ?>" 
                        frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                </iframe>
        <?php
            endif;
        ?>
    </div>
    <div class="container-breadcrumb">
        <div class="container">
            <?php bcreate_post_breadcrumb() ?>
        </div>
    </div>
    <div class="container">
        <header class="entry-header text-center">
            <?php bcreate_post_header() ?>
            <?php bcreate_post_meta() ?>
            <?php bcreate_post_tags() ?>
        </header>
    </div>
</article>