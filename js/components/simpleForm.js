  const simpleForm = {
    name: 'SimpleForm',
    data() {
      return {
        name: '',
        email: '',
        phone: '',
        comment: '',
        agree: true,
        simpleFormLang: window.simpleFormLang,
      }
    },
    computed: {
      errors() {
        const errors = {
          name: '',
          email: '',
          phone: '',
          length: 0,
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
  
    methods: {
      $t(item) {
        return window.htmlEntityDecode(this.simpleFormLang[item])
      },
      async sendMail() {
        if (this.errors.length === 0 && this.agree) {
          const fd = new FormData()
          fd.set('action', 'ofSendMailSimple')
          fd.set('name', this.name)
          fd.set('email', this.email)
          fd.set('phone', this.phone)
          fd.set('comment', this.comment)
          fd.set('url', window.location.href)
          if (window.postTitle) fd.set('postTitle', window.postTitle)

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
            this.comment = ''
            alert(this.$t('form-12'))
          } else {
            alert(this.$t('form-13'))
            console.log(response.data)
          }
        }
      },
    },
    template: `

    <div class="simpleform" id="form">
    <div class="row justify-center">
      <div class="col-12 col-md-8 pr-md-16">
        <div class="text-style-display-md-semibold color-gray-900 mb-10 text-center" v-html="$t('form-1')"></div>
        <div class="text-style-text-xl-normal color-gray-500 mb-md-20 mb-10 text-center" v-html="$t('form-2')"></div>
        <div class="block">
          <label :class="{ err: errors.name !== '' }"><span>{{ $t('form-3') }}</span>
            <div class="input">
              <input type="text" name="fname" v-model="name"/>
            </div>
            <div class="err" v-if="errors.name !== ''">{{ errors.name }}</div>
          </label>
          <label :class="{ err: errors.email !== '' }"><span>{{ $t('form-4') }}</span>
            <div class="input">
              <input type="email" name="email" v-model="email"/>
            </div>
            <div class="err" v-if="errors.email !== ''">{{ errors.email }}</div>
          </label>
          <label :class="{ err: errors.phone !== '' }"><span>{{ $t('form-5') }}</span>
            <div class="input">
              <input type="phone" name="phone" v-model="phone" v-mask="'+998-##-###-####'" placeholder="+998-12-345-6789"/>
            </div>
            <div class="err" v-if="errors.phone !== ''">{{ errors.phone }}</div>
          </label>
          <label><span>{{ $t('form-6') }}</span>
            <div class="input">
              <textarea v-model="comment"></textarea>
            </div>
          </label>
          <button class="button button-xl" @click="sendMail">{{ $t('form-82') }}</button>
        </div>
      </div>
    </div>
  </div>`
  }

  if (window.simpleFormLayer)
    window.simpleFormLayer.forEach(item => { item() })
