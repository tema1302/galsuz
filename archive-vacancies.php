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
			<div class="graybg pb-24">
				<div class="head d-flex flex-column align-center">
					<h1 class="text-style-display-lg-semibold color-gray-900 text-center mb-12 pt-0"><?php echo esc_html__('Наши вакансии', 'galsuz');?></h1>
					<?php
					the_archive_description( '<div class="text-style-text-xl-normal">', '</div>' );
					?>
				</div>
			</div>
				<div class="row pt-20">
					<?php

						$job_cats = get_terms([
							'taxonomy' => 'vacanciescat'
						]);

						$jobs = get_posts([
							'post_type' => 'vacancies',
							'numberposts' => -1
						]);

						$counter = 0;

						// get all custom fields for each post
						foreach ($jobs as $key => $post) {
							$jobs[$key]->fields = get_fields($post->ID);
						}

						// get terms for each post
						foreach ($jobs as $key => $post) {
							$jobs[$key]->terms = get_the_terms($post->ID, 'vacanciescat');
						}

						// get url for each post
						foreach ($jobs as $key => $post) {
							$jobs[$key]->url = get_the_permalink($post->ID);
						}


						foreach($job_cats as $cat) {

							$posts = [];

							foreach($jobs as $job) {
								if($cat->term_id == $job->terms[0]->term_id) {
									$posts[] = $job;
								}
							}

							?>
							<div class="col-12">
								<div class="row border-bottom pb-10 mb-20">
									<div class="col-12 col-md-4 pb-4">
										<div class="text-style-text-xl-medium mb-4 color-gray-900"><?php echo $cat->name; ?></div>
										<div class="w-60"><?php echo $cat->description; ?></div>
									</div>
									<div class="col-12 col-md-8">
										<?php
										foreach($posts as $post) {
											?>
												<a href="<?php echo $post->url; ?>" class="vacancy d-block mb-10">
													<div class="text-style-text-lg-medium color-gray-900 mb-4"><?php echo $post->post_title; ?></div>
													<div class="text-style-text-md-normal color-gray-500 mb-16"><?php echo $post->post_excerpt; ?></div>
													<div class="d-flex align-md-center flex-wrap flex-column flex-md-row gap-md-15 gap-5">
														<div class="d-flex align-center text-style-text-md-medium color-gray-500">
															<svg class="mr-5" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
																<path d="M10.0001 4.99996V9.99996L13.3334 11.6666M18.3334 9.99996C18.3334 14.6023 14.6025 18.3333 10.0001 18.3333C5.39771 18.3333 1.66675 14.6023 1.66675 9.99996C1.66675 5.39759 5.39771 1.66663 10.0001 1.66663C14.6025 1.66663 18.3334 5.39759 18.3334 9.99996Z" stroke="#98A2B3" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"></path>
															</svg>
															<span><?php echo $post->fields['zanyatost']; ?></span>
														</div>
														<div class="d-flex align-center text-style-text-md-medium color-gray-500">
															<!-- <svg class="mr-5" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
																<path d="M10 0.833374V19.1667M14.1667 4.16671H7.91667C7.14312 4.16671 6.40125 4.474 5.85427 5.02098C5.30729 5.56796 5 6.30983 5 7.08337C5 7.85692 5.30729 8.59879 5.85427 9.14577C6.40125 9.69275 7.14312 10 7.91667 10H12.0833C12.8569 10 13.5987 10.3073 14.1457 10.8543C14.6927 11.4013 15 12.1432 15 12.9167C15 13.6903 14.6927 14.4321 14.1457 14.9791C13.5987 15.5261 12.8569 15.8334 12.0833 15.8334H5" stroke="#98A2B3" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"></path>
															</svg> -->
															<span><?php echo $post->fields['oklad']; ?></span>
														</div>
														<div class="d-flex align-center nowrap ml-md-auto color-primary-500">
															<span class="mr-8"><?php echo esc_html__('Подробнее', 'galsuz'); ?></span>
															<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg" class="arrowUpRight small primary"><path d="M1 11L11 1M11 1H1M11 1V11" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
														</div>
													</div>
												</a>
											<?php
										}
										?>
									</div>
								</div>
							<?php
						}
				?>
				</div>
		</div>
	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
