(function() {

  const tarifForm = {
    name: 'TarifForm',
    props: {
      yur: {
        type: Boolean,
        default: false,
      },
      post: {
        type: Object,
        default: () => {},
      },
    },
    data() {
      return {
        coords: [69.279737, 41.311159],
        controls: ['geolocationControl', 'zoomControl'],
        marker: false,
        address: '',
        name: '',
        email: '',
        phone: '',
        comment: '',
        rayon: '',
        massiv: '',
        nomerDoma: '',
        agree: true,
        suggestView: false,
        map: false,
        rayons: {
          '': [],
        },
      }
    },
    computed: {
      errors() {
        const errors = {
          address: '',
          name: '',
          email: '',
          phone: '',
          length: 0,
          rayon: '',
          massiv: '',
          nomerDoma: '',
        }
  
        if (this.phone.length > 0 && this.phone.length < 16) {
          errors.phone = this.$t('form-9')
          errors.length = 1
        }
  
        if (this.name.length > 0 && this.name.length < 3) {
          errors.name = this.$t('form-10')
          errors.length = 1
        }
  
        const re =
          // eslint-disable-next-line
          /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
        if (this.email.length > 0 && !re.test(String(this.email).toLowerCase())) {
          errors.email = this.$t('form-11')
          errors.length = 1
        }
  
        return errors
      },  
    },
    watch: {
      async address(nv) {
        if (nv.length > 5) {
          const result = await ymaps.geocode('Ташкент, ' + nv)
          if (result.geoObjects.get(0).geometry._coordinates) {
            this.marker = result.geoObjects.get(0).geometry._coordinates
          } else {
            this.marker = false
          }
        }
      },
      rayon(nv) {
        this.massiv = ''
        if (this.rayons[nv].length === 0) {
          this.suggestView = new ymaps.SuggestView('suggest')
          this.suggestView.events.add(['select'], (e) => {
            this.address = e.get('item').displayName
          })
        }
      },
    },
    beforeMount() {
      const keys = Object.keys(rayons)
      for (const k of keys) {
        this.rayons[k] = rayons[k]
      }
    },
    methods: {
      $t(item) {
        return tarifsFormLang[item]
      },
      mapInit(map) {
        this.$nextTick(() => {
          try {
            this.map = map
            this.suggestView = new ymaps.SuggestView('suggest')
            this.suggestView.events.add(['select'], (e) => {
              this.address = e.get('item').displayName
            })
          } catch (err) {}
        })
      },
  
      async mapClick(e) {
        this.coords = e.get('coords')
        this.marker = e.get('coords')
        const response = await fetch(
          'https://geocode-maps.yandex.ru/1.x/?apikey=a727668a-6504-46ae-9813-809720903b90&format=json&geocode=' +
            this.coords.join(',')
        )
        const d = await response.json()
        this.address =
          d.response.GeoObjectCollection.featureMember[0].GeoObject.description +
          ', ' +
          d.response.GeoObjectCollection.featureMember[0].GeoObject.name
        this.$refs.address.value = this.address
      },
  
      async sendMail() {
        if (this.name.length === 0) {
          alert(this.$t('form-10'))
          return
        }
        if (this.phone.length < 16) {
          alert(this.$t('form-9'))
          return
        }
        if (this.rayon === '') {
          alert(this.$t('form-21'))
          return
        }
        if (this.massiv === '') {
          alert(this.$t('form-22'))
          return
        }
  
        if (this.errors.length === 0 && this.agree) {
          const fd = new FormData()
          fd.set('action', 'ofSendMail')
          fd.set('tarif', this.post.post_title)
          fd.set('name', this.name)
          fd.set('email', this.email)
          fd.set('phone', this.phone)
          fd.set('address', this.address)
          fd.set('rayon', this.rayon)
          fd.set('massiv', this.massiv)
          fd.set('nomerDoma', this.nomerDoma)
          fd.set('comment', this.yur ? 'Юр. лицо - ' + this.comment : this.comment)
  
          const handler = await fetch(
            'https://' + window.location.hostname + '/wp-admin/admin-ajax.php', {
                method: 'POST',
                body: fd
            }
          )

          const response = await handler.json()

          if (response.data === 'ok') {
            this.name = ''
            this.email = ''
            this.phone = ''
            this.address = ''
            this.comment = ''
            alert(this.$t('form-12'))
          } else {
            alert(this.$t('form-13'))
            // eslint-disable-next-line no-console
            console.log(response.data)
          }
        }
      },
    },
    template: `

    <div class="form" id="form">
      <div class="row">
        <div class="col-12 pr-md-16" :class="{ 'col-md-6' : yur }">
          <div class="text-style-display-md-semibold color-gray-900 mb-10" v-html="$t('form-14')"></div>
          <div class="w-md-50 mb-24" v-html="$t('form-15')"></div>
          <label :class="{ err: errors.name !== '' }"><span>{{ $t('form-3') }} *</span>
            <div class="input">
              <input type="text" name="fname" v-model="name"/>
            </div>
            <div class="err" v-if="errors.name !== ''">{{ errors.name }}</div>
          </label>
          <label v-show="yur" :class="{ err: errors.email !== '' }"><span>{{ $t('form-4') }}</span>
            <div class="input">
              <input type="email" name="email" v-model="email"/>
            </div>
            <div class="err" v-if="errors.email !== ''">{{ errors.email }}</div>
          </label>
          <label :class="{ err: errors.phone !== '' }"><span>{{ $t('form-5') }} *</span>
            <div class="input">
              <input type="phone" name="phone" v-model="phone" v-mask="'+998-##-###-####'" placeholder="+998-12-345-6789"/>
            </div>
            <div class="err" v-if="errors.phone !== ''">{{ errors.phone }}</div>
          </label>
          <label :class="{ err: errors.rayon !== '' }"><span>{{ $t('form-17') }} *</span>
            <div class="input">
              <select v-model="rayon">
                <option value="" disabled="disabled">-- {{ $t('form-20') }} --</option>
                <template v-for="(r, idx) in Object.keys(rayons)">
                  <option v-if="r !== ''" :value="r" :key="r">{{ r }}</option>
                </template>
              </select>
            </div>
            <div class="err" v-if="errors.rayon !== ''">{{ errors.rayon }}</div>
          </label>
          <label v-show="rayon !== ''" :class="{ err: errors.massiv !== '' }">
            <div v-show="rayons[rayon].length &gt; 0"><span>{{ $t('form-18') }} *</span>
              <div class="input">
                <select v-model="massiv">
                  <option value="" disabled="disabled">-- {{ $t('form-20') }} --</option>
                  <template v-for="(r, idx) in rayons[rayon]">
                    <option :value="r" :key="r">{{ r }}</option>
                  </template>
                </select>
              </div>
              <div class="err" v-if="errors.massiv !== ''">{{ errors.massiv }}</div>
            </div>
            <div v-show="rayons[rayon].length === 0"><span>{{ $t('form-16') }} *</span>
              <div class="input">
                <input ref="address" type="text" name="address" id="suggest" @change="address = $event.target.value"/>
              </div>
              <div class="err" v-if="errors.address !== ''">{{ errors.address }}</div>
            </div>
          </label>
          <label v-show="massiv !== ''" :class="{ err: errors.nomerDoma !== '' }"><span>{{ $t('form-19') }}</span>
            <div class="input">
              <input type="text" name="nomerDoma" v-model="nomerDoma"/>
            </div>
            <div class="err" v-if="errors.nomerDoma !== ''">{{ errors.nomerDoma }}</div>
          </label>
          <label><span>{{ $t('form-6') }}</span>
            <div class="input">
              <textarea v-model="comment"></textarea>
            </div>
          </label>
          <button class="button button-xl" @click="sendMail">{{ $t('form-8') }}</button>
        </div>
        <div class="col-12 col-md-6 pl-md-16 pt-16 pt-md-0" v-show="yur">
          <YandexMap :coords="marker ? marker : coords" :zoom="marker ? 17 : 12" :controls="controls" @map-was-initialized="mapInit" @click="mapClick">
            <ymap-marker v-if="marker" :coords="marker" :marker-id="'mainMarker'"></ymap-marker>
          </YandexMap>
        </div>
      </div>
    </div>
    `
  }

  const tarifs = Vue.createApp({
    data() {
      return {
        sliderInet: null,
        sliderTv: null,
        noscroll: noscroll,
        type: 'internet',
        position: 0,
        tarifsGlobal: {},
        tarifCats: tarifCats.filter(el => el.term_id !== 103),
        tarifsLang: tarifsLang,
        selectedTarif: false,
        popup: false,
        startX: 0,
        posX: 0,
        drag: false,
        mpos: 0,
        currentLang: currentLang,
      }
    },
    computed: {
      selectedTarifs() {
        const tarifs = JSON.parse(JSON.stringify(this.tarifsGlobal[this.type]));
        return this.noscroll ? tarifs : tarifs.concat(tarifs, tarifs);
      },
      tarifsInternet() {
        const tarifs = JSON.parse(JSON.stringify(this.tarifsGlobal['internet']));
        return this.noscroll ? tarifs : tarifs.concat(tarifs, tarifs);
      },
      tarifsTv() {
        const tarifs = JSON.parse(JSON.stringify(this.tarifsGlobal['catv']));
        return this.noscroll ? tarifs : tarifs.concat(tarifs, tarifs);
      },
      viewportWidth() {
        return window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth
      },
      tarifsSchema() {
        return JSON.stringify({
          "@context": "https://schema.org",
          "@type": "OfferCatalog",
          "name": "Тарифы интернет и ТВ",
          "description": "Выберите подходящий тариф на интернет и телевидение",
          "url": '/',
          "itemListElement": [
            ...this.tarifsInternet.map(item => ({
              "@type": "Offer",
              "name": item.post_title,
              "description": item.fields.usloviya ? this.stripTags(item.fields.usloviya) : '',
              "priceCurrency": "RUB",
              "price": item.fields.price,
              "category": "Интернет",
              "url": item.url,
            })),
            ...this.tarifsTv.map(item => ({
              "@type": "Offer",
              "name": item.post_title,
              "description": item.fields.usloviya ? this.stripTags(item.fields.usloviya) : '',
              "priceCurrency": "RUB",
              "price": item.fields.price,
              "category": "Кабельное ТВ",
              "url": item.url,
            }))
          ]
        });
      }
    },
    async beforeMount() {
      const tarifs = tarifsData

      for (const tk in this.tarifCats) {
        this.tarifCats[tk].slug = this.tarifCats[tk].slug.replace('-uz', '')
      }

      for (const tarif of tarifs) {
        const slug = tarif.terms[0].slug.replace('-uz', '')

        tarif.items = []

        if (tarif.fields.internet !== '')
          tarif.items.push({
            icon: themeUri + '/assets/images/tarif-icons/internet.svg',
            text: tarif.fields.internet,
          })
        if (tarif.fields['tas-ix'] !== '')
          tarif.items.push({
            icon: themeUri + '/assets/images/tarif-icons/hard.svg',
            text: tarif.fields['tas-ix'],
          })
        if (tarif.fields.iptv !== '')
          tarif.items.push({
            icon: themeUri + '/assets/images/tarif-icons/iptv.svg',
            text: tarif.fields.iptv,
          })

        if (!this.tarifsGlobal[slug]) {
          this.tarifsGlobal[slug] = []
        }

        this.tarifsGlobal[slug].push(tarif)
      }
      this.position = (this.selectedTarifs.length) / 3 - 1;
      this.mpos = (this.selectedTarifs.length) / 3;
    },
    mounted() {
      this.buildTns();
      this.addSchema();
    },
    methods: {
      buildTns() {
        const options = {
          container: '.allitems.internet .items',
          mouseDrag: true,
          nav: false,
          items: 1,
          fixedWidth: this.viewportWidth - 30,
          controls: false,
          responsive: {
            768: {
              fixedWidth: 330,
              items: 3,
              controls: true,
            }
          }
        };

        if (!this.noscroll) {
          this.sliderInet = tns(options);
          options.container = '.allitems.catv .items';
          this.sliderTv = tns(options);
        }
      },
      findCat(cat) {
        const _tag = this.tarifCats.find((el) => {
          return el.id === cat
        })
        return _tag ? _tag.slug : ''
      },
      next() {
        if (this.position + 3 === this.selectedTarifs.length) {
          this.position = 0
        } else {
          this.position += 1
        }
      },
      prev() {
        if (this.position === 0) {
          this.position = this.selectedTarifs.length - 3
        } else {
          this.position -= 1
        }
      },

      swipeLeft() {
        if (this.mpos + 1 === this.selectedTarifs.length) {
          this.mpos = 0
        } else {
          this.mpos += 1
        }
      },
      swipeRight() {
        if (this.mpos - 1 < 0) {
          this.mpos = this.selectedTarifs.length - 1
        } else {
          this.mpos -= 1
        }
      },
      movingHandler(e) {
        if (this.drag)
          this.posX = (e.touches ? e.touches[0].screenX : e.screenX) - this.startX
      },
      startHandler(e) {
        if (!this.noscroll) {
          this.startX = e.touches ? e.touches[0].screenX : e.screenX
          this.drag = true
        }
      },
      endHandler(e) {
        if (!this.noscroll) {
          if (this.posX < -50) {
            this.swipeLeft()
          } else if (this.posX > 50) {
            this.swipeRight()
          }
          this.drag = false
          this.startX = 0
          this.posX = 0
        }
      },
      stripTags(html) {
        const div = document.createElement('div');
        div.innerHTML = html;
        return div.textContent || div.innerText || '';
      },
      addSchema() {
        const script = document.createElement('script');
        script.type = 'application/ld+json';
        script.text = this.tarifsSchema;
        document.head.appendChild(script);
      },
    },
    template: `
    <div id="tarifs" class="tarifs addSchema" :class=" { noscroll: noscroll } ">
      <div class="d-flex justify-between flex-column flex-md-row align-center mb-17">
        <div class="switch mb-10 mb-md-0" v-if="tarifCats[0]">
          <div class="item internet" :class="{ active: type === tarifCats[0].slug }" @click="type = tarifCats[0].slug">
            <div class="icon">
              <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M18.3334 10.0001C18.3334 14.6025 14.6024 18.3334 10 18.3334M18.3334 10.0001C18.3334 5.39771 14.6024 1.66675 10 1.66675M18.3334 10.0001H1.66669M10 18.3334C5.39765 18.3334 1.66669 14.6025 1.66669 10.0001M10 18.3334C12.0844 16.0515 13.269 13.0901 13.3334 10.0001C13.269 6.91011 12.0844 3.94871 10 1.66675M10 18.3334C7.91562 16.0515 6.73106 13.0901 6.66669 10.0001C6.73106 6.91011 7.91562 3.94871 10 1.66675M1.66669 10.0001C1.66669 5.39771 5.39765 1.66675 10 1.66675" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </div>
            <div class="text">{{ tarifCats[0].name }}</div>
          </div>
          <div class="item tv" :class="{ active: type === tarifCats[1].slug }" @click="type = tarifCats[1].slug">
            <div class="icon">
              <svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M6.66669 16.5H13.3334M10 13.1667V16.5M3.33335 1.5H16.6667C17.5872 1.5 18.3334 2.24619 18.3334 3.16667V11.5C18.3334 12.4205 17.5872 13.1667 16.6667 13.1667H3.33335C2.41288 13.1667 1.66669 12.4205 1.66669 11.5V3.16667C1.66669 2.24619 2.41288 1.5 3.33335 1.5Z" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </div>
            <div class="text">{{ tarifCats[1].name }}</div>
          </div>
        </div>
        <a class="button button-xl button-shaded arrow-right" :href="(currentLang === 'uz_UZ' ? '/uz' : '') + '/tarif'" v-if="!noscroll">{{ tarifsLang['tarifs-3'] }}</a>
      </div>
      <!-- <div class="allitems" v-if="tarifsGlobal[type] !== undefined" :class="{'firstEl': position === 0, 'lastEl': position + 3 === selectedTarifs.length}" v-touch:drag="movingHandler" v-touch:press="startHandler" v-touch:release="endHandler"> -->
      <div class="allitems internet" v-if="tarifsGlobal['internet'] !== undefined" v-show="type === 'internet'">
        <div class="items" :class="['length-' + tarifsInternet.length, 'pos-' + (position + 1), 'mpos-' + (mpos)]">
          <div class="item effect-style-shadow-lg" v-for="item in tarifsInternet" :key="item.ID" :class="[{ recomend : item.fields.recomend }, item.post_name]">
            <div class="top pa-16">
              <div class="d-flex justify-between align-center mb-8">
                <div class="name text-style-text-lg-medium">{{ item.post_title }}</div>
                <div class="badge text-style-text-xs-medium" v-if="item.fields.recomend">{{ tarifsLang['tarifs-4'] }}</div>
              </div>
              <div class="price d-flex align-center mb-16">
                <div class="summ text-style-display-lg-semibold mr-4">{{ item.fields.price }}</div>
                <div class="txt text-style-text-sm-normal"><span>{{ tarifsLang['tarifs-5'] }}</span>
                  <div class="delim"></div><span>{{ tarifsLang['tarifs-6'] }}</span>
                </div>
              </div>
              <div class="button button-xl w-100 mb-6" :class="{ 'button-shaded': item.fields.recomend, 'button-primary': !item.fields.recomend }" @click="selectedTarif = item, popup = true"><span>{{ tarifsLang['tarifs-7'] }}</span></div>
              <div class="text-center">
                <a class="text-style-text-md-medium" :href="item.url">{{ tarifsLang['tarifs-8'] }}</a>
              </div>
            </div>
            <div class="bottom pa-16">
              <div class="info d-flex align-start" v-for="(info, infoidx) in item.items" :key="infoidx"><img loading="lazy" alt="icon" class="icon" :src="item.fields.recomend ? info.icon.replace('.svg', '-light.svg') : info.icon"/>
                <div class="text" v-html="info.text"></div>
              </div>
              <div class="conditions pt-4 text-style-text-sm-semibold mb-2">{{ tarifsLang['tarifs-9'] }}</div>
              <div class="conditions-text text-style-text-sm-normal" v-html="item.fields.usloviya"></div>
            </div>
          </div>
        </div>
        <!-- <div class="arrow-right" @click="next()"></div>
        <div class="arrow-left" @click="prev()"></div> -->
      </div>

      <div class="allitems catv" v-if="tarifsGlobal['catv'] !== undefined" v-show="type === 'catv'">
        <div class="items" :class="['length-' + tarifsTv.length, 'pos-' + (position + 1), 'mpos-' + (mpos)]">
          <div class="item effect-style-shadow-lg" v-for="item in tarifsTv" :key="item.ID" :class="[{ recomend : item.fields.recomend }, item.post_name]">
            <div class="top pa-16">
              <div class="d-flex justify-between align-center mb-8">
                <div class="name text-style-text-lg-medium">{{ item.post_title }}</div>
                <div class="badge text-style-text-xs-medium" v-if="item.fields.recomend">{{ tarifsLang['tarifs-4'] }}</div>
              </div>
              <div class="price d-flex align-center mb-16">
                <div class="summ text-style-display-lg-semibold mr-4">{{ item.fields.price }}</div>
                <div class="txt text-style-text-sm-normal"><span>{{ tarifsLang['tarifs-5'] }}</span>
                  <div class="delim"></div><span>{{ tarifsLang['tarifs-6'] }}</span>
                </div>
              </div>
              <div class="button button-xl w-100 mb-6" :class="{ 'button-shaded': item.fields.recomend, 'button-primary': !item.fields.recomend }" @click="selectedTarif = item, popup = true"><span>{{ tarifsLang['tarifs-7'] }}</span></div>
              <div class="text-center">
                <a class="text-style-text-md-medium" :href="item.url">{{ tarifsLang['tarifs-8'] }}</a>
              </div>
            </div>
            <div class="bottom pa-16">
              <div class="info d-flex align-start" v-for="(info, infoidx) in item.items" :key="infoidx"><img loading="lazy" alt="icon" class="icon" :src="item.fields.recomend ? info.icon.replace('.svg', '-light.svg') : info.icon"/>
                <div class="text" v-html="info.text"></div>
              </div>
              <div class="conditions pt-4 text-style-text-sm-semibold mb-2">{{ tarifsLang['tarifs-9'] }}</div>
              <div class="conditions-text text-style-text-sm-normal" v-html="item.fields.usloviya"></div>
            </div>
          </div>
        </div>
        <!-- <div class="arrow-right" @click="next()"></div>
        <div class="arrow-left" @click="prev()"></div> -->
      </div>
      <div class="modal" :class="{ active: popup }">
        <div class="overlay" @click="popup = false, selectedTarif = false"></div>
        <div class="window effect-style-shadow-lg pa-16">
          <div class="close" @click="popup = false, selectedTarif = false">&times;</div>
          <div class="content">
            <tarif-form v-if="selectedTarif" :post="selectedTarif"></tarif-form>
          </div>
        </div>
      </div>
    </div>
    `
  })
  tarifs.component('tarif-form', tarifForm)
  tarifs.use(VueTheMask)
  tarifs.use(vueTouchEvents)
  tarifs.mount("#tarifs")
})()
