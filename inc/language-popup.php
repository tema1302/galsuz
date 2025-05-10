<?php

add_action('admin_menu', 'sitepoint_settings_page');

add_action('admin_enqueue_scripts', function () {
  wp_enqueue_script('galsuz-vue');
});

function sitepoint_settings_page()
{
  add_options_page(
    'Страницы с переводом',
    'Страницы с переводом',
    'manage_options',
    'language_urls',
    'language_urls_page'
  );
}

if (!function_exists('language_urls_page')) {
  function language_urls_page()
  {
    if (!current_user_can('manage_options')) {
      return;
    }

    if (isset($_POST['submit'])) {
      $urls = array_map('sanitize_text_field', $_POST['urls']);
      update_option('language_urls', $urls);
    }

    ?>
    <div class="wrap" id="langUrls">
      <h1>Страницы с переводом</h1>
      <table class="form-table">
        <thead>
          <tr>
            <th scope="col">URL русской страницы</th>
            <th scope="col">URL узбекской страницы</th>
            <th scope="col">&nbsp;</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(url, index) in ruUrls" :key="index">
            <td>
              <input type="text" v-model="ruUrls[index]" class="regular-text" placeholder="URL русской страницы" />
            </td>
            <td>
              <input type="text" v-model="uzUrls[index]" class="regular-text" placeholder="URL узбекской страницы" />
            </td>
            <td>
              <div class="button button-secondary" @click="ruUrls.splice(index, 1); uzUrls.splice(index, 1)">Удалить</div>
            </td>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="3">
              <div class="button button-secondary" @click="ruUrls.push(''); uzUrls.push('')">Добавить URL</div>
            </td>
          </tr>
        </tfoot>
      </table>
      <div v-if="!loading" class="button button-primary" @click="send()"> Сохранить изменения</div>
    </div>
    <?php
  }
}

add_action('admin_print_footer_scripts', function () {
  $urls = get_option('language_urls', []);
  ?>
  <script>
    (function () {
      const { createApp } = Vue;

      const langUrls = createApp({
        data() {
          return {
            /**
             * URL structure:
             * {
             *  '/': '/uz/main/',
             *  '/about/': '/uz/about/',
             * }
             */

            urls: <?php echo json_encode($urls); ?>,
            ruUrls: [],
            uzUrls: [],
            loading: false,
          };
        },
        beforeMount() {
          this.ruUrls = Object.keys(this.urls);
          this.uzUrls = Object.values(this.urls);
        },
        methods: {
          send() {
            const urls = {};
            for (let i = 0; i < this.ruUrls.length; i++) {
              urls[this.ruUrls[i].replace('https://gals.uz/', '/')] = this.uzUrls[i].replace('https://gals.uz/', '/');
            }
            const data = {
              action: 'save_language_urls',
              urls: JSON.stringify(urls),
            };
            this.loading = true;

            jQuery.ajax({
              url: ajaxurl, // this will point to admin-ajax.php
              type: 'POST',
              data: data,
              success: (response) => {
                this.loading = false;
                if (!response.success) {
                  alert('Error saving URLs: ' + JSON.stringify(response));
                }
              }
            });
          }
        }
      });
      langUrls.mount('#langUrls');
    })();
  </script>
  <?php
}, PHP_INT_MAX);

add_action('wp_ajax_save_language_urls', function () {
  if (!current_user_can('manage_options')) {
    wp_send_json_error('Unauthorized', 403);
  }

  $urls = json_decode(stripslashes($_POST['urls']), true);
  if (is_array($urls)) {
    update_option('language_urls', $urls);
    wp_send_json_success();
  } else {
    wp_send_json_error('Invalid data', 400);
  }
});


if (!function_exists('language_get_translated_url')) {
  function language_get_translated_url($lang = 'ru_RU')
  {
    $current_url = $_SERVER['REQUEST_URI'];
    $urls = get_option('language_urls');
    $ru_urls = array_flip($urls);
    if ($lang === get_locale()) {
      return $current_url;
    }
    return $lang === 'uz_UZ' ? ($urls[$current_url] ?? '/uz/main/') : ($ru_urls[$current_url] ?? '/');
  }
}

add_action('wp_footer', function () {
  ?>
  <script>
    jQuery(document).ready(function ($) {
      // check if cookie not present
      if (document.cookie.indexOf('language_selected') === -1) {
        // Show the language selection popup
        showLanguagePopup();
      } else {
        if (window.lang !== Cookies.get('language_selected')) {
          // Show the language selection popup
          // showLanguagePopup();
          const langUrl = '<?php echo language_get_translated_url(get_locale() === 'ru_RU' ? 'uz_UZ' : 'ru_RU'); ?>';
          if (langUrl !== '/uz/main/' && langUrl !== '/') {
            document.location.href = langUrl;
          }
        }
      }
      // Function to show the language selection popup
      function showLanguagePopup() {
        // Create the language popup
        var popup = $(`
        <div id="language-popup" class="modal">
          <div class="overlay"></div>
          <div class="window effect-style-shadow-lg px-16 pt-16 pb-8">
            <div class="close">×</div>
            <div class="content">
              <!--<div class="text-style-display-md-semibold color-gray-900 mb-10">Выберите язык сайта</div>-->
              <h2 class="color-gray-900 mb-10">Выберите язык сайта</h2>
              <div class="d-flex gap-5">
                <div class="button hover-primary button-lg w-100 mb-6 lang-ru" data-url="<?php echo language_get_translated_url('ru_RU'); ?>"><span>🇷🇺 &nbsp;&nbsp;Русский</span></div>
                <div class="button hover-primary button-lg w-100 mb-6 lang-uz" data-url="<?php echo language_get_translated_url('uz_UZ'); ?>"><span>🇺🇿 &nbsp;&nbsp;O’zbek tili</span></div>
              </div>
            </div>
          </div>
        </div>`);

        $('body').append(popup);

        // Show the popup
        $('#language-popup').addClass('active');

        $('#language-popup .close, #language-popup .overlay').on('click', function () {
          $('#language-popup').removeClass('active');
        });

        $('#language-popup .lang-ru').on('click', function () {
          document.cookie = "language_selected=ru_RU; path=/";
          $('#language-popup').removeClass('active');
          if (document.location.pathname !== $(this).data('url')) document.location.href = $(this).data('url');
        });

        $('#language-popup .lang-uz').on('click', function () {
          document.cookie = "language_selected=uz_UZ; path=/";
          $('#language-popup').removeClass('active');
          if (document.location.pathname !== $(this).data('url')) document.location.href = $(this).data('url');
        });
      }
    });
  </script>
  <?php
});
