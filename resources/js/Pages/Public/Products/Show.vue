<template>
  <div class="bg-white">
    <div class="pt-6">
      <Breadcrumb
        :breadcrumbs="[
          { id: 1, name: 'Men', link: '#' },
          { id: 2, name: 'Clothing', link: '#' },
        ]"
        :product="product"
      ></Breadcrumb>

      <!-- Image gallery -->

      <div
        class="mx-auto mt-6 max-w-2xl sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-3 lg:gap-x-8 lg:px-8"
      >
        <div class="aspect-w-3 aspect-h-4 hidden overflow-hidden md:rounded-lg lg:block">
          <img
            :src="product.thumbnail"
            :alt="product.name"
            class="h-full w-full object-cover object-center"
            @click="showLightbox(product.thumbnail)"
          />
        </div>

        <div>
          {{ JSON.parse(product.more_images) }}
          <img
            :src="JSON.parse(product.more_images)[0]"
            :alt="product.name"
            class="h-full w-full object-cover object-center"
            @click="showLightbox(product.thumbnail)"
          />
        </div>
      </div>
    </div>
  </div>

  <div
    class="fixed top-0 left-0 h-full w-full flex items-center justify-center bg-opacity-50 bg-gray-800"
    v-if="lightbox"
  >
    <div class="z-10 flex flex-col items-center">
      <img
        :src="lightBoxImageSrc"
        class="h-96 w-full object-cover object-center rounded-xl"
      />
      <svg
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke-width="1.5"
        stroke="currentColor"
        class="w-10 h-10 text-white m-3 hover:text-blue-500 cursor-pointer"
        @click="lightbox = false"
      >
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
        />
      </svg>
    </div>
  </div>
</template>

<script>
export default {
  props: ["product"],
  data() {
    return {
      lightbox: false,
      lightBoxImageSrc: "",
    };
  },
  methods: {
    showLightbox(image) {
      console.log(image);
      this.lightbox = true;
      this.lightBoxImageSrc = image;
    },
  },
};
</script>

<script setup>
import Breadcrumb from "../../../Shared/PublicLayoutComponents/Breadcrumb.vue";

import { ref } from "vue";
import { StarIcon } from "@heroicons/vue/20/solid";
import { RadioGroup, RadioGroupLabel, RadioGroupOption } from "@headlessui/vue";

// const product = {
//   name: "Basic Tee 6-Pack",
//   price: "$192",
//   href: "#",
//   images: [
//     {
//       src:
//         "https://tailwindui.com/img/ecommerce-images/product-page-02-secondary-product-shot.jpg",
//       alt: "Two each of gray, white, and black shirts laying flat.",
//     },
//     {
//       src:
//         "https://tailwindui.com/img/ecommerce-images/product-page-02-tertiary-product-shot-01.jpg",
//       alt: "Model wearing plain black basic tee.",
//     },
//     {
//       src:
//         "https://tailwindui.com/img/ecommerce-images/product-page-02-tertiary-product-shot-02.jpg",
//       alt: "Model wearing plain gray basic tee.",
//     },
//     {
//       src:
//         "https://tailwindui.com/img/ecommerce-images/product-page-02-featured-product-shot.jpg",
//       alt: "Model wearing plain white basic tee.",
//     },
//   ],
//   colors: [
//     { name: "White", class: "bg-white", selectedClass: "ring-gray-400" },
//     { name: "Gray", class: "bg-gray-200", selectedClass: "ring-gray-400" },
//     { name: "Black", class: "bg-gray-900", selectedClass: "ring-gray-900" },
//   ],
//   sizes: [
//     { name: "XXS", inStock: false },
//     { name: "XS", inStock: true },
//     { name: "S", inStock: true },
//     { name: "M", inStock: true },
//     { name: "L", inStock: true },
//     { name: "XL", inStock: true },
//     { name: "2XL", inStock: true },
//     { name: "3XL", inStock: true },
//   ],
//   description:
//     'The Basic Tee 6-Pack allows you to fully express your vibrant personality with three grayscale options. Feeling adventurous? Put on a heather gray tee. Want to be a trendsetter? Try our exclusive colorway: "Black". Need to add an extra pop of color to your outfit? Our white tee has you covered.',
//   highlights: [
//     "Hand cut and sewn locally",
//     "Dyed with our proprietary colors",
//     "Pre-washed & pre-shrunk",
//     "Ultra-soft 100% cotton",
//   ],
//   details:
//     'The 6-Pack includes two black, two white, and two heather gray Basic Tees. Sign up for our subscription service and be the first to get new, exciting colors, like our upcoming "Charcoal Gray" limited release.',
// };
// const reviews = { href: "#", average: 4, totalCount: 117 };

// const selectedColor = ref(product.colors[0]);
// const selectedSize = ref(product.sizes[2]);
</script>
