<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package galsUz
 */

get_header();
?>
<main id="primary" class="page tarifs">
		<div class="container">
				<div class="head d-flex flex-column align-center">
					<h1 class="text-style-display-lg-semibold color-gray-900 text-center mb-20"><?=__('Тарифы', 'galsuz')?></h1>
					<?php	the_archive_description( '<div class="text-style-text-xl-normal">', '</div>' ); ?>
				</div>
		</div>
		<div class="container">
			<?php echo do_shortcode('[tarifs noscroll="1"]'); ?>
		</div>
	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
