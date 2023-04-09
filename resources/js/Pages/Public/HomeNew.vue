<template>
  <HeroSliderVue :hero_carousel="JSON.parse(theme_option.hero_carousel)"></HeroSliderVue>
</template>
<script>
export default {
  props: ["theme_option"],
};
</script>
<script setup>
import HeroSliderVue from "../../Shared/HomePageComponents/HeroSlider.vue";
</script>
