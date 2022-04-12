<?php
/** 
 * Template hiển thị nội dung của search posts
 * @package WordPress
 * @subpackage B-Create_Theme
 * @since B-Create 1.0
 */

get_header(); ?>


<div id="content" class="container">
    <div class="archive-title">
        <h2>
            <?php
                printf( esc_html__( 'Search Results for: %s', 'ivy-tsusyo' ), '<span>' . get_search_query() . '</span>' );
            ?>
        </h2>
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
