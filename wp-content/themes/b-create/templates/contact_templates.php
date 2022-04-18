<?php
/** 
 * Page template hiển thị contact form
 * @package WordPress
 * @subpackage B-Create_Theme
 * @since B-Create 1.0
 * Template Name: B-CREATE contact template
 */


get_header();
?>

<div id="contact" class="container">
    <?php echo do_shortcode( '[mwform_formkey key="1757"]' ); ?>
</div>

<?php
get_footer();