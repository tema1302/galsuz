<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package galsUz
 */
get_header();
?>
	<main id="primary" class="page error-404">
		<div class="container">
			<div class="pt-16 mb-15 pb-17">
				<div class="head d-flex flex-column align-center">
					<h1 class="d-none d-md-block text-style-display-lg-semibold color-gray-900 text-center mb-20"><? echo esc_html__('Ничего не найдено', 'galsuz'); ?></h1>
					<h1 class="d-md-none text-style-display-md-semibold color-gray-900 text-center mb-20"><? echo esc_html__('Ничего не найдено', 'galsuz'); ?></h1>
				</div>

				<article class="w-100 d-flex flex-column align-center">
					<div class="post w-100 w-xl-50 w-md-60 text-center">
						<? echo esc_html__('Извините, страница, которую вы попытались открыть, не существует.', 'galsuz'); ?>
					</div>
				</article>
			</div>
		</div>
	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
