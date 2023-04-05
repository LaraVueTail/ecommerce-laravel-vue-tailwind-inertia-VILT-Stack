<template>
  <div class="bg-white">
    <div class="py-6">
      <Breadcrumb
        :breadcrumbs="[
          { id: 1, name: 'Men', link: '#' },
          { id: 2, name: 'Clothing', link: '#' },
        ]"
        :product="product"
      ></Breadcrumb>

      <div
        class="grid grid-cols-1 md:grid-cols-3 mx-auto mt-6 max-w-2xl sm:px-6 lg:max-w-7xl"
      >
        <div
          :class="{
            'col-span-1': JSON.parse(product.more_images).length == 0,
            'col-span-2': JSON.parse(product.more_images).length == 1,
            'col-span-3': JSON.parse(product.more_images).length >= 2,
          }"
        >
          <ProductImage
            :thumbnail="product.thumbnail"
            @sendToLightbox="(image) => showLightbox(image)"
            :more_images="product.more_images"
          ></ProductImage>
        </div>
        <div class="mt-10 sm:px-6 px-4" v-if="JSON.parse(product.more_images).length < 2">
          <div>
            <div class="mb-6">
              <h1 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                {{ product.name }}
              </h1>
            </div>

            <div class="my-6">
              <h3 class="sr-only">Reviews</h3>
              <div class="flex items-center">
                <div class="flex items-center">
                  <StarIcon
                    v-for="rating in [0, 1, 2, 3, 4]"
                    :key="rating"
                    :class="[
                      4 > rating ? 'text-gray-900' : 'text-gray-200',
                      'h-5 w-5 flex-shrink-0',
                    ]"
                    aria-hidden="true"
                  />
                </div>
                <p class="sr-only">4 out of 5 stars</p>
                <a
                  href="#"
                  class="ml-3 text-sm font-medium text-indigo-600 hover:text-indigo-500"
                  >100 reviews</a
                >
              </div>
            </div>

            <div>
              <h3 class="sr-only">Description</h3>
              <div class="space-y-6">
                <p class="text-base text-gray-900">{{ product.short_description }}</p>
              </div>
            </div>

            <div class="my-10">
              <h3 class="text-sm font-medium text-gray-900">Product Details</h3>

              <div class="mt-4">
                <ul role="list" class="list-disc space-y-2 pl-4 text-sm">
                  <li
                    v-for="(value, key, index) in JSON.parse(product.product_details)"
                    :key="index"
                    class="text-gray-400"
                  >
                    <span class="text-gray-600">{{ key }} : {{ value }}</span>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="grid mx-auto mt-10 max-w-2xl px-4 sm:px-6 lg:max-w-7xl mb-60">
        <div class="md:grid md:grid-cols-3 gap-2 flex flex-col-reverse">
          <div class="col-span-2 md:border-r md:border-gray-200 md:pr-8">
            <div>
              <div v-if="JSON.parse(product.more_images).length >= 2">
                <div class="mb-6 hidden md:block">
                  <h1 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                    {{ product.name }}
                  </h1>
                </div>

                <div>
                  <h3 class="sr-only">Description</h3>
                  <div class="space-y-6">
                    <p class="text-base text-gray-900">{{ product.short_description }}</p>
                  </div>
                </div>

                <div class="my-10">
                  <h3 class="text-sm font-medium text-gray-900">Product Details</h3>

                  <div class="mt-4">
                    <ul role="list" class="list-disc space-y-2 pl-4 text-sm">
                      <li
                        v-for="(value, key, index) in JSON.parse(product.product_details)"
                        :key="index"
                        class="text-gray-400"
                      >
                        <span class="text-gray-600">{{ key }} : {{ value }}</span>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="">
                <h2 class="text-sm font-medium text-gray-900">Details</h2>

                <div class="mt-4 space-y-6">
                  <p class="text-sm text-gray-600">{{ product.description }}</p>
                </div>
              </div>
            </div>
          </div>
          <div class="md:px-4">
            <div
              class="mb-6 md:hidden"
              v-if="JSON.parse(product.more_images).length >= 2"
            >
              <h1 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                {{ product.name }}
              </h1>
            </div>
            <p class="flex items-center gap-2">
              <span class="text-sm text-blue-600 font-medium"> {{ product.offer }}</span>
              <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20"
                fill="currentColor"
                class="w-5 h-5 text-blue-600"
              >
                <path
                  fill-rule="evenodd"
                  d="M5.5 3A2.5 2.5 0 003 5.5v2.879a2.5 2.5 0 00.732 1.767l6.5 6.5a2.5 2.5 0 003.536 0l2.878-2.878a2.5 2.5 0 000-3.536l-6.5-6.5A2.5 2.5 0 008.38 3H5.5zM6 7a1 1 0 100-2 1 1 0 000 2z"
                  clip-rule="evenodd"
                />
              </svg>
            </p>
            <p class="text-3xl tracking-tight text-gray-900">
              ${{ product.price }}
              <span class="text-xl tracking-tight text-gray-600 line-through px-2"
                >${{ product.price_sale }}</span
              >
            </p>

            <div class="my-6" v-if="JSON.parse(product.more_images).length >= 2">
              <h3 class="sr-only">Reviews</h3>
              <div class="flex items-center">
                <div class="flex items-center">
                  <StarIcon
                    v-for="rating in [0, 1, 2, 3, 4]"
                    :key="rating"
                    :class="[
                      4 > rating ? 'text-gray-900' : 'text-gray-200',
                      'h-5 w-5 flex-shrink-0',
                    ]"
                    aria-hidden="true"
                  />
                </div>
                <p class="sr-only">4 out of 5 stars</p>
                <a
                  href="#"
                  class="ml-3 text-sm font-medium text-indigo-600 hover:text-indigo-500"
                  >100 reviews</a
                >
              </div>
            </div>

            <div class="my-6 space-y-1">
              <p class="text-md tracking-tight text-gray-900 font-medium">
                Category : {{ product.category.name }}
              </p>
              <p class="text-md tracking-tight text-gray-900 font-medium">
                Brand : {{ product.brand }}
              </p>
              <p class="py-4">
                <span
                  class="text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300"
                  :class="{
                    'bg-green-100 text-green-800': product.availability === 'paid',
                    'bg-yellow-100 text-yellow-800': product.availability === 'unpaid',
                    'bg-blue-100 text-blue-800': product.availability === 'coming_soon',
                    'bg-green-600 text-white': product.availability === 'available',
                    'bg-red-600 text-white': product.availability === 'out_of_stock',
                  }"
                >
                  {{ convertString(product.availability) }}</span
                >
              </p>

              <div>
                <div class="flex items-center space-x-3 my-2">
                  <button
                    class="inline-flex items-center p-1 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                    type="button"
                  >
                    <span class="sr-only">Quantity button</span>
                    <svg
                      class="w-6 h-6"
                      @click="() => (quantity > 1 ? quantity-- : quantity == 1)"
                      aria-hidden="true"
                      fill="currentColor"
                      viewBox="0 0 20 20"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        fill-rule="evenodd"
                        d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                        clip-rule="evenodd"
                        class=""
                      ></path>
                    </svg>
                  </button>
                  <div>
                    <input
                      type="number"
                      v-model="quantity"
                      min="0"
                      id="third_product"
                      class="bg-gray-50 w-14 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-2.5 py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                      placeholder="1"
                      required
                    />
                  </div>
                  <button
                    class="inline-flex items-center p-1 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                    type="button"
                  >
                    <span class="sr-only">Quantity button</span>
                    <svg
                      class="w-6 h-6"
                      @click="quantity++"
                      aria-hidden="true"
                      fill="currentColor"
                      viewBox="0 0 20 20"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        fill-rule="evenodd"
                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                        clip-rule="evenodd"
                      ></path>
                    </svg>
                  </button>
                </div>
              </div>

              <button
                type="button"
                @click="addToCart()"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
              >
                <svg
                  aria-hidden="true"
                  class="w-5 h-5 mr-2 -ml-1"
                  fill="currentColor"
                  viewBox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"
                  ></path>
                </svg>
                Add to Cart
              </button>
            </div>
          </div>
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
        class="h-full max-h-[40rem] w-full object-cover object-center rounded-xl"
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
import { useForm } from "@inertiajs/vue3";

export default {
  props: ["product"],
  data() {
    return {
      lightbox: false,
      lightBoxImageSrc: "",
      itemToCart: {},
      quantity: 1,
    };
  },
  methods: {
    showLightbox(image) {
      console.log(image);
      this.lightbox = true;
      this.lightBoxImageSrc = image;
    },
    convertString(string) {
      var newString = string.split("_").join(" ");
      return newString.charAt(0).toUpperCase() + newString.slice(1);
    },
    addToCart() {
      this.added = true;
      setTimeout(() => (added = false), 500);
      this.itemToCart.product = this.product;
      this.itemToCart.quantity = this.quantity;
      this.form = useForm(this.itemToCart);
      this.form.post("/cart/add", { preserveScroll: true });
    },
  },
};
</script>

<script setup>
import Breadcrumb from "../../../Shared/PublicLayoutComponents/Breadcrumb.vue";
import ProductImage from "../../../Shared/ProductLayoutComponents/SingleProductLayoutComponents/ProductImage.vue";
import { StarIcon } from "@heroicons/vue/20/solid";

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
