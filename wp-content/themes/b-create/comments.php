<?php
/** 
 * Template hiển thị comment bài viết
 * @package WordPress
 * @subpackage B-Create_Theme
 * @since B-Create 1.0
 */

if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
			$bcreate_comment_count = get_comments_number();
            printf(
                esc_html__( 'Có %1$s bình luận', THEME_TEXT_DOMAIN ),
                number_format_i18n( $bcreate_comment_count )
            );
			?>
		</h2>

		<?php the_comments_navigation(); ?>

		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'style'      => 'ol',
					'short_ping' => true,
				)
			);
			?>
		</ol>

		<?php
		the_comments_navigation();
		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', THEME_TEXT_DOMAIN ); ?></p>
			<?php
		endif;

	endif; // Check for have_comments().

	comment_form();
	?>

</div><!-- #comments -->
