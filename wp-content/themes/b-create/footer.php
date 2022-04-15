<?php
/**
 * The template for displaying the footer
 * 
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage B-Create_Theme
 * @since B-Create 1.0
 */

?>
			<footer id="site-footer" class="header-footer-group">

				 <!-- Sidebar -->
				 <section id="footer-sidebar" class="container">
					<?php
						if ( is_active_sidebar('footer-sidebar') ) {
							dynamic_sidebar( 'footer-sidebar' );
						}
					?>
				</section>

			</footer><!-- #site-footer -->

		<?php wp_footer(); ?>

	</body>
</html>
