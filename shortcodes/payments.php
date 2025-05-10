<?php

/*-------------------------------------------------------*/
/*	[payments]                             */
/*-------------------------------------------------------*/

add_shortcode("payments", function ($atts, $content = '') {

  $posts = get_posts([
    'post_type' => 'payments',
    'numberposts' => -1
  ]);

  $cats = get_terms([
    'taxonomy' => 'paymentcat'
  ]);

  // get all custom fields for each post
  foreach ($posts as $key => $post) {
    $posts[$key]->fields = get_fields($post->ID);
  }

  // get terms for each post
  foreach ($posts as $key => $post) {
    $posts[$key]->terms = get_the_terms($post->ID, 'paymentcat');
  }

  remove_filter('the_content', 'wpautop');
  $html = '
  <div id="payments" class="paymentsContainer">
      <div class="row">
        <div class="col-12 col-md-6 pt-20 mt-20">
          <h1>'.__('Оплата услуг', 'galsuz').'</h1>
          <p>'.__('Оплачивайте услуги интернета, любым удобным для вас способом', 'galsuz').'</p>
        </div>
      </div>
      <div class="row">
        <div class="col-12 col-md-5 pr-0">
          <div class="border radius-8 fill-height">
            <div class="pa-10 d-flex flex-column flex-md-row align-md-center border-bottom">
              <div class="text-style-text-lg-medium color-gray-900 mb-10 mb-md-0">'.__('Способы оплаты', 'galsuz').'</div>
              <div class="ml-md-auto">
                <div class="button button-md ml-md-6 mr-md-0 mr-6" v-for="cat in paymentcat" :key="cat.id" :class="{ \'button-primary\': cat.term_id === activeCat }" @click="activeCat = cat.term_id"><span>{{ cat.name }}</span></div>
              </div>
            </div>
            <div class="payments">
              <template v-for="pay in payments">
                <div class="payment pointer px-12 py-6" v-if="pay.terms[0].term_id === activeCat" :key="pay.id" @click="makeMarker(pay.fields.pos)">
                  <div class="text-style-text-sm-normal color-gray-900" v-html="pay.post_title"></div>
                  <div class="text-style-text-sm-normal color-gray-500" v-html="pay.post_content"></div>
                </div>
              </template>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-7 d-flex align-end justify-end" v-if="payments.length > 0">
          <img class="w-100" v-show="activeCat !== 20 && activeCat !== 113" src="'.get_template_directory_uri().'/assets/images/payments-online.jpg"/>
          <y-map :location="location"  v-show="activeCat === 20 || activeCat === 113">
            <y-map-default-scheme-layer></y-map-default-scheme-layer>
            <y-map-default-features-layer></y-map-default-features-layer>
            <y-map-marker v-if="marker" :coordinates="marker"><img class="ymap-marker" src="'.get_template_directory_uri().'/assets/images/map-pin.png" /></y-map-marker>
          </y-map>
        </div>
      </div>
  </div>
  <script>
  const payments = '.json_encode($posts, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE).';
  const paymentcat = '.json_encode($cats, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE).';
  </script>

  ';
  add_filter('the_content', 'wpautop');
  return $html;
});
