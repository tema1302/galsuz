const bannerComponent = {
  name: 'BannerComponent',
  props: ['data'],
  data() {
    return {
      img: '',
    }
  },
  computed: {
    customColor() {
      if (this.data.fields.type !== 'custom') return {}
      const rgb = this.hexToRgb(this.data.fields.color)
      const style = { background: 'transparent', color: this.data.fields.textColor }
      if (this.data.fields.color !== '#') {
        if (this.data.fields.align === 'left') {
          style.background = `linear-gradient(
            90deg,
            rgba(${rgb.r},${rgb.g},${rgb.b},.9) 0%,
            rgba(${rgb.r},${rgb.g},${rgb.b},.5) 55%,
            rgba(${rgb.r},${rgb.g},${rgb.b},0) 100%
          )`
        } else {
          style.background = `linear-gradient(
            -90deg,
            rgba(${rgb.r},${rgb.g},${rgb.b},.9) 0%,
            rgba(${rgb.r},${rgb.g},${rgb.b},.5) 55%,
            rgba(${rgb.r},${rgb.g},${rgb.b},0) 100%
          )`
        }
      }

      return style
    },
  },
  mounted() {
    const el = this.$el.querySelector('.back')
    if (!el || !this.data.fields.image) return

    this.observer = new IntersectionObserver(([entry]) => {
      if (entry.isIntersecting) {
        this.img = this.data.fields.image.url
        this.observer.disconnect()
      }
    }, { rootMargin: '200px' }) // можно уменьшить до 0px

    this.observer.observe(el)
  },
  beforeDestroy() {
    if (this.observer) this.observer.disconnect()
  },
  methods: {
    hexToRgb(hex) {
      const result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex)
      return result
        ? {
            r: parseInt(result[1], 16),
            g: parseInt(result[2], 16),
            b: parseInt(result[3], 16),
          }
        : null
    },
  },
  template: `
    <div class="banner" :class="[data.fields.type, data.fields.align, data.fields.valign]">
      <div class="back" :style="img ? { backgroundImage: 'url(' + img + ')' } : {}"></div>
      <div class="front" :style="customColor">
        <div class="html">
          <div class="text-style-display-md-medium" :class="[data.fields.margin, { 'mb-4': !data.fields.margin }]"> {{ data.fields.title }} </div>
          <div class="mb-16" v-html="data.fields.subtitle"></div>
          <a class="button button-2xl arrow-right" v-if="data.fields.button && data.fields.url !== '#'" :href="data.fields.url">
            <span>{{ data.fields.button }}</span>
          </a>
        </div>
      </div>
    </div>
  `
}

if (window.bannerLayer)
  window.bannerLayer.forEach(item => { item() })
