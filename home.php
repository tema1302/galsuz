<?php
/**
 * Template Name: Home
 * The home template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package galsUz
 */

get_header();
?>

	<main id="primary" class="frontPage">
		<div class="container">
			<div id="slider-skeleton" style="height: 400px; background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%); background-size: 200% 100%; animation: skeleton-loading 1.5s infinite;">
</div>
			<?php 
			$code = get_locale() === 'ru_RU' ? '1033' : '1323';
			$banner = get_locale() === 'ru_RU' ? '1304' : '1439';
			echo do_shortcode('[easy-slider-revolution id="'.$code.'"]'); ?>
			<?php // echo do_shortcode('[slider category="main"]'); ?>
			<div class="row">
				<div class="col-12 col-md-6 pt-20 mt-20 home-title">
					<h1>Интернет провайдер в Ташкенте. Gals Telecom</h1>
					<h2><?php single_post_title(); ?></h2>
				</div>
			</div>
			<?php echo do_shortcode('[tarifs]'); ?>
			<?php echo do_shortcode('[alerts]'); ?>
			<?php /* echo do_shortcode('[events]'); */ ?>
			<?php echo do_shortcode('[slider load="'.$banner.'"]'); ?>
			<?php echo do_shortcode('[specials]'); ?>
			<?php echo do_shortcode('[payments]'); ?>
			<div class="skip"></div>
		</div>
	</main><!-- #main -->

<?php
get_footer();
