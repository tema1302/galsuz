<?php

/*-------------------------------------------------------*/
/*	[specials]                             */
/*-------------------------------------------------------*/

add_shortcode("specials", function ($atts, $content = '') {

  $posts = get_posts([
    'post_type' => 'special',
    'numberposts' => 3
  ]);

  // get all custom fields for each post
  foreach ($posts as $key => $post) {
    $posts[$key]->fields = get_fields($post->ID);
  }

  remove_filter('the_content', 'wpautop');

  $html = '
  <div class="specials graybg pt-md-20" v-if="options.special">
    <div class="d-flex align-center justify-between mb-12 pt-24">
      <h1>' . __('Специальные предложения', 'galsuz') . '</h1>
      <a class="d-flex align-center nowrap" href="' . get_post_type_archive_link('special') . '">
        <span class="mr-8">' . __('Архив предложений', 'galsuz') . '</span>
        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg" class="arrowUpRight small gray"><path d="M1 11L11 1M11 1H1M11 1V11" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
      </a>
    </div>
    <div class="row">
    ';
  foreach ($posts as $key => $post) {
    $image = get_the_post_thumbnail_url($post->ID, 'large');
    $offer_schema[] = [
      "@type" => "Offer",
      "name" => apply_filters('the_title', $post->post_title),
      "description" => get_the_excerpt($post->ID),
      "url" => get_permalink($post->ID),
      "image" => $image,
      "availability" => "https://schema.org/InStock",
      "priceCurrency" => "UZS",
      "price" => $post->fields['price'] ?? "0"
    ];
    $class = '';
    $subclass = '';
    $sub2class = '';
    if (count($posts) > 3) {
      $class = 'col-md-3 length-more';
    }
    if (count($posts) === 3) {
      $class = 'col-md-4 length-3';
    }
    if (count($posts) === 2) {
      $class = 'col-md-6 length-2';
    }
    if (count($posts) === 1) {
      $class = 'length-1 d-flex flex-col flex-md-row';
      $subclass = 'w-md-33 pr-md-10';
      $sub2class = 'w-md-66';
    }
    $html .= '
      <a class="special col-12 mb-20 mb-md-0 ' . $class . '" href="' . get_permalink($post->ID) . '">
        <div class="' . $subclass . '">
          <div class="img mb-16 lazy-bg" data-bg="' . $image . '"></div>
        </div>
        <div class="' . $sub2class . '">
          <div class="title d-flex justify-between align-center mb-6">
            <div class="text-style-text-xl-normal color-gray-900">' . apply_filters('the_title', $post->post_title) . '</div>
            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg" class="arrowUpRight"><path d="M1 11L11 1M11 1H1M11 1V11" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
          </div>
          <div class="text color-gray-500 mb-12">' . get_the_excerpt($post->ID) . '</div>
        </div>
      </a>';
  }
  if (!empty($offer_schema)) {
    $html .= '<script type="application/ld+json">' . json_encode([
      "@context" => "https://schema.org",
      "@graph" => $offer_schema
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>';
  }
  $html .= '
  </div>
  </div>
  ';
  add_filter('the_content', 'wpautop');
  return $html;
});
