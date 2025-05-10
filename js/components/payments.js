(async function() {
  await ymaps3.ready;
  const ymaps3Vue = await ymaps3.import('@yandex/ymaps3-vuefy');
  const vuefy = ymaps3Vue.vuefy.bindTo(Vue);
  const { YMap, YMapDefaultSchemeLayer, YMapDefaultFeaturesLayer, YMapMarker } = vuefy.module(ymaps3);

  const paymentsApp = Vue.createApp({
    name: 'PaymentsC',
    components: { YMap, YMapDefaultSchemeLayer, YMapDefaultFeaturesLayer, YMapMarker },
    data() {
      return {
        payments: payments,
        paymentcat: paymentcat.reverse(),
        activeCat: paymentcat.reverse()[0].term_id,
        controls: ['geolocationControl', 'zoomControl'],
        marker: false,
      }
    },
    computed: {
      location() {
        return {
          zoom: 13,
          center: this.marker ? this.marker : [69.279737, 41.311159],
        }
      }
    },
    methods: {
      makeMarker(pos) {
        console.log(pos)
        if (pos !== '') {
          pos = pos.replace(' ', '')
          pos = pos.split(',')
          this.marker = [Number(pos[1]), Number(pos[0])]
        }
      },
    },
  })

  paymentsApp.mount("#payments")
})()
