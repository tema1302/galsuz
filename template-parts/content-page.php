<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package galsUz
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <?php 
	global $post;
	if (strpos($post->post_content, '[notitle]') === false) {
		the_title( '<h1 class="text-style-display-lg-semibold text-center">', '</h1>' );
	} ?>

	<?php galsuz_post_thumbnail(); ?>

	<div class="post">
		<?php
		the_content();
		?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
