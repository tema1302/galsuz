<?php

/*-------------------------------------------------------*/
/*	[mark]                                                 */
/*-------------------------------------------------------*/

add_shortcode("mark", function ($atts, $content = '') {
  remove_filter('the_content', 'wpautop');
  $html = '
  <div class="mark">
    <div class="mark-icon"></div>
    <div class="mark-popup">'.str_replace(array('<p>','</p>'), '', apply_filters('the_content', $content)).'</div>
  </div>';
  add_filter('the_content', 'wpautop');
  return $html;
});
/*-------------------------------------------------------*/
/*	[lr]                                                 */
/*-------------------------------------------------------*/

add_shortcode("l", function ($atts, $content = '') {
  remove_filter('the_content', 'wpautop');
  $class = (isset($atts['class'])) ? $atts['class'] : '';
  $html = '<div class="left '.$class.'">'.str_replace(array('<p>','</p>'), '', apply_filters('the_content', $content)).'</div>';
  add_filter('the_content', 'wpautop');
  return $html;
});
add_shortcode("r", function ($atts, $content = '') {
  remove_filter('the_content', 'wpautop');
  $class = (isset($atts['class'])) ? $atts['class'] : '';
  $html = '<div class="right '.$class.'">'.str_replace(array('<p>','</p>'), '', apply_filters('the_content', $content)).'</div>';
  add_filter('the_content', 'wpautop');
  return $html;
});

add_shortcode("lr", function ($atts, $content = '') {
  remove_filter('the_content', 'wpautop');
  $class = (isset($atts['class'])) ? $atts['class'] : '';
  $html = '<div class="left-right d-flex justify-between align-center '.$class.'">'.str_replace(array('<p>','</p>'), '', apply_filters('the_content', $content)).'</div>';
  add_filter('the_content', 'wpautop');
  return $html;
});

/*-------------------------------------------------------*/
/*	[accordeon]                                          */
/*-------------------------------------------------------*/


add_shortcode("accordeon", function ($atts, $content = '') {
  $title = $atts['title'];
  remove_filter('the_content', 'wpautop');
  $html = '
  <div class="accordeon-wrap">
    <div class="d-flex justify-between">
      <div class="accordeon-title">'.$title.'</div>
      <div class="accordeon-expand">'.__('Развернуть все', 'galsuz').'</div>
    </div>
    <div class="accordeon-content">
      '.str_replace(array('<p>','</p>'), '', apply_filters('the_content', $content)).'
    </div>
  </div>';
  add_filter('the_content', 'wpautop');
  return $html;
});

add_shortcode("item", function ($atts, $content = '') {
  $title = $atts['title'];
  remove_filter('the_content', 'wpautop');
  $html = '
      <div class="accordeon-item">
        <div class="accordeon-item__title"><span>'.$title.'</span></div>
        <div class="accordeon-item__content">'.str_replace(array('<p>','</p>'), '', apply_filters('the_content', $content)).'</div>
      </div>
  ';
  add_filter('the_content', 'wpautop');
  return $html;
});
