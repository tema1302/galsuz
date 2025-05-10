<?php

/*-------------------------------------------------------*/
/*	[row]                                                 */
/*-------------------------------------------------------*/

add_shortcode("row", function ($atts, $content = '') {
  $class = (isset($atts['class'])) ? $atts['class'] : '';
  remove_filter('the_content', 'wpautop');
  $html = '
  <div class="row ' . $class . '">' . apply_filters('the_content', $content) . '</div>';
  add_filter('the_content', 'wpautop');
  return $html;
});

/*-------------------------------------------------------*/
/*	[col]                                                 */
/*-------------------------------------------------------*/

add_shortcode("col", function ($atts, $content = '') {
  $class = (isset($atts['class'])) ? $atts['class'] : '';
  $size = (isset($atts['size'])) ? '-' . $atts['size'] : '';
  $md = (isset($atts['md'])) ? 'col-md-' . $atts['md'] : '';
  $lg = (isset($atts['lg'])) ? 'col-lg-' . $atts['lg'] : '';
  remove_filter('the_content', 'wpautop');
  $html = '
  <div class="col' . $size . ' '.$md.' '.$lg.' ' . $class . '">' . apply_filters('the_content', $content) . '</div>';
  add_filter('the_content', 'wpautop');
  return $html;
});

/*-------------------------------------------------------*/
/*	[gray]                                                 */
/*-------------------------------------------------------*/

add_shortcode("gray", function ($atts, $content = '') {
  $intens = (isset($atts['intens'])) ? $atts['intens'] : '500';
  remove_filter('the_content', 'wpautop');
  $html = '
  <div class="color-gray-' . $intens . '">' . apply_filters('the_content', $content) . '</div>';
  add_filter('the_content', 'wpautop');
  return $html;
});

/*-------------------------------------------------------*/
/*	[primary]                                            */
/*-------------------------------------------------------*/

add_shortcode("primary", function ($atts, $content = '') {
  $intens = (isset($atts['intens'])) ? $atts['intens'] : '500';
  remove_filter('the_content', 'wpautop');
  $html = '
  <div class="color-primary-' . $intens . '">' . apply_filters('the_content', $content) . '</div>';
  add_filter('the_content', 'wpautop');
  return $html;
});

/*-------------------------------------------------------*/
/*	[half]                                            */
/*-------------------------------------------------------*/

add_shortcode("half", function ($atts, $content = '') {
  $position = "";
  if (isset($atts['position'])) {
    switch ($atts['position']) {
      case "left":
        $position = "justify-start";
        break;
      case "center":
        $position = "justify-center";
        break;
      case "right":
        $position = "justify-end";
        break;
    }
  }
  $html = '
  <div class="d-flex ' . $position . '"><div class="w-md-50 w-100">' . apply_filters('the_content', $content) . '</div></div>';
  return $html;
});
/*-------------------------------------------------------*/
/*	[div]                                            */
/*-------------------------------------------------------*/

add_shortcode("div", function ($atts, $content = '') {
  $class = (isset($atts['class'])) ? $atts['class'] : '';
  $id = (isset($atts['id'])) ? "id='".$atts['id']."' " : '';
  remove_filter('the_content', 'wpautop');
  $html = '
  <div class="' . $class . '" '.$id.'>' . apply_filters('the_content', $content) . '</div>';
  add_filter('the_content', 'wpautop');
  return $html;
});

/*-------------------------------------------------------*/
/*	[graybg]                                            */
/*-------------------------------------------------------*/

add_shortcode("graybg", function ($atts, $content = '') {
  $class = (isset($atts['class'])) ? $atts['class'] : '';
  $html = '
  <div class="graybg ' . $class . '">' . apply_filters('the_content', $content) . '</div>';
  return $html;
});

/*-------------------------------------------------------*/
/*	[notitle]                                            */
/*-------------------------------------------------------*/

add_shortcode("notitle", function ($atts=[], $content = '') {
  return "<!--notitle-->";
});

/*-------------------------------------------------------*/
/*	[banner]                                            */
/*-------------------------------------------------------*/

add_shortcode("banner", function ($atts=[], $content = '') {
  return "<!--banner load='".$atts['load']."'-->";
});

/*-------------------------------------------------------*/
/*	[slider]                                            */
/*-------------------------------------------------------*/

add_shortcode("slider", function ($atts=[], $content = '') {
  return "<!--slider load='".$atts['load']."'-->";
});
