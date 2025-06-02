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
          <img loading="lazy" alt="Онлайн-оплата интернета в Ташкенте через Gals Telecom" class="w-100" v-show="activeCat !== 20 && activeCat !== 113" src="'.get_template_directory_uri().'/assets/images/payments-online.jpg"/>
          <y-map :location="location"  v-show="activeCat === 20 || activeCat === 113">
            <y-map-default-scheme-layer></y-map-default-scheme-layer>
            <y-map-default-features-layer></y-map-default-features-layer>
            <y-map-marker v-if="marker" :coordinates="marker"><img loading="lazy" alt="map-pin" class="ymap-marker" src="'.get_template_directory_uri().'/assets/images/map-pin.png" /></y-map-marker>
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
<section itemscope itemtype="https://schema.org/ReviewAction">
  <h2>💬 Оставьте отзыв о Gals Telecom — нам важно ваше мнение!</h2>
  <p itemprop="description">
    Если вы довольны качеством <strong>интернета в Ташкенте</strong> от <span itemprop="agent" itemscope itemtype="https://schema.org/Organization"><span itemprop="name">Gals Telecom</span></span>,
    поделитесь этим! Ваш отзыв поможет нам стать лучше и поможет другим пользователям сделать правильный выбор. Положительный отзыв — это не просто благодарность. Это вклад в развитие интернет провайдеров. Чем больше хороших отзывов, тем больше клиентов узнают о честном и быстром интернете в Ташкенте.

  </p>

  <ul class="review-links" style="display: flex; flex-wrap: wrap; gap: 20px; list-style: none; padding: 0;">
    <li style="flex: 1 1 200px; text-align: center;">
      <a href="https://yandex.ru/maps/org/gals_telecom/1685623947/" target="_blank" rel="noopener nofollow" itemprop="target">
        <img src="https://yastatic.net/s3/mapsfrontend/logo/maps-logo.svg" alt="Оставить отзыв на Яндекс Картах" width="150">
        <p>Оставьте отзыв на Яндекс Картах</p>
      </a>

      <div style="width:360px;height:500px;overflow:hidden;position:relative;"><iframe style="width:100%;height:100%;border:1px solid #e6e6e6;border-radius:8px;box-sizing:border-box" src="https://yandex.ru/maps-reviews-widget/1685623947?comments"></iframe><a href="https://yandex.ru/maps/org/gals_telecom/1685623947/" target="_blank" style="box-sizing:border-box;text-decoration:none;color:#b3b3b3;font-size:10px;font-family:YS Text,sans-serif;padding:0 20px;position:absolute;bottom:8px;width:100%;text-align:center;left:0;overflow:hidden;text-overflow:ellipsis;display:block;max-height:14px;white-space:nowrap;padding:0 16px;box-sizing:border-box">Gals Telecom на карте Ташкента — Яндекс Карты</a></div>
    </li>
    <li style="flex: 1 1 200px; text-align: center;">
      <a href="https://go.2gis.com/18yg5" target="_blank" rel="noopener nofollow" itemprop="target">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/3e/2GIS_logo.svg/2560px-2GIS_logo.svg.png" alt="Оставить отзыв в 2ГИС" width="150">
        <p>Оставьте отзыв в 2ГИС</p>
      </a>
    </li>

    <li style="flex: 1 1 200px; text-align: center;">
      <a href="https://maps.app.goo.gl/hXiGvrgQmzkG8gQw7" target="_blank" rel="noopener nofollow" itemprop="target">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9b/Google_Maps_Logo_2020.svg/2560px-Google_Maps_Logo_2020.svg.png" alt="Оставить отзыв в Google Maps" width="150">
        <p>Оставьте отзыв в Google Maps</p>
      </a>
    </li>

  </ul>
</section>



});
