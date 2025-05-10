  const sliderComponent = {
    name: 'SliderComponent',
    props: {
      slides: {
        type: Array,
        default: () => [],
      }
    },
    data() {
      return {
        sliderInterval: 5,
        load: '',
        position: 0,
        interval: false,
        hover: false,
        startX: 0,
        posX: 0,
        drag: false,
      }
    },
    watch: {
      hover() {
        if (this.hover) {
          clearInterval(this.interval)
        } else {
          this.startInterval()
        }
      },
    },
    mounted() {
      this.startInterval()
    },
    beforeDestroy() {
      clearInterval(this.interval)
    },
    methods: {
      startInterval() {
        if (this.slides.length < 2) return
        clearInterval(this.interval)
        this.interval = setInterval(() => {
          if (this.position + 1 === this.slides.length) {
            this.position = 0
          } else {
            this.position += 1
          }
        }, this.sliderInterval * 1000)
      },
      swipeLeft() {
        clearInterval(this.interval)
        if (this.position + 1 === this.slides.length) {
          this.position = 0
        } else {
          this.position += 1
        }
        this.startInterval()
      },
      swipeRight() {
        clearInterval(this.interval)
        if (this.position - 1 < 0) {
          this.position = this.slides.length - 1
        } else {
          this.position -= 1
        }
        this.startInterval()
      },
      movingHandler(e) {
        if (this.drag)
          this.posX = (e.touches ? e.touches[0].screenX : e.screenX) - this.startX
      },
      startHandler(e) {
        clearInterval(this.interval)
        this.startX = e.touches ? e.touches[0].screenX : e.screenX
        this.drag = true
      },
      endHandler(e) {
        if (this.posX < -50) {
          this.swipeLeft()
        } else if (this.posX > 50) {
          this.swipeRight()
        } else {
          this.startInterval()
        }
        this.drag = false
        this.startX = 0
        this.posX = 0
      }
    },
    template: `
      <div class="slider" @mouseover="hover = true" @mouseleave="hover = false">
        <div
          class="slides"
          :class="['length-' + slides.length, 'pos-' + (position + 1)]"
          :data-pos="position"
          :style="{ transform: 'translateX(' + posX + 'px)'}"
          v-touch:drag="movingHandler"
          v-touch:press="startHandler"
          v-touch:release="endHandler"
        >
          <div class="slide" v-for="slide  in slides" :key="slide.ID">
            <Banner :data="slide"></Banner>
          </div>
        </div>
        <div class="dots" v-if="slides.length > 1">
          <div class="dot" v-for="pos in slides.length" :key="pos" :class="{ active: pos-1 === position }" @click="position = pos-1"></div>
        </div>
      </div>
    `
  }

  if (window.sliderLayer)
    window.sliderLayer.forEach(item => { item() })
