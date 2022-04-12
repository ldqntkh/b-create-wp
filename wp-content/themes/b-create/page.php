<?php 
/** 
 * Template hiển thị nội dung của page
 * @package WordPress
 * @subpackage B-Create_Theme
 * @since B-Create 1.0
 */


get_header(); ?>


<div id="content" class="container">
    <div class="primary-content">
        <!-- Main content -->
        <section id="main-content">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <?php 
                    // muốn hàm này hoạt động được bắt buộc phải có file "content.php", chính xác hơn là "content-$post-format.php"
                    get_template_part( "content", get_post_format() ); 
                ?>
            <?php endwhile; ?>
            
            <?php else : ?>
                <?php 
                    // muốn hàm này hoạt động được bắt buộc phải có file "content.php", chính xác hơn là "content-none.php"
                    get_template_part( "content", "none" ); 
                ?>
            <?php endif; ?>
        </section>

        <!-- Sidebar -->
        <section id="sidebar">
            <?php get_sidebar(); ?>
        </section>
    </div>
</div>



<?php get_footer();