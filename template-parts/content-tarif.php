<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package galsUz
 */

?>
<div class="pt-16 mb-15 pb-17">
	<?php
	// generate unique id
	$id = 'banner' . uniqid();

	$post = get_post(get_the_ID());
	// get all custom fields for each post
  $post->fields = get_fields($post->ID);
	$post->post_title = get_the_title($post->ID);

	// get wordpress post fullsized thumbnail
	$post->fields['image']['url'] = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' )[0];

	$html = '
	<div id="'.$id.'"><banner :data="slide"></banner></div>
	<script>
	const bannerData'.$id.' = '.json_encode($post, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE).';
	</script>
	<script>
		if (!window.bannerLayer) window.bannerLayer = [];
		window.bannerLayer.push(() => {
			const banner'.$id.' = Vue.createApp({
				data() {
					return {
						post: bannerData'.$id.'
					}
				},
				computed: {
					slide() {
						if (!this.post) return {}
						let subtitle = \'\'
						for (const item of this.post.items) {
							subtitle += `
							<div class="info d-flex align-start">
								<img loading="lazy" alt="icon" src="${item.icon}" class="icon" />
								<div class="text">${item.text}</div>
							</div>`
						}
						const data = {...this.post}
						data.fields.align = \'left\'
						data.fields.valign = \'v-center\'
						data.fields.type = \'dark\'
						data.fields.title = this.post.post_title
						data.fields.image = this.post.fields.image
						data.fields.margin = \'mb-8\'
						data.fields.subtitle = subtitle
						console.log(data)
						return data
					},
				},
				beforeMount() {
					this.post.items = []
					if (this.post.fields.internet !== \'\')
						this.post.items.push({
							icon: \''.get_template_directory_uri().'/assets/images/tarif-icons/internet-light.svg\',
							text: this.post.fields.internet,
						})
					if (this.post.fields[\'tas-ix\'] !== \'\')
						this.post.items.push({
							icon: \''.get_template_directory_uri().'/assets/images/tarif-icons/hard-light.svg\',
							text: this.post.fields[\'tas-ix\'],
						})
					if (this.post.fields.iptv !== \'\')
						this.post.items.push({
							icon: \''.get_template_directory_uri().'/assets/images/tarif-icons/iptv-light.svg\',
							text: this.post.fields.iptv,
						})
				}
			})
			banner'.$id.'.component(\'Banner\', bannerComponent)
			banner'.$id.'.mount("#'.$id.'")
		})
	</script>
	';

	echo $html;
	?>
</div>
<article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
	<?php
		the_content();
	?>
</article><!-- #post-<?php the_ID(); ?> -->
<div class="row">
	<div class="col-12 col-md-6 col-md-offset-3">
		<?php echo do_shortcode('[form-connect]');?>
	</div>
</div>
