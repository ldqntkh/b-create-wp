<?php
/** 
 * Template hiển thị thông tin tác giả bài viết
 * @package WordPress
 * @subpackage B-Create_Theme
 * @since B-Create 1.0
 */

?>

<?php if (!is_author()) : ?>

<div class="author-box">
    <div class="autor-avatar">
        <?php echo get_avatar( get_the_author_meta( 'ID' ) ); ?>
    </div>
    <h3>
        <?php printf('Sáng tạo bởi <a href="%1$s">%2$s</a>',  get_author_posts_url( get_the_author_meta('ID') ),  get_the_author() ); ?>
    </h3>
    <p><?php echo get_the_author_meta( 'description' ); ?></p>
</div>

<?php endif; ?>