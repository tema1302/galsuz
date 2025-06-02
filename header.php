<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package galsUz
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
  <meta data-n-head="1" name="theme-color" content="#FE5A01">
  <meta data-n-head="1" name="msapplication-config" content="/browserconfig.xml">
  <meta data-n-head="1" name="msapplication-TileColor" content="#FE5A01">
  <link data-n-head="1" rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
  <link data-n-head="1" rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link data-n-head="1" rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
  <link data-n-head="1" rel="icon" type="image/x-icon" href="/favicon.ico">
  <link data-n-head="1" rel="manifest" href="/site.webmanifest">
  <link rel="profile" href="https://gmpg.org/xfn/11">
  <script src="https://api-maps.yandex.ru/v3/?apikey=a727668a-6504-46ae-9813-809720903b90&lang=ru_RU"></script>
  <style>
    html {
      font-family: sans-serif;
    }
  </style>
  <?php wp_head(); ?>
  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-L2923931W8"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-L2923931W8');
  </script>
  <script>
    <?php
    $lang = [
      'form-1' => esc_html__('Напишите нам', 'galsuz'),
      'form-2' => esc_html__('Наши менеджеры свяжутся с Вами в ближайшее время', 'galsuz'),
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

    $lng = [
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
      'form-2' => esc_html__('Наши менеджеры свяжутся с Вами в ближайшее время', 'galsuz'),
      'form-3' => esc_html__('Ваше имя', 'galsuz'),
      'form-4' => esc_html__('Email', 'galsuz'),
      'form-5' => esc_html__('Контактный телефон', 'galsuz'),
      'form-6' => esc_html__('Дополнительная информация', 'galsuz'),
      'form-7' => esc_html__('Я принимаю условия обработки персональных данных', 'galsuz'),
      'form-8' => esc_html__('Подключиться', 'galsuz'),
      'form-82' => esc_html__('Отправить', 'galsuz'),
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
    ];
    ?>

    window.tarifsFormLang = <? echo json_encode($lang); ?>;
    window.simpleFormLang = <? echo json_encode($lng); ?>;
    window.lang = '<?=get_locale()?>';
  </script>
</head>

<body>
<div class="wrap">
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();
   for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
   k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(99647682, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img loading="lazy" src="https://mc.yandex.ru/watch/99647682" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<?php wp_body_open(); ?>
<script>
  const themeUri = '<?php echo get_template_directory_uri(); ?>';
</script>
<header id="header">
  <div class="top text-style-text-sm-medium d-flex flex-column align-center justify-center">
    <div class="container">
      <div class="d-flex align-center w-100"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-current="page" class="logo mr-md-20 mr-5 nuxt-link-exact-active nuxt-link-active"><?php bloginfo( 'name' ); ?></a>
        <div class="button button-xl button-primary d-md-none mr-5 px-5" @click="popup = true"><?=esc_html__('Подключить', 'galsuz')?></div>

        <a href="tel:(+998 71) 202-96-66" class="text-style-display-xs-normal d-flex d-md-none align-center phone ml-auto"><img loading="lazy" alt="icon"
          src="<?php echo get_template_directory_uri(); ?>/assets/images/call.svg"></a>
        <a href="https://t.me/GalsTelecomBot" class="text-style-display-xs-normal d-flex d-md-none align-center phone ml-5" target="_blank"><img loading="lazy" alt="icon"
          src="<?php echo get_template_directory_uri(); ?>/assets/images/tg-orange.svg"></a>
        <div class="burger d-md-none ml-10" @click="mobile = !mobile" :class="{ active: mobile }"><span></span><span></span><span></span></div>
        <?php
        wp_nav_menu(
          array(
            'theme_location' => 'main',
            'menu_id'        => 'mainmenu',
            'container' => false,
            'menu_class' => 'menu d-md-flex d-none',
            'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
            'add_li_class' => 'mr-12',
          )
        );
        ?>

        <div class="langs d-md-flex d-none align-center ml-auto"><a href="tel:(+998 71) 202-96-66"
            class="text-style-display-xs-normal d-flex align-center phone"><img loading="lazy" alt="icon" src="<?php echo get_template_directory_uri(); ?>/assets/images/call.svg"
              class="mr-4">(+998 71) 202-96-66</a>
          <span class="ml-8 gray-400">|</span>
          <?php
          /**
           * URL structure:
           * {
           *  '/': '/uz/main/',
           *  '/about/': '/uz/about/',
           * }
           */
          $lang_urls = get_option('language_urls', []);
          $lang_urls_ru = array_flip($lang_urls);

          $uz_url = get_locale() === 'uz_UZ' ? $_SERVER['REQUEST_URI'] : ($lang_urls[$_SERVER['REQUEST_URI']] ?? '/uz/main/');
          $ru_url = get_locale() === 'ru_RU' ? $_SERVER['REQUEST_URI'] : ($lang_urls_ru[$_SERVER['REQUEST_URI']] ?? '/');
          echo "<!--";
          echo $uz_url."\n";
          echo $ru_url."\n";
          echo "-->";
          ?>
          <a class="lang mx-8 <?=get_locale() == 'uz_UZ' ? 'active' : ''?>" onclick='document.cookie = "language_selected=uz_UZ; path=/";' href="<?=$uz_url?>">UZ</a>
          <a class="lang <?=get_locale() == 'ru_RU' ? 'active' : ''?>" onclick='document.cookie = "language_selected=ru_RU; path=/";' href="<?=$ru_url?>">RU</a></div>
      </div>
    </div>
  </div>
  <div class="bottom text-style-text-md-medium d-md-flex d-none flex-column align-center justify-center">
    <div class="container">
      <div class="d-flex align-center">
        <?php
        $menu_name = 'mainsecond';
        $locations = get_nav_menu_locations();

        if( $locations && isset( $locations[ $menu_name ] ) ){

          // получаем элементы меню
          $menu_items = wp_get_nav_menu_items( $locations[ $menu_name ] );

          $menu_data = [];
          foreach((array) $menu_items as $menu_item) {
            if ($menu_item->menu_item_parent == "0") {
              $menu_data["".$menu_item->ID] = $menu_item;
            } else {
              if (!isset($menu_data["".$menu_item->menu_item_parent]->children)) $menu_data["".$menu_item->menu_item_parent]->children = [];
              $menu_data["".$menu_item->menu_item_parent]->children[] = $menu_item;
            }
          }

          // Получение айпи и проверка, показывать ли для юзеров не из этого айпи (чтобы роботы не видели несуществующие ссылки, которые ведут на 404)
          function ipInCIDR($ip, $cidr) {
          list($subnet, $mask) = explode('/', $cidr);
          return (ip2long($ip) & ~((1 << (32 - $mask)) - 1)) === (ip2long($subnet) & ~((1 << (32 - $mask)) - 1));
        }

        function isAllowedIP($ip) {
          $allowed_cidrs = [
            '146.158.20.0/22',
            '146.158.28.0/23',
            '31.148.100.0/22',
            '31.148.144.0/22',
            '91.231.56.0/22',
            '92.253.196.0/22',
            '92.38.16.0/22',
            '92.38.24.0/22',
            '92.38.52.0/22',
            '93.170.16.0/21',
            '93.170.168.0/23',
            '93.170.208.0/22',
            '93.171.210.0/23',
            '10.0.0.0/8'
          ];

          foreach ($allowed_cidrs as $cidr) {
            if (ipInCIDR($ip, $cidr)) return true;
          }
          return false;
        }

        $user_ip = $_SERVER['REMOTE_ADDR'];
        $canShowSubmenu = isAllowedIP($user_ip);

          $imgSubMenu = [
            'http://kino.gt.uz/' => get_template_directory_uri() . '/assets/images/sub-icons/video.svg',
            'http://music.gt.uz/' => get_template_directory_uri() . '/assets/images/sub-icons/music.svg',
            'http://media.gt.uz/' => get_template_directory_uri() . '/assets/images/sub-icons/file-text.svg',
            'http://apk.gt.uz/' => get_template_directory_uri() . '/assets/images/sub-icons/smartphone.svg',
            'http://iptv.gt.uz/' => get_template_directory_uri() . '/assets/images/sub-icons/tv.svg',
            'http://game.gt.uz/' => get_template_directory_uri() . '/assets/images/sub-icons/twitch.svg',
          ];

          $subtitleSubMenu = [
            'http://kino.gt.uz/'  => esc_html__('Каталог фильмов на портале', 'galsuz'),
            'http://music.gt.uz/' => esc_html__('Музыкальный архив', 'galsuz'),
            'http://media.gt.uz/' => esc_html__('Софт, книги и прочее', 'galsuz'),
            'http://apk.gt.uz/'   => esc_html__('Игры и приложения для Android', 'galsuz'),
            'http://iptv.gt.uz/'  => esc_html__('Цифровое телевидение', 'galsuz'),
            'http://game.gt.uz/'  => esc_html__('Игровой портал', 'galsuz'),
          ];


          $menu = '<ul class="menu d-flex">';
          foreach($menu_data as $key => $menu_item) {
            $menu .= '<li class="mr-16 '. (isset($menu_item->children) ? 'more' : '').'"><a href="'.$menu_item->url.'" class="">'.$menu_item->title.'</a>';
            if (isset($menu_item->children)) {
              $menu .= '<div class="sub"><div class="row">';
              foreach($menu_item->children as $key => $submenu_item) {
                $menu .= '
                <a href="'.$submenu_item->url.'" class="col-md-6 col-12 item">
                  <div class="mb-4 pa-6 d-flex align-start"><img loading="lazy" alt="icon" src="' . $imgSubMenu[$submenu_item->url] . '" class="icon">
                    <div class="ml-6">
                      <div class="title">' . $submenu_item->title . '</div>
                      <div class="subtitle text-style-text-sm-normal">' . $subtitleSubMenu[$submenu_item->url] . '</div>
                    </div>
                  </div>
                </a>';
              }
              $menu .= '</div></div>';
            }
            $menu .= '</li>';
          }
          $menu .= '</ul>';
        }

        echo $menu;

        $alerts = get_posts([
          'post_type' => 'alerts',
          'date_query' => [
            'after' => date('Y-m-d', strtotime('-14 days'))
          ],
          'meta_query' => [
            [
              'key' => 'head_alert',
              'value' => 1
            ]
          ],
          'numberposts' => -1
        ]);
        ?>
        <div class="notifications ml-auto mr-10 pointer <?php if (count($alerts) === 0) echo 'opacity-0'; ?>">
          <a href="<?php echo get_post_type_archive_link('alerts'); ?>" class="bell"></a>
          <a href="<?php echo get_post_type_archive_link('alerts'); ?>" class="badge text-style-text-xs-medium" ref="alerts-badge" data-count="<?php echo count($alerts);?>"><?php echo count($alerts);?></a>
        </div>
        <a target="_blank" href="https://stat.gals.uz:9443/" class="lk effect-style-shadow-xs-focused-4-px-gray-100"><?=esc_html__('Личный кабинет', 'galsuz')?></a>
      </div>
      <div class="alerts" :class="{ active: alerts }">
        <?php foreach($alerts as $alert): ?>
        <div class="alert d-flex align-center bgcolor-primary-500 color-white radius-12 pa-6 mb-4" ref="alert-<?php echo $alert->ID; ?>">
          <div class="cube bgcolor-primary-300 radius-10 d-flex align-center justify-center mr-8">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M12 16V12M12 8H12.01M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
          <a href="<?php echo get_permalink($alert->ID); ?>" class="title color-primary-50" @click="hideAlert('<?php echo $alert->ID; ?>')"><?php echo $alert->post_title; ?></a>
          <a href="<?php echo get_permalink($alert->ID); ?>" class="button button-lg ml-auto mr-8" @click="hideAlert('<?php echo $alert->ID; ?>')"><span><?php echo esc_html__('Подробнее', 'galsuz');?></span></a>
          <div class="close d-flex align-center justify-center pointer" @click="hideAlert('<?php echo $alert->ID; ?>')">
            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M13 1L1 13M1 1L13 13" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>

  <div class="mobileMenu" ref="mobileMenu" :class="{ active: mobile }">
    <div class="container">
      <div class="top">
        <div class="d-flex align-center w-100"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-current="page"
            class="logo mr-20 nuxt-link-exact-active nuxt-link-active"></a>
          <div class="burger d-md-none" @click="mobile = !mobile" :class="{ active: mobile }"><span></span><span></span><span></span></div>
        </div>
      </div>
      <div class="d-flex align-center justify-between">
        <a href="tel:(+998 71) 202-96-66" class="text-style-display-xs-normal d-flex align-center phone my-5"><img loading="lazy"
            src="<?php echo get_template_directory_uri(); ?>/assets/images/call.svg" class="mr-4">(+998 71) 202-96-66</a>
        <span class="gray-400">|</span>
        <a class="lang <?=get_locale() == 'uz_UZ' ? 'active' : ''?>" href="<?=$uz_url?>">UZ</a>
        <a class="lang <?=get_locale() == 'ru_RU' ? 'active' : ''?>" href="<?=$ru_url?>">RU</a>
      </div>
      <div class="d-flex justify-between py-5"><a href="https://stat.gals.uz:9443/"
          class="lk effect-style-shadow-xs-focused-4-px-gray-100"><?=esc_html__('Личный кабинет', 'galsuz')?></a></div>

      <?php
        wp_nav_menu(
          array(
            'theme_location' => 'main',
            'menu_id'        => 'mainmenu',
            'container' => false,
            'menu_class' => 'menu d-flex flex-column',
            'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
            'add_li_class' => 'mb-4',
            'link_class' => 'py-3 d-block'
          )
        );
      ?>

      <?php
        $menu_name = 'mainsecond';
        $locations = get_nav_menu_locations();

        if( $locations && isset( $locations[ $menu_name ] ) ){

          // получаем элементы меню
          $menu_items = wp_get_nav_menu_items( $locations[ $menu_name ] );

          $menu_data = [];
          foreach((array) $menu_items as $menu_item) {
            if ($menu_item->menu_item_parent == "0") {
              $menu_data["".$menu_item->ID] = $menu_item;
            } else {
              if (!isset($menu_data["".$menu_item->menu_item_parent]->children)) $menu_data["".$menu_item->menu_item_parent]->children = [];
              $menu_data["".$menu_item->menu_item_parent]->children[] = $menu_item;
            }
          }

          $imgSubMenu = [
            'http://kino.gt.uz/' => get_template_directory_uri() . '/assets/images/sub-icons/video.svg',
            'http://music.gt.uz/' => get_template_directory_uri() . '/assets/images/sub-icons/music.svg',
            'http://media.gt.uz/' => get_template_directory_uri() . '/assets/images/sub-icons/file-text.svg',
            'http://apk.gt.uz/' => get_template_directory_uri() . '/assets/images/sub-icons/smartphone.svg',
            'http://iptv.gt.uz/' => get_template_directory_uri() . '/assets/images/sub-icons/tv.svg',
            'http://game.gt.uz/' => get_template_directory_uri() . '/assets/images/sub-icons/twitch.svg',
          ];

          $subtitleSubMenu = [
            'http://kino.gt.uz/'  => esc_html__('Каталог фильмов на портале', 'galsuz'),
            'http://music.gt.uz/' => esc_html__('Музыкальный архив', 'galsuz'),
            'http://media.gt.uz/' => esc_html__('Софт, книги и прочее', 'galsuz'),
            'http://apk.gt.uz/'   => esc_html__('Игры и приложения для Android', 'galsuz'),
            'http://iptv.gt.uz/'  => esc_html__('Цифровое телевидение', 'galsuz'),
            'http://game.gt.uz/'  => esc_html__('Игровой портал', 'galsuz'),
          ];

          $menu = '<ul class="menu d-flex flex-column">';
          foreach($menu_data as $key => $menu_item) {
            $menu .= '<li class="mb-4"><a href="'.$menu_item->url.'" class="py-3 d-block">'.$menu_item->title.'</a>';
            if (isset($menu_item->children)) {
              $menu .= '<div class="ssub"><div class="row">';
              foreach($menu_item->children as $key => $submenu_item) {
                $menu .= '
                <a href="'.$submenu_item->url.'" class="col-md-6 col-12 item">
                  <div class="mb-4 pa-6 d-flex align-start"><img loading="lazy" alt="icon" src="' . $imgSubMenu[$submenu_item->url] . '" class="icon">
                    <div class="ml-6">
                      <div class="title">' . $submenu_item->title . '</div>
                      <div class="subtitle text-style-text-sm-normal">' . $subtitleSubMenu[$submenu_item->url] . '</div>
                    </div>
                  </div>
                </a>';
              }
              $menu .= '</div></div>';
            }
            $menu .= '</li>';
          }
          $menu .= '</ul>';
        }

        echo $menu;
        ?>
    </div>
  </div>
  <div class="modal" :class="{ active: popup }">
    <div class="overlay" @click="popup = false, selectedTarif = false"></div>
    <div class="window effect-style-shadow-lg pa-16">
      <div class="close" @click="popup = false, selectedTarif = false">&times;</div>
      <div class="content">
        <tarif-form v-if="popup" :post="{ post_title: '<?= esc_html__('Главная', 'galsuz') ?>' }" @close="popup = false"></tarif-form>
      </div>
    </div>
  </div>
</header>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "@id": "https://gals.uz/#organization",
  "name": "Gals Telecom",
  "url": "https://gals.uz",
  "contactPoint": {
    "@type": "ContactPoint",
    "telephone": "+998712029666",
    "contactType": "customer service",
    "areaServed": "UZ",
    "availableLanguage": ["Uzbek", "Russian"]
  }
}
</script>
<?php
/*
  <div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'galsuz' ); ?></a>

    <header id="masthead" class="site-header">
      <div class="site-branding">
        <?php
        the_custom_logo();
        if ( is_front_page() && is_home() ) :
          ?>
          <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
          <?php
        else :
          ?>
          <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
          <?php
        endif;
        $galsuz_description = get_bloginfo( 'description', 'display' );
        if ( $galsuz_description || is_customize_preview() ) :
          ?>
          <p class="site-description"><?php echo $galsuz_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
        <?php endif; ?>
      </div><!-- .site-branding -->

      <nav id="site-navigation" class="main-navigation">
        <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'galsuz' ); ?></button>
        <?php
        wp_nav_menu(
          array(
            'theme_location' => 'menu-1',
            'menu_id'        => 'primary-menu',
          )
        );
        ?>
      </nav><!-- #site-navigation -->
    </header><!-- #masthead -->
*/ ?>
