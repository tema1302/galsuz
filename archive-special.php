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
<main id="primary" class="page specials">
		<div class="container">
				<div class="head d-flex flex-column align-center">
					<h1 class="text-style-display-lg-semibold color-gray-900 text-center mb-20"><?php echo esc_html__('Все акции и предложения', 'galsuz'); ?></h1>
				</div>
				<div class="row">
					<?php
						$counter = 0;
						while(have_posts()):
							$counter++;
							the_post();
							$image = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail')[0];
					?>
						<div class="col-12 <?php echo $counter < 3 ? 'col-md-6 mb-15 mb-md-25 pb-md-7' : 'col-md-4 mb-15 mb-md-24'; ?>">
							<div class="special">
								<div class="img mb-16 lazy-bg" data-bg="<?php echo esc_url($image); ?>"></div>
								<div class="date text-style-text-sm-semibold color-gray-400 mb-6"><?php echo get_the_date('d F Y'); ?></div>
								<a class="title d-flex justify-between align-center mb-6" href="<?php the_permalink(); ?>">
									<div class="text-style-display-xs-semibold color-gray-900"><?php the_title(); ?></div>
									<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg" class="arrowUpRight">
										<path d="M1 11L11 1M11 1H1M11 1V11" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
									</svg>
								</a>
								<div class="text color-gray-500"><?php the_excerpt(); ?></div>
							</div>
						</div>
					<?php endwhile; ?>
				</div>
				<?php the_posts_pagination([
					'prev_text' => esc_html__('Назад', 'galsuz'),
					'next_text' => esc_html__('Далее', 'galsuz'),
					'class' => 'pager'
				]); ?>
		</div>
	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
