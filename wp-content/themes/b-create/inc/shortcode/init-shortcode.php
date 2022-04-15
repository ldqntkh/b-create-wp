<?php
/** 
 * Định nghĩa các shortcode
 * @package WordPress
 * @subpackage B-Create_Theme
 * @since B-Create 1.0
 */

if( !function_exists('display_new_post_homepage') ) {
    function display_new_post_homepage() {
        $post_query = new WP_Query(array(
            'posts_per_page' => 10,
            'post_status' => 'publish',
            'orderby' => 'publish_date'
        ));
     
        ob_start();
        if ( $post_query->have_posts() ) :
                while ( $post_query->have_posts() ) :
                    $post_query->the_post();
                    get_template_part( "content" );  
                endwhile;
        endif;
        $list_post = ob_get_contents();
    
        ob_end_clean();
     
        return $list_post;
    }
    add_shortcode( 'new_posts', 'display_new_post_homepage' );
}

