<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package galsUz
 */

get_header();
?>
	<main id="primary" class="page <?php echo get_post_type();?>">
		<div class="container">
			<?php
			while ( have_posts() ) :
				the_post();
				?><script> window.postTitle = '<?php the_title(); ?>';</script><?php
				get_template_part( 'template-parts/content', get_post_type() );
			endwhile; // End of the loop.
			?>
		</div>
	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
