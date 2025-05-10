<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package galsUz
 */

?>
<div class="skip"></div>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="head d-flex flex-column align-center">
		<?php
			the_title( '<h1 class="d-none d-md-block text-style-display-lg-semibold color-gray-900 text-center mb-20">', '</h1>' );
			the_title( '<h1 class="d-md-none text-style-display-md-semibold color-gray-900 text-center mb-20">', '</h1>' );

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				galsuz_posted_on();
				galsuz_posted_by();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->
	<div class="w-100 d-flex flex-column align-center">
		<div class="post w-100 w-xl-50 w-md-60">
		<?php
		the_content();
		?>
		</div>
	</div><!-- .entry-content -->
	<div class="skip"></div>
</article><!-- #post-<?php the_ID(); ?> -->
