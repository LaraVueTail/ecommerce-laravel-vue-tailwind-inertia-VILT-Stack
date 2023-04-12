<template>
  <HeroSliderVue
    :hero_carousel="JSON.parse(homePageContent.hero_carousel_url)"
  ></HeroSliderVue>
</template>
<script>
export default {
  props: ["homePageContent"],
};
</script>
<script setup>
import HeroSliderVue from "../../Shared/HomePageComponents/HeroSlider.vue";
</script>
