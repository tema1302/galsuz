<?php

/*-------------------------------------------------------*/
/*	[main-opts]                                          */
/*-------------------------------------------------------*/

add_shortcode("main-opts", function ($atts, $content = '') {
  $opts = get_option('show-main');
  // return $opts;
  // return print_r(unserialize($opts), true);
  return json_encode(unserialize($opts), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
});

?>
