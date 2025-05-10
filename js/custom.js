(async () => {
  await ymaps3.ready;
  const ymaps3Vue = await ymaps3.import('@yandex/ymaps3-vuefy');
  const vuefy = ymaps3Vue.vuefy.bindTo(Vue);
  const { YMap, YMapDefaultSchemeLayer, YMapDefaultFeaturesLayer, YMapMarker } = vuefy.module(ymaps3);
  window.YMap = YMap
  window.YMapDefaultSchemeLayer = YMapDefaultSchemeLayer
  window.YMapDefaultFeaturesLayer = YMapDefaultFeaturesLayer
  window.YMapMarker = YMapMarker
})()

const rayons = window.lang === 'ru_RU' ? {
  '': [],
  'Яккасарайский район': [
    'ЖК Golden House Parisien',
    'ЖК Инстанбул',
    'улица Шота Руставели',
    'улица Богибустон',
    'Малая кольцевая дорога',
  ],
  'Мирабадский район': ['ЖК NRG Oybek'],
  'Сергелийский район': [
    'массив Куйлюк-5',
    'массив Куйлюк-6',
    'массив Куйлюк-7',
    'массив Сергели-2',
    'массив Сергели-3',
    'массив Сергели-4',
    'массив Сергели-5',
    'массив Сергели-6',
    'массив Сергели-6а',
    'массив Сергели-7',
    'массив Сергели-8',
    'массив Сергели-11',
    'массив Строитель',
  ],
  'Янгихаётский район': [
    'массив Дустлик-1',
    'массив Дустлик-2',
    'массив Сергели-1',
    'массив Сергели-3а',
    'массив Сергели-3б',
    'массив Сергели-5а',
    'массив Сергели-7а',
    'массив Сергели-8а',
    'массив Сергели-8 Участок',
    'массив Сергели-9 Участок',
    'массив Сергели-10 Участок',
    'массив Спутник-4',
    'массив Спутник-6',
    'массив Спутник-7',
    'массив Спутник-8',
    'массив Спутник-11',
    'массив Спутник-14',
    'массив Спутник-15',
    'массив Спутник-16',
    'массив Спутник-16а',
    'массив Спутник-17',
    'массив Спутник-18',
    'массив Янги Чоштепа',
  ],
  'Другое': [],
} : {
  '': [],
  'Yakkasaroy tumani': [
    'Golden House Parisien TJM',
    'Istanbul TJM',
    'Shota Rustaveli ko‘chasi',
    'Bog‘ibo‘ston ko‘chasi',
    'Kichik Xalqa Yo‘li',
  ],
  'Mirobod tumani': ['NRG Oybek TJM'],
  'Sergeli tumani': [
    'Qo‘yliq-5 mavzesi',
    'Qo‘yliq-6 mavzesi',
    'Qo‘yliq-7 mavzesi',
    'Sergeli-2 mavzesi',
    'Sergeli-3 mavzesi',
    'Sergeli-4 mavzesi',
    'Sergeli-5 mavzesi',
    'Sergeli-6 mavzesi',
    'Sergeli-6a mavzesi',
    'Sergeli-7 mavzesi',
    'Sergeli-8 mavzesi',
    'Sergeli-11 mavzesi',
    'Quruvchilar mavzesi',
  ],
  'Yangihayot tumani': [
    'Do‘stlik-1 mavzesi',
    'Do‘stlik-2 mavzesi',
    'Sergeli-1 mavzesi',
    'Sergeli-3a mavzesi',
    'Sergeli-3b mavzesi',
    'Sergeli-5a mavzesi',
    'Sergeli-7a mavzesi',
    'Sergeli-8a mavzesi',
    'Sergeli 8-qurilish hududi',
    'Sergeli 9-qurilish hududi',
    'Sergeli 10-qurilish hududi',
    'Sputnik-4 mavzesi',
    'Sputnik-6 mavzesi',
    'Sputnik-7 mavzesi',
    'Sputnik-8 mavzesi',
    'Sputnik-11 mavzesi',
    'Sputnik-14 mavzesi',
    'Sputnik-15 mavzesi',
    'Sputnik-16 mavzesi',
    'Sputnik-16a mavzesi',
    'Sputnik-17 mavzesi',
    'Sputnik-18 mavzesi',
    'Yangi Choshtepa mavzesi',
  ],
  'Boshqa': [],
}


jQuery(document).ready(function ($) {
  $('.accordeon-item').on('click', function () {
    $(this).toggleClass('active');
  })
})

window.htmlEntityDecode = (text) => {
  if (text == null) {
    return text;
  }
  const map = {"gt":">","amp":"&","lt":"<","apos":"\'"};
  return text.replace(/&(#(?:x[0-9a-f]+|\d+)|[a-z]+);?/gi, function($0, $1) {
      if ($1[0] === "#") {
          return String.fromCharCode($1[1].toLowerCase() === "x" ? parseInt($1.substr(2), 16)  : parseInt($1.substr(1), 10));
      } else {
          return map.hasOwnProperty($1) ? map[$1] : $0;
      }
  });
};
