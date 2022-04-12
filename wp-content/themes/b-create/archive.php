<?php 
/** 
 * Template hiển thị nội dung của archive
 * @package WordPress
 * @subpackage B-Create_Theme
 * @since B-Create 1.0
 */


get_header(); ?>


<div id="content" class="container">
    <div class="archive-title">
        <h2>
            <?php
                /**
                 * Hiển thị nội dung tiêu đề, description nếu có của archive
                 * ở đây tôi có sử dụng các hàm điều kiện để kiểm tra xem trang hiện tại là tags hay categories...
                 */
                if ( is_tag() ) :  single_tag_title( "", true );
                elseif ( is_category() ) :  single_cat_title( "", true );
                elseif ( is_day() ) :
					printf( __("Daily Archives: %1$s", THEME_TEXT_DOMAIN), the_time("l, F j, Y") );
				elseif ( is_month() ) :
					printf( __("Monthly Archives: %1$s", THEME_TEXT_DOMAIN), the_time("F Y") );
				elseif ( is_year() ) :
					printf( __("Yearly Archives: %1$s", THEME_TEXT_DOMAIN), the_time("Y") );
				endif;
            ?>
        </h2>
        <?php if ( is_tag() || is_category() ) : ?>
            <div class="archive-description">
                <?php echo term_description(); ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Main content -->
    <section id="main-content">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<?php 
                // muốn hàm này hoạt động được bắt buộc phải có file "content.php", chính xác hơn là "content-$post-format.php"
                get_template_part( "content", get_post_format() ); 
            ?>
		<?php endwhile; ?>
		<?php bcreate_pagination(); ?>
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

<?php get_footer();