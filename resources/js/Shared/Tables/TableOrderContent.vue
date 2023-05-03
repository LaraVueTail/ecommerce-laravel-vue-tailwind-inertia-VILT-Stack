<template>
  <div class="text-sm font-medium my-3 text-gray-500" v-if="orderContent.length < 1">
    No Order Items
  </div>

  <div class="relative overflow-x-auto border rounded-lg my-2" v-else>
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
      <thead
        class="text-xs text-gray-700 uppercase bg-blue-50 dark:bg-gray-700 dark:text-gray-400"
      >
        <tr>
          <th scope="col" class="px-6 py-3">Prod. ID</th>
          <th scope="col" class="px-6 py-3">Prod. Name</th>
          <th scope="col" class="px-6 py-3">Prod. Price</th>
          <th scope="col" class="px-6 py-3">Quantity</th>
          <th scope="col" class="px-6 py-3"></th>
        </tr>
      </thead>
      <tbody>
        <tr
          class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
          v-for="orderItem in orderContent"
          :key="orderItem"
        >
          <th
            scope="row"
            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
          >
            {{ orderItem.id }}
          </th>
          <th
            scope="row"
            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
          >
            {{ orderItem.name }}
          </th>
          <th
            scope="row"
            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
          >
            {{ orderItem.price }}
          </th>
          <td class="px-6 py-4">
            {{ orderItem.quantity }}
          </td>
          <td class="px-6 py-4">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 35 35"
              stroke-width="1.5"
              stroke="currentColor"
              @click="deleteOrderItem(orderItem)"
              class="w-6 h-6 text-red-400 hover:cursor-pointer hover:text-red-700"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
              />
            </svg>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
<script>
export default {
  props: ["orderContent"],
};
</script>
