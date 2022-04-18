<?php 
/** 
 * Template hiển thị nội dung của custom post
 * @package WordPress
 * @subpackage B-Create_Theme
 * @since B-Create 1.0
 */

get_header(); 
?>


<div id="content">
    <div class="primary-content">
        <!-- Main content -->
        <section id="main-content">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <?php 
                    get_template_part( "content", 'custom_product' ); 
                ?>
            <?php endwhile; ?>
            
            <?php else : ?>
                <?php 
                    // muốn hàm này hoạt động được bắt buộc phải có file "content.php", chính xác hơn là "content-none.php"
                    get_template_part( "content", "none" ); 
                ?>
            <?php endif; ?>
        </section>
    </div>
</div>



<?php get_footer();