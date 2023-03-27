<template>
  <div class="overflow-x-auto" v-if="orders.data.length">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
      <thead
        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
      >
        <tr>
          <th scope="col" class="px-4 py-3">ID</th>
          <th scope="col" class="px-4 py-3">Date</th>
          <th scope="col" class="px-4 py-3">User</th>
          <th scope="col" class="px-4 py-3">Shipping Address</th>
          <th scope="col" class="px-4 py-3">Items</th>
          <th scope="col" class="px-4 py-3">Total Price</th>
          <th scope="col" class="px-4 py-3">Order Status</th>
          <th scope="col" class="px-4 py-3">
            <span class="sr-only">Actions</span>
          </th>
        </tr>
      </thead>
      <tbody>
        <tr
          class="border-b dark:border-gray-700"
          v-for="order in orders.data"
          :key="order"
        >
          <th
            scope="row"
            class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white"
          >
            {{ order.id }}
          </th>
          <th scope="row" class="px-4 py-3 font-medium">
            {{ toDate(order.created_at) }}
          </th>
          <td class="px-4 py-3">
            <b>User ID : </b>{{ order.user_id }}<br />
            <b>Email : </b>{{ order.user.email }}<br />
            <b>Phone Number : </b>{{ order.user.phone_number }}<br />
          </td>
          <td class="px-4 py-3">
            <b>Name : </b
            >{{
              JSON.parse(order.shipping_address)["first_name"] +
              JSON.parse(order.shipping_address)["last_name"]
            }}<br />
            <b>Email : </b>{{ JSON.parse(order.shipping_address)["email"] }}<br />
            <b>Phone Number : </b>{{ JSON.parse(order.shipping_address)["phone_number"]
            }}<br />
            <!-- {{
                                        JSON.parse(order.shipping_address)[
                                            "address_line_1"
                                        ]
                                    }}
                                    <br />
                                    {{
                                        JSON.parse(order.shipping_address)[
                                            "address_line_2"
                                        ]
                                    }}<br />
                                    {{
                                        JSON.parse(order.shipping_address)[
                                            "city"
                                        ]
                                    }}<br />
                                    {{
                                        JSON.parse(order.shipping_address)[
                                            "pin_code"
                                        ]
                                    }}<br />
                                    {{
                                        JSON.parse(order.shipping_address)[
                                            "country"
                                        ]
                                    }}<br /> -->
          </td>
          <td class="px-4 py-3">
            <div v-for="cartItem in JSON.parse(order.cart_content)" :key="cartItem">
              {{ cartItem.name }} x
              {{ cartItem.quantity }}
              <!-- <div>{{ cartItem.price }}</div> -->
            </div>
          </td>
          <td class="px-4 py-3">
            {{ order.total_price }}
          </td>
          <td class="px-4 py-3">
            <span
              class="text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300"
              :class="{
                'bg-green-100 text-green-800': order.status === 'paid',
                'bg-yellow-100 text-yellow-800': order.status === 'unpaid',
                'bg-blue-100 text-blue-800': order.status === 'shipped',
                'bg-green-600 text-white': order.status === 'delivered',
                'bg-red-600 text-white': order.status === 'cancelled',
              }"
            >
              {{ order.status }}</span
            >
          </td>

          <td class="px-4 py-3 flex items-center justify-end">
            <button
              :id="`${order.id}-dropdown-button`"
              :data-dropdown-toggle="`${order.id}-dropdown`"
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
              :id="`${order.id}-dropdown`"
              class="hidden z-auto w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600"
            >
              <ul
                class="py-1 text-sm text-gray-700 dark:text-gray-200"
                :aria-labelledby="`${order.id}-dropdown-button`"
              >
                <li>
                  <Link
                    :href="`/admin-dashboard/orders/${order.id}`"
                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                    >Show</Link
                  >
                </li>
                <li>
                  <Link
                    :href="`/admin-dashboard/orders/${order.id}/edit`"
                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                    >Edit</Link
                  >
                </li>
              </ul>
              <div class="py-1">
                <a
                  href="#"
                  class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"
                  @click="$emit('deleteOrder', order.id)"
                  >Delete</a
                >
              </div>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <div v-else class="text-lg px-4 text-gray-500">No orders!</div>
</template>
<script>
export default {
  props: ["orders"],
  emits: ["deleteOrder"],
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
