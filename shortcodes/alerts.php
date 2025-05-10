<?php

/*-------------------------------------------------------*/
/*	[alerts]                             */
/*-------------------------------------------------------*/

add_shortcode("alerts", function ($atts, $content = '') {

  $posts = get_posts([
    'post_type' => 'alerts',
    'numberposts' => 3
  ]);

  // get all custom fields for each post
  foreach ($posts as $key => $post) {
    $posts[$key]->fields = get_fields($post->ID);
  }

  remove_filter('the_content', 'wpautop');

  $html = '

  <div class="d-flex align-center justify-between mb-12 pt-24">
    <h1>'. esc_html__('События и новости компании', 'galsuz') .'</h1>
    <a class="d-flex align-center nowrap" href="' . get_post_type_archive_link('alerts') . '">
      <span class="mr-8">'. esc_html__('Все события', 'galsuz') .'</span>
      <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg" class="arrowUpRight small gray"><path d="M1 11L11 1M11 1H1M11 1V11" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
    </a>
  </div>
  <div class="events row">';

  foreach ($posts as $key => $post) {
    $html .= '
    <div class="event col-12 col-md-4 mb-20 mb-md-0">
      <div class="date text-style-text-sm-semibold color-gray-400 mb-6">' . get_the_date('l, d F Y', $post->ID) . '</div>
      <a class="title d-flex justify-between align-center mb-6" href="' . get_permalink($post->ID) . '">
        <div class="text-style-display-xs-semibold color-gray-900">' . apply_filters('the_title', $post->post_title) . '</div>
        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg" class="arrowUpRight"><path d="M1 11L11 1M11 1H1M11 1V11" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
      </a>
      <div class="text color-gray-500 mb-12">' . get_the_excerpt($post->ID) . '</div>
    </div>
    ';
  }
  $html .= '
  </div>
  ';
  add_filter('the_content', 'wpautop');
  return $html;
});
