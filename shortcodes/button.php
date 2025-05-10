<?php

/*-------------------------------------------------------*/
/*	[button-group]                                       */
/*-------------------------------------------------------*/

add_shortcode("button-group", function ($atts, $content = '') {
  $class = (isset($atts['class'])) ? $atts['class'] : '';
  remove_filter('the_content', 'wpautop');
  $html = '
  <div class="button-group '.$class.'">'. apply_filters('the_content', $content).'</div>';
  add_filter ('the_content','wpautop');
  return $html;
});

/*-------------------------------------------------------*/
/*	[button]                                       */
/*-------------------------------------------------------*/

add_shortcode("button", function ($atts, $content = '') {
  $class = (isset($atts['class'])) ? $atts['class'] : '';
  $href = (isset($atts['href'])) ? $atts['href'] : '#';
  remove_filter('the_content', 'wpautop');
  $html = '<a class="button button-simple '.$class.'" href="'.$href.'">'. apply_filters('the_content', $content).'</a>';
  add_filter ('the_content','wpautop');
  return $html;
});
