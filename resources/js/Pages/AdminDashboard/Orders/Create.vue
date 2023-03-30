<template>
  <section class="dark:bg-gray-900 h-screen overflow-x-hidden md:overflow-x-visible p-1">
    <div class="mx-auto max-w-screen-xl px-1 lg:px-12 my-11 pb-11">
      <!-- Modal content -->

      <Breadcrump :links="{ orders: 'orders', 'Create Order': '' }"></Breadcrump>

      <div
        class="relative p-4 bg-white border border-gray-200 rounded-lg shadow dark:border-gray-700 dark:bg-gray-800 sm:p-5"
      >
        <!-- Modal header -->
        <div
          class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600"
        >
          <h5
            class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"
          >
            Create Order
          </h5>
          <button
            type="button"
            @click="reloadPage()"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke-width="1.5"
              stroke="currentColor"
              class="w-6 h-6"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99"
              />
            </svg>

            <span class="sr-only">Refresh</span>
          </button>
        </div>
        <!-- Modal body -->
        <form action="#" @submit.prevent="">
          <div>
            <div class="grid gap-4 mb-4 grid-col-1 sm:grid-cols-3">
              <div class="pr-5 border-r col-span-2">
                <p class="font-medium text-blue-600 dark:text-gray-400 my-4">
                  Shipping Adrress:
                </p>
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                  <div>
                    <label
                      for="first_name"
                      class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                      >First Name</label
                    >
                    <input
                      type="text"
                      name="first_name"
                      id="first_name"
                      v-model="orderInfoShippingAddress.first_name"
                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    />
                  </div>
                  <div>
                    <label
                      for="last_name"
                      class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                      >Last Name</label
                    >
                    <input
                      type="text"
                      name="last_name"
                      id="last_name"
                      v-model="orderInfoShippingAddress.last_name"
                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    />
                  </div>
                  <div>
                    <label
                      for="email"
                      class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                      >Email</label
                    >
                    <input
                      type="email"
                      name="email"
                      id="email"
                      v-model="orderInfoShippingAddress.email"
                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    />
                  </div>
                  <div>
                    <label
                      for="phone_number"
                      class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                      >Phone Number</label
                    >
                    <input
                      type="text"
                      name="phone_number"
                      id="phone_number"
                      v-model="orderInfoShippingAddress.phone_number"
                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    />
                  </div>
                  <div>
                    <label
                      for="address_line_1"
                      class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                      >Address Line 1</label
                    >
                    <input
                      type="text"
                      name="address_line_1"
                      id="address_line_1"
                      v-model="orderInfoShippingAddress.address_line_1"
                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    />
                  </div>
                  <div>
                    <label
                      for="address_line_2"
                      class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                      >Address Line 2</label
                    >
                    <input
                      type="text"
                      name="address_line_2"
                      id="address_line_2"
                      v-model="orderInfoShippingAddress.address_line_2"
                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    />
                  </div>
                  <div>
                    <label
                      for="city"
                      class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                      >City</label
                    >
                    <input
                      type="text"
                      name="city"
                      id="city"
                      v-model="orderInfoShippingAddress.city"
                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    />
                  </div>
                  <div>
                    <label
                      for="pin_code"
                      class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                      >Pin code</label
                    >
                    <input
                      type="text"
                      name="pin_code"
                      id="pin_code"
                      v-model="orderInfoShippingAddress.pin_code"
                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    />
                  </div>
                  <div>
                    <label
                      for="country"
                      class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                      >Country</label
                    >
                    <input
                      type="text"
                      name="country"
                      id="country"
                      v-model="orderInfoShippingAddress.country"
                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    />
                  </div>
                </div>
              </div>
              <div class="">
                <p class="font-medium text-blue-600 dark:text-gray-400 my-4">
                  User Details:
                </p>
                <div>
                  <label
                    for="user_id"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    >User ID</label
                  >
                  <input
                    type="text"
                    name="user_is"
                    id="user_id"
                    v-model="orderInfo.user_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    :class="{
                      'border-red-500': errors.user_id,
                    }"
                  />
                </div>
                <p class="font-medium text-blue-600 dark:text-gray-400 my-4">
                  Order Status:
                </p>
                <label
                  for="status"
                  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                  >Change Order Status</label
                >
                <select
                  id="status"
                  v-model="orderInfo.status"
                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 mb-4"
                >
                  <option
                    :selected="orderInfo.status === status"
                    v-for="status in [
                      'unpaid',
                      'paid',
                      'shipped',
                      'delivered',
                      'cancelled',
                    ]"
                    :key="status"
                    :value="status"
                  >
                    {{ status }}
                  </option>
                  <!-- <option value="TV">TV/Monitors</option>
                                  <option value="PC">PC</option>
                                  <option value="GA">Gaming/Console</option>
                                  <option value="PH">Phones</option> -->
                </select>
              </div>
            </div>
          </div>

          <div>
            <div v-if="errors ?? false">
              <div
                v-for="(value, key, index) in errors"
                :key="index"
                v-text="value"
                class="text-red-600 text-sm mt-1 bg-red-200 p-2 rounded my-2"
              ></div>
            </div>
            <div class="flex items-center space-x-4">
              <button
                type="submit"
                @click.prevent="createOrder()"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
              >
                Create Order
              </button>
            </div>
          </div>
        </form>
      </div>

      <div
        class="relative p-4 bg-blue-100 border border-blue-100 rounded-lg shadow dark:border-gray-700 dark:bg-gray-800 sm:p-5 my-6"
      >
        <div class="bg-blue-100 px-3 rounded pb-4">
          <p class="font-medium text-blue-600 dark:text-gray-400 my-4">Order details:</p>
          <div>
            <label
              for="description"
              class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
              >Order Items</label
            >
            <div
              class="text-sm font-medium my-3 text-gray-500"
              v-if="orderContent.length < 1"
            >
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
          </div>
          <div class="grid sm:grid-cols-2">
            <div class="p-2 bg-blue-50 rounded-lg">
              <label
                for="description"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >Add item</label
              >
              <div class="grid grid-cols-2 gap-2">
                <div>
                  <label
                    for="product_id"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    >Product ID</label
                  >
                  <input
                    type="number"
                    name="product_id"
                    id="product_id"
                    min="1"
                    v-model="newOrderItem.id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="ex: 133"
                  />
                </div>
                <div>
                  <label
                    for="product_name"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    >Product Name</label
                  >
                  <input
                    type="text"
                    name="product_name"
                    id="product_name"
                    v-model="newOrderItem.name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder=""
                  />
                </div>
                <div>
                  <label
                    for="product_price"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    >Product Price</label
                  >
                  <input
                    type="number"
                    name="product_price"
                    id="product_price"
                    min="0"
                    v-model="newOrderItem.price"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder=""
                  />
                </div>
                <div>
                  <label
                    for="product_quantity"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    >Quantity</label
                  >
                  <input
                    type="number"
                    name="product_quantity"
                    id="product_quantity"
                    min="1"
                    v-model="newOrderItem.quantity"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="ex: 2"
                  />
                </div>
                <div class="justify-self-stretch col-span-2">
                  <button
                    @click.prevent="addOrderItem()"
                    class="text-white w-full bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                  >
                    Add Item
                  </button>
                </div>
              </div>
            </div>
            <div class="p-5 pb-0 flex flex-col justify-between">
              <div>
                <label class="text-md font-medium text-gray-900"
                  >Total Amount: {{ totalAmount }}</label
                ><br />
                <label class="text-md font-medium text-gray-900"
                  >Total No. Items: {{ orderContent.length }}</label
                ><br />
              </div>

              <div>
                <div v-if="errors ?? false">
                  <div
                    v-for="(value, key, index) in errors"
                    :key="index"
                    v-text="value"
                    class="text-red-600 text-sm mt-1 bg-red-200 p-2 rounded my-2"
                  ></div>
                </div>
                <div class="flex items-center space-x-4">
                  <button
                    type="submit"
                    @click.prevent="createOrder()"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                  >
                    Create Order
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { router } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";
export default {
  props: ["errors"],
  data() {
    return {
      orderInfo: {},
      orderInfoShippingAddress: {},
      orderContent: [],
      newOrderItem: {},
      form: {},
    };
  },
  computed: {
    totalAmount() {
      var total = 0;
      if (this.orderContent.length > 0) {
        this.orderContent.forEach((element) => {
          total += element.price * element.quantity;
        });
      }
      return total;
    },
  },
  methods: {
    addOrderItem() {
      if (
        this.newOrderItem.id > 0 &&
        this.newOrderItem.name !== "" &&
        this.newOrderItem.price > 0 &&
        this.newOrderItem.quantity > 0
      )
        this.orderContent.push(this.newOrderItem);
    },
    deleteOrderItem(item) {
      var index = this.orderContent.indexOf(item);
      if (index !== -1) {
        this.orderContent.splice(index, 1);
      }
    },
    reloadPage() {
      router.visit(`/admin-dashboard/orders/${this.order.id}/edit`);
    },
    createOrder() {
      this.orderInfo.shipping_address = JSON.stringify(this.orderInfoShippingAddress);
      this.orderInfo.cart_content = JSON.stringify(this.orderContent);
      this.orderInfo.total_price = this.totalAmount;
      this.orderInfo.session_id = "Manually created order";
      this.form = useForm(this.orderInfo);
      console.log(this.orderInfo);
      this.form.post(`/admin-dashboard/orders`, {
        preserveScroll: true,
      });
    },
  },
};
</script>
<script setup>
import { onMounted, onUpdated } from "vue";
import { initFlowbite } from "flowbite";
import Breadcrump from "../../../Shared/AdminDashboardLayoutComponents/Breadcrump.vue";
onMounted(() => {
  initFlowbite();
});
onUpdated(() => {
  initFlowbite();
});
</script>
