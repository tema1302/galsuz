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
<main id="primary" class="page alerts">
		<div class="container">
				<div class="head d-flex flex-column align-center graybg mb-20">
					<!-- <div class="date color-primary-500 text-style-text-md-semibold"><?php echo esc_html__('Пресс-центр', 'galsuz');?></div> -->
					<h1 class="text-style-display-lg-semibold color-gray-900 text-center mb-20 pt-10"><?php echo esc_html__('События и новости компании', 'galsuz');?></h1>
				</div>
				<div class="row">
					<?php
						$counter = 0;
						while(have_posts()):
							$counter++;
							the_post();
					?>
						<div class="alert col-12 col-md-6 col-md-offset-3 mb-16">
								<div class="date text-style-text-sm-semibold color-gray-400 mb-6"><?php echo get_the_date('d F Y'); ?></div>
								<a class="title d-flex justify-between align-center mb-6" href="<?php the_permalink(); ?>">
									<div class="text-style-display-xs-semibold color-gray-900"><?php the_title(); ?></div>
									<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg" class="arrowUpRight">
										<path d="M1 11L11 1M11 1H1M11 1V11" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
									</svg>
								</a>
								<div class="text color-gray-500"><?php the_excerpt(); ?></div>
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
