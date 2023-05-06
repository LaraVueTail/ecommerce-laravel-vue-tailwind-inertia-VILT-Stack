<template>
  <vueper-slides autoplay :arrows="false" :breakpoints="breakpoints">
    <vueper-slide v-for="(slide, i) in hero_carousel" :key="i" :image="slide">
    </vueper-slide>
  </vueper-slides>
</template>

<script>
import { VueperSlides, VueperSlide } from "vueperslides";
import "vueperslides/dist/vueperslides.css";
export default {
  components: { VueperSlides, VueperSlide },
  props: ["hero_carousel"],
  data() {
    return {
      breakpoints: {
        1900: {
          slideRatio: 1 / 2.5,
        },
        900: {
          slideRatio: 1 / 3,
        },
        600: {
          slideRatio: 1 / 1.5,
          arrows: false,
          bulletsOutside: false,
        },
        // The order you list breakpoints does not matter, Vueper Slides will sort them for you.
        // 1100: {
        //   slideRatio: 1 / 4,
        // },
      },
    };
  },
};
</script>
