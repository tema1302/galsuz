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

	<main id="primary" class="page">
		<div class="container">

		<?php
		while ( have_posts() ) :
			the_post();
			?><script> window.postTitle = '<?php the_title(); ?>';</script><?php
			get_template_part( 'template-parts/content', 'page' );

		endwhile; // End of the loop.
		?>
		</div>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
