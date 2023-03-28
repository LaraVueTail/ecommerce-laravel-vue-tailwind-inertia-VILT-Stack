<template>
  <div class="overflow-x-auto" v-if="products.data.length">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
      <thead
        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
      >
        <tr>
          <th scope="col" class="px-4 py-3">ID</th>
          <th scope="col" class="px-4 py-3">Name</th>
          <th scope="col" class="px-4 py-3">Category</th>
          <th scope="col" class="px-4 py-3">Price</th>
          <th scope="col" class="px-4 py-3">Brand</th>
          <th scope="col" class="px-4 py-3">Tag</th>
          <th scope="col" class="px-4 py-3">Availability</th>
          <th scope="col" class="px-4 py-3">Inventory</th>
          <th scope="col" class="px-4 py-3">Created at</th>
          <th scope="col" class="px-4 py-3">
            <span class="sr-only">Actions</span>
          </th>
        </tr>
      </thead>
      <tbody>
        <tr
          class="border-b dark:border-gray-700"
          v-for="product in products.data"
          :key="product"
        >
          <th
            scope="row"
            class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white"
          >
            {{ product.id }}
          </th>
          <th scope="row" class="px-4 py-3 font-medium">
            {{ product.name }}
          </th>
          <td class="px-4 py-3">
            {{ product.category.name }}
          </td>
          <td class="px-4 py-3">
            {{ product.price }}<br />
            <p class="font-medium">Offer Price: {{ product.price_no_offer }}</p>
          </td>
          <td class="px-4 py-3">
            {{ product.brand }}
          </td>
          <td class="px-4 py-3">
            {{ product.tag }}
          </td>
          <td class="px-4 py-3">
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
          </td>

          <td class="px-4 py-3">
            {{ product.inventory }}
          </td>

          <td class="px-4 py-3">
            {{ toDate(product.created_at) }}
          </td>

          <td class="px-4 py-3 flex items-center justify-end">
            <button
              :id="`${product.id}-dropdown-button`"
              :data-dropdown-toggle="`${product.id}-dropdown`"
              class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100"
              type="button"
            >
              <svg
                class="w-5 h-5"
                aria-hidden="true"
                fill="currentColor"
                viewbox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"
                />
              </svg>
            </button>
            <div
              :id="`${product.id}-dropdown`"
              class="hidden z-auto w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600"
            >
              <ul
                class="py-1 text-sm text-gray-700 dark:text-gray-200"
                :aria-labelledby="`${product.id}-dropdown-button`"
              >
                <li>
                  <Link
                    :href="`/admin-dashboard/products/${product.id}`"
                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                    >Show</Link
                  >
                </li>
                <li>
                  <Link
                    :href="`/admin-dashboard/products/${product.id}/edit`"
                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                    >Edit</Link
                  >
                </li>
              </ul>
              <div class="py-1">
                <a
                  href="#"
                  class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"
                  @click="$emit('deleteOrder', product.id)"
                  >Delete</a
                >
              </div>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <div v-else class="text-lg px-4 text-gray-500">No Products!</div>
</template>
<script>
export default {
  props: ["products"],
  emits: ["deleteProduct"],
  methods: {
    toDate(date) {
      try {
        var d = new Date(date);
        let text = d.toDateString();
        return text;
      } catch (error) {
        return false;
      }
    },
    convertString(string) {
      var newString = string.split("_").join(" ");
      return newString.charAt(0).toUpperCase() + newString.slice(1);
    },
  },
};
</script>
<script setup>
import { onMounted } from "vue";
import { initFlowbite } from "flowbite";
onMounted(() => {
  initFlowbite();
});
</script>
