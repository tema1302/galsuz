<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package galsUz
 */

?>
<div class="graybg pb-24">
	<div class="head d-flex flex-column align-center">
		<h1 class="text-style-display-lg-semibold color-gray-900 text-center mb-12 pt-0">
			<?php echo esc_html__('Наши вакансии', 'galsuz'); ?>
		</h1>
		<div class="text-style-text-xl-normal"><?php echo esc_html__('Ищем людей в команду Gals Telecom', 'galsuz'); ?></div>
	</div>
</div>
<article id="post-<?php the_ID(); ?>" <?php post_class('post pt-24'); ?>>
	<div class="vacancy mx-auto" style="max-width: 768px;">
		<div class="text-style-display-sm-bold mb-20 color-gray-900"><?php the_title(); ?></div>
		<?php
		the_content();
		?>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
</div>
<div class="row">
	<div class="col-12 col-md-6 col-md-offset-3">
		<?php echo do_shortcode('[form]'); ?>
	</div>

