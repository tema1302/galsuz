<?php
/**
 * Template Name: Home
 * The home template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package galsUz
 */

get_header();
?>

	<main id="primary" class="frontPage">
		<div class="container">
			<div id="slider-skeleton" style="height: 400px; border-radius: 8px; background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%); background-size: 200% 100%; animation: skeleton-loading 2.5s infinite;"></div>
			<?php 
			$code = get_locale() === 'ru_RU' ? '1033' : '1323';
			$banner = get_locale() === 'ru_RU' ? '1304' : '1439';
			echo do_shortcode('[easy-slider-revolution id="'.$code.'"]'); ?>
			<?php // echo do_shortcode('[slider category="main"]'); ?>
			<div class="row">
				<div class="col-12 col-md-6 pt-20 mt-20 home-title">
					<h1>Интернет провайдер в Ташкенте. Gals Telecom</h1>
					<h2><?php single_post_title(); ?></h2>
				</div>
			</div>
			<?php echo do_shortcode('[tarifs]'); ?>
			<?php echo do_shortcode('[alerts]'); ?>
			<?php /* echo do_shortcode('[events]'); */ ?>
			<?php echo do_shortcode('[slider load="'.$banner.'"]'); ?>
			<?php echo do_shortcode('[specials]'); ?>
			<?php echo do_shortcode('[payments]'); 
  					echo the_content();
			?>
			
			<div class="skip"></div>
		</div>
	</main><!-- #main --><script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "Service",
      "@id": "https://gals.uz/#internet-service",
      "name": "Интернет в Ташкенте от Gals Telecom",
      "provider": {
        "@type": "Organization",
        "name": "Gals Telecom",
        "url": "https://gals.uz",
        "logo": "https://gals.uz/wp-content/uploads/2022/05/logo.svg",
        "foundingDate": "2008",
        "sameAs": [
          "https://t.me/gals_uz",
          "https://www.instagram.com/gals_uz"
        ]
      },
      "areaServed": {
        "@type": "Place",
        "name": "Ташкент, Узбекистан"
      },
      "serviceType": "Домашний и корпоративный интернет",
      "description": "Gals Telecom предоставляет быстрый и стабильный интернет в Ташкенте для дома и бизнеса. Бесплатное подключение, IPTV, фильмы и музыка, честные тарифы без скрытых платежей.",
      "offers": {
        "@type": "Offer",
        "url": "https://gals.uz/special/",
        "priceCurrency": "UZS",
        "price": "от 70000",
        "eligibleRegion": {
          "@type": "Place",
          "name": "Ташкент"
        },
        "availability": "https://schema.org/InStock"
      },
      "hasOfferCatalog": {
        "@type": "OfferCatalog",
        "name": "Тарифные планы Gals Telecom",
        "itemListElement": [
          { 
            "@type": "Offer",
            "name": "Домашний интернет",
            "description": "Интернет с высокой скоростью, IPTV и бесплатным доступом к мультимедиа",
            "url": "https://gals.uz/tarif/"
          },
          {
            "@type": "Offer",
            "name": "Интернет для бизнеса",
            "description": "Индивидуальные тарифы для офисов и компаний",
            "url": "https://gals.uz/tarif/"
          }
        ]
      }
    },
    {
      "@type": "Review",
      "reviewRating": {
        "@type": "Rating",
        "ratingValue": "5",
        "bestRating": "5"
      },
      "author": {
        "@type": "Person",
        "name": "Пользователь Gals Telecom"
      },
      "reviewBody": "Самый быстрый интернет в Ташкенте, честные цены, отличная поддержка 24/7.",
      "itemReviewed": {
        "@id": "https://gals.uz/#internet-service"
      }
    }
  ]
}
</script>

<?php
get_footer();
