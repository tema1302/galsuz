<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package galsUz
 */

 $post = get_post(get_the_ID());
 // get all custom fields for each post
 $post->fields = get_fields($post->ID);

 // get wordpress post fullsized thumbnail
 $image = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail');


?>
<div class="pt-16 mb-15 pb-17">
	<div class="head d-flex flex-column align-center">
		<div class="date color-primary-500 text-style-text-md-semibold mb-6 pt-6"><?php echo get_the_date('l, d F Y'); ?></div>
		<h1 class="d-none d-md-block text-style-display-lg-semibold color-gray-900 text-center mb-20"><?php the_title(); ?></h1>
		<h1 class="d-md-none text-style-display-md-semibold color-gray-900 text-center mb-20"><?php the_title(); ?></h1>
		<?php if ($image) { ?><div class="img lazy-bg" data-bg="<?php echo esc_url($image[0]); ?>"></div> <?php } ?>
	</div>

	<article id="post-<?php the_ID(); ?>"  class="w-100 d-flex flex-column align-center">
		<div <?php post_class('post w-100 w-xl-50 w-md-60'); ?>>
			<?php the_content(); ?>
		</div>
	</article><!-- #post-<?php the_ID(); ?> -->
	</div>
