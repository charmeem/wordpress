<?php
/**
 * Displays header media
 *
 * Relevent custom-header Code is added in functions.php file
 *
 * @package WordPress
 * @subpackage Charmeem
 *
 */

?>
<div class="custom-header">

	<div class="custom-header-media">
		<?php the_custom_header_markup(); ?>
		<!-- A new template tag introduced in WP4.7 to display header image and video
		from customizer in one easy step ----->
	</div>

	<?php get_template_part( 'template-parts/header/site', 'branding' ); ?>

</div><!-- .custom-header -->
