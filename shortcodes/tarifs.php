<?php

/*-------------------------------------------------------*/
/*	[tarifs]                                             */
/*-------------------------------------------------------*/

add_shortcode("tarifs", function ($atts, $content = '') {
  
  $lng = pll_current_language('locale');
  $isArchive = isset($atts['archive']) && $atts['archive'] == '1';
  $archiveCat = $lng === 'uz_UZ' ? 103 : 60;

  $opts = [
    'post_type' => 'tarif',
    'numberposts' => -1
  ];
  if ($isArchive) {
    $opts['tax_query'] = [
      [
        'taxonomy' => 'tarifcat',
        'field' => 'term_id',
        'terms' => [$archiveCat]
      ]
    ];
  } else {
    $opts['category__not_in'] = [$archiveCat];
  }

  $tarifs = get_posts($opts);

  $termOpts = [
    'taxonomy' => 'tarifcat',
  ];

  if ($isArchive) {
    $termOpts['term_taxonomy_id'] = [$archiveCat];
  }

  $tarifs_cats = get_terms($termOpts);

  if (!$isArchive) {
    $index = -1;
    foreach ($tarifs_cats as $key => $cat) {
      if ($cat->term_id === $archiveCat) {
        $index = $key;
      }
    }
    // remove from $tarifs_cats by $index
    if ($index !== -1) {
      array_splice($tarifs_cats, $index, 1);
    }
  }

  // get all custom fields for each post
  foreach ($tarifs as $key => $post) {
    $tarifs[$key]->fields = get_fields($post->ID);
    $tarifs[$key]->terms = get_the_terms($post->ID, 'tarifcat');
    $tarifs[$key]->url = get_the_permalink($post->ID);
    $tarifs[$key]->post_title = get_the_title($post->ID);
  }

  // // get terms for each post
  // foreach ($tarifs as $key => $post) {
  // }

  // // get url for each post
  // foreach ($tarifs as $key => $post) {
  // }

  $lang = [
    'tarifs-1' => esc_html__('Интернет', 'galsuz'),
    'tarifs-2' => esc_html__('Цифровое ТВ', 'galsuz'),
    'tarifs-3' => esc_html__('Все тарифы', 'galsuz'),
    'tarifs-4' => esc_html__('Рекомендуем', 'galsuz'),
    'tarifs-5' => esc_html__('сум', 'galsuz'),
    'tarifs-6' => esc_html__('мес.', 'galsuz'),
    'tarifs-7' => esc_html__('Подключить', 'galsuz'),
    'tarifs-8' => esc_html__('Подробнее о тарифе.', 'galsuz'),
    'tarifs-9' => esc_html__('Условия', 'galsuz'),
    'form-1' => esc_html__('Напишите нам', 'galsuz'),
    'form-2' => esc_html__('Наши менеджеры свяжутся <br />с Вами в ближайшее время', 'galsuz'),
    'form-3' => esc_html__('Ваше имя', 'galsuz'),
    'form-4' => esc_html__('Email', 'galsuz'),
    'form-5' => esc_html__('Контактный телефон', 'galsuz'),
    'form-6' => esc_html__('Дополнительная информация', 'galsuz'),
    'form-7' => esc_html__('Я принимаю условия обработки персональных данных', 'galsuz'),
    'form-8' => esc_html__('Подключиться', 'galsuz'),
    'form-9' => esc_html__('Cлишком короткий номер', 'galsuz'),
    'form-10' => esc_html__('Неверный формат имени', 'galsuz'),
    'form-11' => esc_html__('Неверный адрес email', 'galsuz'),
    'form-12' => esc_html__('Ваше письмо отправлено, спасибо.', 'galsuz'),
    'form-13' => esc_html__('Письмо не отправлено.', 'galsuz'),
    'form-14' => esc_html__('Давайте подключаться', 'galsuz'),
    'form-15' => esc_html__('Наши менеджеры свяжутся с Вами в ближайшее время', 'galsuz'),
    'form-16' => esc_html__('Адрес подключения', 'galsuz'),
    'form-17' => esc_html__('Район', 'galsuz'),
    'form-18' => esc_html__('Массив', 'galsuz'),
    'form-19' => esc_html__('Номер дома и квартиры', 'galsuz'),
    'form-20' => esc_html__('Выбрать', 'galsuz'),
    'form-21' => esc_html__('Не выбран район', 'galsuz'),
    'form-22' => esc_html__('Не выбран массив', 'galsuz'),
    'form-23' => esc_html__('Архивные тарифы', 'galsuz'),
  ];

  remove_filter('the_content', 'wpautop');
  $html = '
  <script>
  const tarifsData = '.json_encode($tarifs).';
  const tarifCats = '.json_encode($tarifs_cats).';
  const tarifsLang = '.json_encode($lang).';
  const currentLang = "'.$lng.'";
  </script>
  <script>
  const noscroll = '. (isset($atts['noscroll']) ? 'true' : 'false') .';
  </script>
  <div id="tarifs'.($isArchive ? 'Archive' : '').'" class="tarifs">
    <div class="allitems">
      <div class="items items length-33 pos-11 mpos-11">';
  foreach($tarifs as $tarif) {
    $html .= '
        <div class="item effect-style-shadow-lg">
          <div class="top pa-16">
            <div class="d-flex justify-between align-center mb-8">
              <div class="name text-style-text-lg-medium">'.$tarif->post_title.'</div>
            </div>
            <div class="price d-flex align-center mb-16">
              <div class="summ text-style-display-lg-semibold mr-4">'. $tarif->fields['price'] .'</div>
              <div class="txt text-style-text-sm-normal"><span>' .$lang['tarifs-5'] .'</span>
                <div class="delim"></div><span>' .$lang['tarifs-6'] .'</span>
              </div>
            </div>
            <div class="button button-xl w-100 mb-6"><span>' .$lang['tarifs-7'] .'</span></div>
            <div class="text-center">
              <a class="text-style-text-md-medium" href="'.$tarif->url.'">' .$lang['tarifs-8'] .'</a>
            </div>
          </div>
          <div class="bottom pa-16">
          ';
          foreach($tarif->fields as $key => $item) {
            $html .= '
            <div class="info d-flex align-start">
              <div class="text">'.$item.'</div>
            </div>
            ';
          }
          $html .= '  <div class="conditions pt-4 text-style-text-sm-semibold mb-2">' .$lang['tarifs-5'] .'</div>
            <div class="conditions-text text-style-text-sm-normal"> '. $tarif->fields['usloviya'] .'</div>
          </div>
        </div>
        ';
  }
  $html .='
      </div>
    </div>
  </div>';
  if (!$isArchive) {
    $html .= '
    <div class="d-flex align-center justify-between mb-12">
      <div>&nbsp;</div>
      <a class="d-flex align-center nowrap" href="' . ($lng === 'uz_UZ' ? '/uz/arxiv-tariflar/' : '/arhivnye-tarify/') . '">
        <span class="mr-8">' . $lang['form-23'] . '</span>
        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg" class="arrowUpRight small gray"><path d="M1 11L11 1M11 1H1M11 1V11" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
      </a>
    </div>
    ';
  }
  add_filter('the_content', 'wpautop');
  return $html;
});
