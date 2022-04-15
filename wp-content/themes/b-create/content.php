<?php
/** 
 * Template hiển thị nội dung của post
 * @package WordPress
 * @subpackage B-Create_Theme
 * @since B-Create 1.0
 */
?>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-thumbnail">
        <?php bcreate_thumbnail("thumbnail") ?>
    </div>

    <div class="post-content">
        <header class="entry-header">
            <?php bcreate_post_header() ?>
            <?php bcreate_post_meta() ?>
        </header>
        
        <div class="entry-content">
            <?php bcreate_posts_content() ?>
        </div>
    </div>
</article>