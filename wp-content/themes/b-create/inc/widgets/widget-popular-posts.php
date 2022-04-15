<?php
/** 
 * Create widget Popular Post
 * @package WordPress
 * @subpackage B-Create_Theme
 * @since B-Create 1.0
 */


class BCREATE_PopularPosts extends WP_Widget {
 
    public function __construct() {
        parent::__construct (
            'popular_posts', // id của widget
            'Popular Posts', // tên của widget
       
            array(
                'description' => 'Widget hiển thị danh sách bài viết nổi bật' // mô tả
            )
        );
    }
 
    public function form( $instance ) {
        parent::form( $instance );
        parent::form( $instance );
 
        //Biến tạo các giá trị mặc định trong form
        $default = array(
            'display_limit' => 10,
            'header_title' => __('Popular Posts', THEME_TEXT_DOMAIN)
        );
 
        //Gộp các giá trị trong mảng $default vào biến $instance để nó trở thành các giá trị mặc định
        $instance = wp_parse_args( (array) $instance, $default);
 
        //Tạo biến riêng cho giá trị mặc định trong mảng $default
        $display_limit = esc_attr( $instance['display_limit'] );
        $header_title = esc_attr( $instance['header_title'] );
 
        //Hiển thị form trong option của widget
        echo "<p> " . __("Số Posts hiển thị", THEME_TEXT_DOMAIN) 
                . " <input class='widefat' type='number' name='".$this->get_field_name('display_limit')."' value='".$display_limit."' /></p>";
        echo "<p>" . __("Tiêu đề", THEME_TEXT_DOMAIN) 
                . " <input class='widefat' type='text' name='".$this->get_field_name('header_title')."' value='".$header_title."' /></p>";
    }
 
    public function update( $new_instance, $old_instance ) {
        parent::update( $new_instance, $old_instance );
 
        $instance = $old_instance;
        $instance['display_limit'] = strip_tags($new_instance['display_limit']);
        $instance['header_title'] = strip_tags($new_instance['header_title']);

        return $instance;
    }

    public function widget( $args, $instance ) {
        extract( $args );
        // $title = apply_filters( 'widget_title', $instance['title'] );
        $display_limit = esc_attr( $instance['display_limit'] );
        $header_title = esc_attr( $instance['header_title'] );

        $post_query = new WP_Query(array(
            'posts_per_page' => $display_limit,
            'orderby' => 'comment_count',
            'order' => 'DESC'
        ));
     
        ob_start();
        if ( $post_query->have_posts() ) :
                while ( $post_query->have_posts() ) :
                    $post_query->the_post(); 
                ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <div class="entry-thumbnail">
                            <?php bcreate_thumbnail("thumbnail") ?>
                        </div>

                        <div class="post-content">
                            <p class="entry-title">
                                <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </p>
                        </div>
                    </article>
                <?php
                endwhile;
        endif;

        $list_post = ob_get_contents();
    
        ob_end_clean();

        echo $before_widget;

        // Nội dung trong widget

        if( !empty( $header_title ) ) {
            echo "<h2 class='widget-title'>$header_title</h2>";
        }
        
        echo $list_post;
 
        // Kết thúc nội dung trong widget
 
        echo $after_widget;
    }
}
 
?>