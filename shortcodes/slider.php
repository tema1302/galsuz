<?php

/*-------------------------------------------------------*/
/*	[slider category="main"]                             */
/*-------------------------------------------------------*/

add_shortcode("slider", function ($atts, $content = '') {
  $category = (isset($atts['category'])) ? $atts['category'] : '';
  $load = (isset($atts['load'])) ? $atts['load'] : false;

  $conf = [];
  $posts = [];
  if ($load) {
    $posts = [get_post((int) $load)];
  } else {
    $conf = [
      'orderby' => 'meta_value_num',
      'order' => 'ASC',
      'meta_key' => 'order',
      'tax_query' => [
        [
          'taxonomy' => 'slidercat',
          'field' => 'slug',
          'terms' => sanitize_title($category)
        ]
      ],
      'post_type' => 'slider',
    ];
    $posts = get_posts($conf);
  }

  // get all custom fields for each post
  foreach ($posts as $key => $post) {
    $posts[$key]->fields = get_fields($post->ID);
  }

  remove_filter('the_content', 'wpautop');
  // generate unique id
  $id = 'slider' . uniqid();

  $html = '
  <div id="'.$id.'"><slider :slides="sliderData"></slider></div>
  <script>
  const sliderData'.$id.' = '.json_encode($posts, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE).';
  </script>
  <script>
    if (!window.sliderLayer) window.sliderLayer = [];
    window.sliderLayer.push(() => {
      const slider'.$id.' = Vue.createApp({
        data() {
          return {
            sliderData: sliderData'.$id.'
          }
        }
      })
      slider'.$id.'.component(\'Banner\', bannerComponent)
      slider'.$id.'.component(\'slider\', sliderComponent)
      slider'.$id.'.use(vueTouchEvents)
      slider'.$id.'.mount("#'.$id.'")
    })
  </script>
  ';
  add_filter('the_content', 'wpautop');
  return $html;
});
