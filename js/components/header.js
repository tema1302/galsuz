(function () {
  const { createApp } = Vue;

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
        loading: false,
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
        return tarifsLang[item]
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
          this.loading = true
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
            this.$emit('close')
          } else {
            alert(this.$t('form-13'))
            // eslint-disable-next-line no-console
            console.log(response.data)
          }
          this.loading = false
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
          <button class="button button-xl" v-if="!loading" @click="sendMail">{{ $t('form-8') }}</button>
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

  const headerApp = createApp({
    data() {
      return {
        popup: false,
        selectedTarif: false,
        mobile: false,
        alerts: false,
      };
    },
    mounted() {
      let keys = [];
      for (let [key, value] of Object.entries(this.$refs)) {
        if (/^alert-/.test(key)) {
          keys.push(key);
        }
      }

      for (let key of keys) {
        const viewed = JSON.parse(localStorage.viewed ?? '[]');
        if (viewed.includes(Number(key.replace('alert-', '')))) {
          const alert = this.$refs[key];
          alert.remove();
        }
      }

      const badge = this.$refs['alerts-badge'];
      badge.innerHTML = document.querySelectorAll('header .alerts .alert').length;

      this.alerts = true;
    },
    methods: {
      hideAlert(id) {
        const alert = this.$refs[`alert-${id}`];
        const viewed = JSON.parse(localStorage.viewed ?? '[]');
        viewed.push(Number(id));
        localStorage.viewed = JSON.stringify(viewed);
        alert.remove();

        const badge = this.$refs['alerts-badge'];
        badge.innerHTML = document.querySelectorAll('header .alerts .alert').length;
      },
    },
  })
  headerApp.component('TarifForm', tarifForm)
  headerApp.use(VueTheMask)
  headerApp.mount('#header');
})();
