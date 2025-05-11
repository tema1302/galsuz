<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package galsUz
 */
?>

<footer>
	<div class="top">
		<div class="container">
			<div class="row">
				<div class="col-12 col-md-4">
					<?php echo get_post_content_by_slug('footer-phones'); ?>
				</div>
				<div class="col-12 col-md-8">
					<div class="row">

						<?php
						$menu_name = 'Footer';
						$locations = get_nav_menu_locations();
						$menu = '';

						if ($locations && isset($locations[$menu_name])) {
							// получаем элементы меню
							$menu_items = wp_get_nav_menu_items($locations[$menu_name]);

							$menu_data = [];
							foreach ((array) $menu_items as $menu_item) {
								if ($menu_item->menu_item_parent == "0") {
									$menu_data["" . $menu_item->ID] = $menu_item;
								} else {
									if (!isset($menu_data["" . $menu_item->menu_item_parent]->children)) $menu_data["" . $menu_item->menu_item_parent]->children = [];
									$menu_data["" . $menu_item->menu_item_parent]->children[] = $menu_item;
								}
							}

							// выводим меню
							foreach ($menu_data as $key => $menu_item) {
								$menu .= '<div class="col-12 col-md-3"><div class="text-style-text-sm-semibold mb-8">' . $menu_item->title . '</div>';
								if (isset($menu_item->children)) {
									foreach ($menu_item->children as $key => $submenu_item) {
										$menu .= '
											<a href="' . $submenu_item->url . '" class="d-block mb-6">' . $submenu_item->title . '</a>';
									}
								}
								$menu .= '</div>';
							}
							$menu .= '';
						}

						echo $menu;
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="bottom">
		<div class="container">
			<div class="d-flex align-center justify-between">
				<div class="text-style-text-md-normal">© <?php echo date('Y'); ?> Gals Telecom. <?=esc_html__('Все права защищены.', 'galsuz')?></div>
				<div class="d-flex align-center"><a href="https://t.me/galstelecom" class="social"><img loading="lazy" alt="icon" decoding="async" src="<?php echo get_template_directory_uri(); ?>/assets/images/tg.svg"></a><br>
					<a href="https://www.facebook.com/GalsTelecom/" class="social"><img loading="lazy" alt="icon" decoding="async" src="<?php echo get_template_directory_uri(); ?>/assets/images/social/fb.svg"></a><br>
					<a href="https://www.instagram.com/galstelecom/" class="social"><img loading="lazy" alt="icon" decoding="async" src="<?php echo get_template_directory_uri(); ?>/assets/images/insta.svg"></a>
				</div>
			</div>
		</div>
	</div>

	<script>
  document.addEventListener("DOMContentLoaded", function () {
    const lazyBackgrounds = document.querySelectorAll(".lazy-bg")

    if ("IntersectionObserver" in window) {
      const observer = new IntersectionObserver((entries, obs) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            const el = entry.target
            const bg = el.getAttribute("data-bg")
            if (bg) el.style.backgroundImage = `url('${bg}')`
            obs.unobserve(el)
          }
        })
      })

      lazyBackgrounds.forEach(el => observer.observe(el))
    } else {
      // fallback
      lazyBackgrounds.forEach(el => {
        const bg = el.getAttribute("data-bg")
        if (bg) el.style.backgroundImage = `url('${bg}')`
      })
    }

		const slider = document.querySelector('.owl-carousel.sa_owl_theme');
    const skeleton = document.getElementById('slider-skeleton');

    const observer = new MutationObserver(() => {
      if (slider && slider.offsetHeight > 0) {
        skeleton.style.display = 'none';
        observer.disconnect();
      }
    });

    observer.observe(document.body, { childList: true, subtree: true });
  })
</script>
</footer>

<?php wp_footer(); ?>
</div>
</body>

</html>
