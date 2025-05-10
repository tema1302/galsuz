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
<main id="primary" class="page faq archive">
		<div class="container">
			<div class="graybg">
				<div class="head d-flex flex-column align-center">
					<h1 class="text-style-display-lg-semibold color-gray-900 text-center mb-20"><?php echo esc_html__('Центр помощи и поддержки', 'galsuz');?></h1>
					<?php
					the_archive_description( '<div class="text-style-text-xl-normal">', '</div>' );
					?>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="skip"></div>
			<div class="row">
				<div class="col-12 col-md-8 col-md-offset-2">
					<div class="tags primary mb-20 flex-column flex-md-row">
						<?php
						$faqs = get_posts([
							'post_type' => 'faq',
							'numberposts' => -1
						]);

						$faqs_cats = get_terms([
							'taxonomy' => 'faqcat'
						]);

						// get all custom fields for each post
						foreach ($faqs as $key => $post) {
							$faqs[$key]->fields = get_fields($post->ID);
						}

						// get terms for each post
						foreach ($faqs as $key => $post) {
							$faqs[$key]->terms = get_the_terms($post->ID, 'faqcat');
						}

						// get url for each post
						foreach ($faqs as $key => $post) {
							$faqs[$key]->url = get_the_permalink($post->ID);
						}

						foreach($faqs_cats as $cat) {
							?>
							<div class="tag" data-id="<?php echo $cat->term_id; ?>"><span><?php echo $cat->name; ?></span>
								<div class="badge text-style-text-xs-medium"><?php echo $cat->count; ?></div>
							</div>
							<?php
						}
						?>

					</div>
					<div class="posts">
						<?php foreach($faqs as $faq):
						?>
						<a class="post d-flex justify-between align-center border radius-8 pa-12 mb-12" data-terms="[<?php $terms = []; foreach($faq->terms as $term) { $terms[] = $term->term_id; } echo join(',', $terms); ?>]" href="<?php echo $faq->url; ?>">
							<div class="text-style-text-lg-medium color-gray-900"><?php echo apply_filters('the_title', $faq->post_title); ?></div>
							<div class="goto text-style-text-md-medium color-primary-500 d-flex align-center pl-10">
								<div class="mr-8 d-none d-md-block"><?php echo esc_html__('Перейти', 'galsuz'); ?></div>
								<div class="icon"></div>
							</div>
						</a>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
