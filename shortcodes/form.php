<?php

/*-------------------------------------------------------*/
/*	[form]                                               */
/*-------------------------------------------------------*/

add_shortcode("form", function ($atts=[], $content = '') {
  remove_filter('the_content', 'wpautop');
  // generate unique id
  $id = 'form' . uniqid();

  $html = '
  <div class="pt-md-16">
    <div id="'.$id.'"><simple-form></simple-form></div>
  </div>
  <script>
    if (!window.simpleFormLayer) window.simpleFormLayer = [];
    window.simpleFormLayer.push(() => {
      const simpleForm'.$id.' = Vue.createApp({
        data() {
          return {
          }
        }
      })
      simpleForm'.$id.'.component(\'SimpleForm\', simpleForm)
      simpleForm'.$id.'.use(VueTheMask)
      simpleForm'.$id.'.mount("#'.$id.'")
    })
  </script>
  ';
  add_filter('the_content', 'wpautop');

  return $html;
});

/*-------------------------------------------------------*/
/*	[form-connect]                                       */
/*-------------------------------------------------------*/

add_shortcode("form-connect", function ($atts=[], $content = '') {

  
  remove_filter('the_content', 'wpautop');
  // generate unique id
  $id = 'form' . uniqid();

  $html = '
  <div id="'.$id.'"><tarif-form></tarif-form></div>
  <script>
    if (!window.tarifFormLayer) window.tarifFormLayer = [];
    window.tarifFormLayer.push(() => {
      const tarifForm'.$id.' = Vue.createApp({
        data() {
          return {
          }
        }
      })
      tarifForm'.$id.'.component(\'TarifForm\', tarifForm)
      tarifForm'.$id.'.use(VueTheMask)
      tarifForm'.$id.'.mount("#'.$id.'")
    })
  </script>
  ';
  add_filter('the_content', 'wpautop');

  return $html;
});

/*-------------------------------------------------------*/
/*	[form-connect-yur]                                   */
/*-------------------------------------------------------*/

add_shortcode("form-connect-yur", function ($atts=[], $content = '') {

  remove_filter('the_content', 'wpautop');
  // generate unique id
  $id = 'form' . uniqid();

  $html = '
  <div id="'.$id.'"><tarif-form :yur="true"></tarif-form></div>
  <script>
    if (!window.tarifFormLayer) window.tarifFormLayer = [];
    window.tarifFormLayer.push(async () => {
      const tarifForm'.$id.' = Vue.createApp({
        data() {
          return {
          }
        }
      })
      tarifForm'.$id.'.component(\'TarifForm\', tarifForm)
      tarifForm'.$id.'.use(VueTheMask)
      tarifForm'.$id.'.mount("#'.$id.'")
    })
  </script>
  ';
  add_filter('the_content', 'wpautop');

  return $html;
});
