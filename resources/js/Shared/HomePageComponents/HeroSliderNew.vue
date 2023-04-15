<template>
  <vueper-slides autoplay :arrows="false" fixed-height="900px">
    <vueper-slide v-for="(slide, i) in hero_carousel" :key="i">
      <template #content>
        <div
          class="bg-contain bg-center h-full absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
          :style="`background-image: url(${slide})`"
        ></div>
      </template>
    </vueper-slide>
  </vueper-slides>
</template>

<script>
import { VueperSlides, VueperSlide } from "vueperslides";
import "vueperslides/dist/vueperslides.css";
export default {
  components: { VueperSlides, VueperSlide },
  props: ["hero_carousel"],
};
</script>
