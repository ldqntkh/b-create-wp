<?php

/**
 * Tạo hàm phân trang cho index, archive.
 * Hàm này sẽ hiển thị liên kết phân trang theo dạng chữ: New posts | Old posts
 * bcreate_pagination()
**/
if( !function_exists('bcreate_pagination') ) {
    function bcreate_pagination() {
        // Không hiển thị phân trang nếu trang đó có ít hơn 2 trang
        if ( $GLOBALS["wp_query"]->max_num_pages < 2 ) {
            return "";
        }

        ?>
        <nav class="pagination" role="navigation">
            <div class="prev"><?php previous_posts_link( __("Old posts", THEME_TEXT_DOMAIN) ); ?></div>
            <div class="next"><?php next_posts_link( __("New posts", THEME_TEXT_DOMAIN) ); ?></div>
        </nav>
<?php
    }
}

/**
 * Hàm hiển thị ảnh thumbnail của post.
 * Ảnh thumbnail sẽ không được hiển thị trong trang single
 * Nhưng sẽ hiển thị trong single nếu post đó có format là Image
 * bcreate_thumbnail( $size )
**/
if ( ! function_exists( "bcreate_thumbnail" ) ) {
    function bcreate_thumbnail( $size ) {
        // Chỉ hiển thumbnail với post không có mật khẩu
        if ( ! is_single() &&  has_post_thumbnail()  && ! post_password_required() || has_post_format( "image" ) ) : ?>
            <figure class="post-thumbnail"><?php the_post_thumbnail( $size ); ?></figure><?php
        endif;
    }
}

/**
 * Hàm hiển thị tiêu đề của post
 * Tiêu đề của post sẽ là nằm trong thẻ <h1> ở trang single
 * Còn ở trang chủ và trang lưu trữ, nó sẽ là thẻ <h2>
 * bcreate_post_header()
**/
if ( ! function_exists( "bcreate_post_header" ) ) {
    function bcreate_post_header() {
        if ( is_single() ) : ?>
            <h1 class="entry-title">
                <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                    <?php the_title(); ?>
                </a>
            </h1>
        <?php else : ?>
            <h2 class="entry-title">
                <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                    <?php the_title(); ?>
                </a>
            </h2>
        <?php endif;
    }
}

/**
 * Hàm hiển thị thông tin của post (Post Meta)
 * bcreate_post_meta()
**/
if( ! function_exists( "bcreate_post_meta" ) ) {
    function bcreate_post_meta() {
    if ( ! is_page() ) :
        echo "<div class='entry-meta'>";
        // Hiển thị tên tác giả, tên category và ngày tháng đăng bài
        printf( __('<span class="author">Posted by %1$s</span>', THEME_TEXT_DOMAIN), get_the_author() );
        printf( __('<span class="date-published"> at %1$s</span>', THEME_TEXT_DOMAIN), get_the_date() );
        printf( __('<span class="category"> in %1$s</span>', THEME_TEXT_DOMAIN), get_the_category_list( ", " ) );


        // Hiển thị số đếm lượt bình luận
        if ( comments_open() ) :
            echo " <span class='meta-reply'>";
            comments_popup_link(
                __("Leave a comment", THEME_TEXT_DOMAIN),
                __("One comment", THEME_TEXT_DOMAIN),
                __("% comments", THEME_TEXT_DOMAIN),
                __("Read all comments", THEME_TEXT_DOMAIN)
            );
            echo "</span>";
        endif;
        echo "</div>";
    endif;
    }
}

/*
* Thêm chữ Xem thêm vào excerpt
*/
function bcreate_readmore() {
    return '…<a class="read-more" href="'. get_permalink( get_the_ID() ) . '">' . __('Xem thêm', THEME_TEXT_DOMAIN) . '</a>';
}
add_filter( 'excerpt_more', 'bcreate_readmore' );

/**
 * Hàm hiển thị nội dung của post type
 * Hàm này sẽ hiển thị đoạn rút gọn của post ngoài trang chủ (the_excerpt)
 * Nhưng nó sẽ hiển thị toàn bộ nội dung của post ở trang single (the_content)
 * bcreate_posts_content()
**/
if ( ! function_exists( 'bcreate_posts_content' ) ) {
    function bcreate_posts_content() {
        if ( ! is_single() ) :
            the_excerpt();
        else :
            the_content();
            /*
            * Code hiển thị phân trang trong post type
            */
            $link_pages = array(
                'before' => __('<p>Trang:', THEME_TEXT_DOMAIN),
                'after' => '</p>',
                'nextpagelink'     => __( 'Trang tiếp theo', THEME_TEXT_DOMAIN ),
                'previouspagelink' => __( 'Trang trước', THEME_TEXT_DOMAIN )
            );
            wp_link_pages( $link_pages );
        endif;
    }
}

/**
 * Hiển thị breadcrumb
 * Lưu ý là ví dụ này tôi chỉ lấy category đầu tiên
 */
if( !function_exists( 'bcreate_post_breadcrumb' ) ) {
    function bcreate_post_breadcrumb( $postId = false ) {
        $cats = get_the_category( $postId );
        if( count( $cats ) > 0 ) {
            $cat = $cats[0];
            $title = get_the_title($postId);
            if( strlen( $title ) > 10 ) {
                $str = mb_substr($title, 0, 7, 'UTF-8');
                $title = utf8_decode($str) . '...'; 
            }
            // print the breadcrumb
            ob_start();
        ?>
        <ul class="breadcrumb">
            <li><a href="/"><?= __("Trang chủ", THEME_TEXT_DOMAIN) ?></a></li>
            <li><p class="ms-2 me-2">></p></li>
            <li><a href="<?= get_category_link( $cat ) ?>"><?= $cat->cat_name ?></a></li>
            <li><p class="ms-2 me-2">></p></li>
            <li><?= $title ?></li>
        </ul>
        <?php
            $content = ob_get_contents();
            ob_clean();
            ob_end_flush();
            echo $content;
        }
    }
}

/**
 * Hiển thị tag name
 */
if( !function_exists('bcreate_post_tags') ) {
    function bcreate_post_tags( $postId = false ) {
        $tags = get_the_tags($postId);
        if( count( $tags ) > 0 ) {
            ob_start();
        ?>
            <div class="tags">
                <label><?= __("Tags:", THEME_TEXT_DOMAIN) ?></label>
                <?php foreach( $tags as $tag ): ?>
                    <a class="ms-2 me-2" href="<?= get_tag_link($tag) ?>"><?= $tag->name ?></a>
                <?php    
                    endforeach;
                ?>
            </div>
        <?php
            $content = ob_get_contents();
            ob_clean();
            ob_end_flush();
            echo $content;
        }
    }
}