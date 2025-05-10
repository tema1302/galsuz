<?php

/*-------------------------------------------------------*/
/*	[vacancy]                                            */
/*-------------------------------------------------------*/

add_shortcode("vacancy", function ($atts, $content = '') {
  remove_filter('the_content', 'wpautop');
  $html = '
  <div class="vacancy">
    <div class="text-style-text-lg-medium color-gray-900 mb-4">'.$atts['name'].'</div>
    <div class="text-style-text-md-normal color-gray-500 mb-16">' . apply_filters('the_content', $content) . '</div>
    <div class="d-flex align-center flex-wrap">
      <div class="d-flex align-center text-style-text-md-medium color-gray-500 mr-15">
        <svg class="mr-5" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M10.0001 4.99996V9.99996L13.3334 11.6666M18.3334 9.99996C18.3334 14.6023 14.6025 18.3333 10.0001 18.3333C5.39771 18.3333 1.66675 14.6023 1.66675 9.99996C1.66675 5.39759 5.39771 1.66663 10.0001 1.66663C14.6025 1.66663 18.3334 5.39759 18.3334 9.99996Z" stroke="#98A2B3" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <span>'.$atts['time'].'</span>
      </div>
      <div class="d-flex align-center text-style-text-md-medium color-gray-500">
        <svg class="mr-5" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M10 0.833374V19.1667M14.1667 4.16671H7.91667C7.14312 4.16671 6.40125 4.474 5.85427 5.02098C5.30729 5.56796 5 6.30983 5 7.08337C5 7.85692 5.30729 8.59879 5.85427 9.14577C6.40125 9.69275 7.14312 10 7.91667 10H12.0833C12.8569 10 13.5987 10.3073 14.1457 10.8543C14.6927 11.4013 15 12.1432 15 12.9167C15 13.6903 14.6927 14.4321 14.1457 14.9791C13.5987 15.5261 12.8569 15.8334 12.0833 15.8334H5" stroke="#98A2B3" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <span>'.$atts['money'].'</span>
      </div>
    </div>
  </div>';
  add_filter('the_content', 'wpautop');
  return $html;
});
