<template>
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-2xl pt-5 sm:pt-16 lg:max-w-none lg:pt-10 py-36">
      <h1 class="text-xl font-bold tracking-tight text-gray-600 sm:text-2xl my-6">
        Checkout
      </h1>
      <div class="grid md:grid-cols-2 gap-6">
        <div>
          <div class="p-5 col-span-2 bg-white rounded-lg shadow-md">
            <p class="font-medium text-blue-600 dark:text-gray-400 my-4">
              Shipping Address:
            </p>
            <div class="grid gap-4 sm:grid-cols-2">
              <FormInput
                :label="'First Name'"
                :name="'first_name'"
                :type="'text'"
                :error="errors.first_name"
                v-model="orderInfoShippingAddress.first_name"
              ></FormInput>
              <FormInput
                :label="'last Name'"
                :name="'last_name'"
                :type="'text'"
                :error="errors.last_name"
                v-model="orderInfoShippingAddress.last_name"
              ></FormInput>
            </div>
            <div class="grid gap-4 sm:grid-cols-2">
              <FormInput
                :label="'Email'"
                :name="'email'"
                :type="'email'"
                :error="errors.email"
                v-model="orderInfoShippingAddress.email"
              ></FormInput>
              <FormInput
                :label="'Phone Number'"
                :name="'phone_number'"
                :type="'text'"
                :error="errors.phone_number"
                v-model="orderInfoShippingAddress.phone_number"
              ></FormInput>
            </div>
            <div class="grid gap-4 sm:grid-cols-2">
              <FormInput
                :label="'Address Line 1'"
                :name="'address_line_1'"
                :type="'text'"
                :error="errors.address_line_1"
                v-model="orderInfoShippingAddress.address_line_1"
              ></FormInput>
              <FormInput
                :label="'Address Line 2'"
                :name="'address_line_2'"
                :type="'text'"
                :error="errors.address_line_2"
                v-model="orderInfoShippingAddress.address_line_2"
              ></FormInput>
            </div>
            <div class="grid gap-4 sm:grid-cols-2">
              <FormInput
                :label="'City'"
                :name="'city'"
                :type="'text'"
                :error="errors.city"
                v-model="orderInfoShippingAddress.city"
              ></FormInput>
              <FormInput
                :label="'Pin code'"
                :name="'pin_code'"
                :type="'text'"
                :error="errors.pin_code"
                v-model="orderInfoShippingAddress.pin_code"
              ></FormInput>
            </div>
            <div class="grid gap-4 sm:grid-cols-2">
              <FormInput
                :label="'Country'"
                :name="'country'"
                :type="'text'"
                :error="errors.country"
                v-model="orderInfoShippingAddress.country"
              ></FormInput>
            </div>
          </div>
        </div>
        <div>
          <p class="font-medium text-blue-600 dark:text-gray-400 my-4">Cart:</p>
          <p class="font-medium text-gray-600 dark:text-gray-400 my-4">
            Total Amount: <span v-html="$page.props.currencySymbol"></span
            >{{ $page.props.cartTotal }}
          </p>
          <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
              <thead
                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
              >
                <tr>
                  <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Image</span>
                  </th>
                  <th scope="col" class="px-6 py-3">Product</th>
                  <th scope="col" class="px-6 py-3">Qty</th>
                  <th scope="col" class="px-6 py-3">Price</th>
                  <th scope="col" class="px-6 py-3">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr
                  class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                  v-for="cartItem in cartContent"
                  :key="cartItem.id"
                >
                  <td class="w-32 p-4">
                    <img
                      :src="cartItem.attributes.image"
                      alt="Apple Watch"
                      class="rounded-lg"
                    />
                  </td>
                  <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                    {{ cartItem.name }}
                  </td>
                  <td class="px-6 py-4">
                    <div class="flex items-center space-x-3">
                      <button
                        class="inline-flex items-center p-1 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                        type="button"
                      >
                        <span class="sr-only">Quantity button</span>
                        <svg
                          class="w-4 h-4"
                          @click="quantityDown(cartItem.id)"
                          aria-hidden="true"
                          fill="currentColor"
                          viewBox="0 0 20 20"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            fill-rule="evenodd"
                            d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                            clip-rule="evenodd"
                          ></path>
                        </svg>
                      </button>
                      <div>
                        <input
                          type="number"
                          id="first_product"
                          :value="cartItem.quantity"
                          @change="cartItemUpdate(cartItem.id, $event.target.value)"
                          ref="quantity"
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
                          class="w-4 h-4"
                          aria-hidden="true"
                          @click="quantityUp(cartItem.id)"
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
                  </td>
                  <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                    <span v-html="$page.props.currencySymbol"></span>{{ cartItem.price }}
                  </td>
                  <td class="px-6 py-4">
                    <a
                      href="#"
                      @click="cartItemRemove(cartItem.id)"
                      class="font-medium text-red-600 dark:text-red-500 hover:underline"
                      >Remove</a
                    >
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="p-5 col-span-2 bg-white rounded-lg shadow-md my-5">
            <p class="font-medium text-blue-600 dark:text-gray-400 my-4">
              Payment Methods:
            </p>
            <div class="grid gap-4 sm:grid-cols-2">
              <FormRadioButton
                :label="'Cash on Delivery(COD)'"
                :name="'cash_on_delivery'"
                :error="errors.payment_mode"
                :checked="paymentMode === 'cod'"
                @checked="(value) => (paymentMode = value)"
                :value="'cod'"
              >
              </FormRadioButton>
              <FormRadioButton
                :label="'Online Payment(Stripe)'"
                :name="'stripe'"
                :error="errors.payment_mode"
                :checked="paymentMode === 'stripe'"
                v-if="enable_stripe"
                @checked="(value) => (paymentMode = value)"
                :value="'stripe'"
              >
              </FormRadioButton>
              <FormRadioButton
                :label="'Order on Whatsapp'"
                :name="'whatsapp'"
                :error="errors.payment_mode"
                :checked="paymentMode === 'whatsapp'"
                v-if="enable_whatsapp"
                @checked="(value) => (paymentMode = value)"
                :value="'whatsapp'"
              >
              </FormRadioButton>
            </div>
            <div>
              <Errors></Errors>
              <div class="flex items-center space-x-4 mt-6">
                <Button
                  @click.prevent="submitCheckout()"
                  :text="'Complete Checkout'"
                  :color="'blue'"
                  :fullWidth="true"
                ></Button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { router } from "@inertiajs/vue3";

export default {
  props: ["errors", "userInfo", "enable_stripe", "enable_whatsapp"],
  data() {
    return {
      cartContent: this.$page.props.cartContent,
      orderInfoShippingAddress: this.userInfo,
      errors: this.$page.props.errors,
      paymentMode: "cod",
    };
  },
  methods: {
    quantityDown(cartItemId) {
      this.cartContent[cartItemId].quantity > 1
        ? this.cartContent[cartItemId].quantity--
        : (this.cartContent[cartItemId].quantity = 1);
      this.cartItemUpdate(cartItemId, this.cartContent[cartItemId].quantity);
    },
    quantityUp(cartItemId) {
      this.cartContent[cartItemId].quantity++;
      this.cartItemUpdate(cartItemId, this.cartContent[cartItemId].quantity);
    },
    cartItemUpdate(cartItemId, quantity) {
      console.log(quantity);
      this.cartContent[cartItemId].quantity = quantity;
      router.post(
        "/cart/update",
        { id: cartItemId, quantity: quantity },
        { preserveScroll: true, preserveState: true }
      );
    },
    cartItemRemove(cartId) {
      router.post(
        "/cart/remove",
        { id: cartId },
        {
          preserveScroll: true,
          preserveState: false,
          only: ["cartContent", "cartTotal", "cartCount"],
        }
      );
    },
    submitCheckout() {
      console.log(this.paymentMode);
      var dataToSend = {
        ...{ shippingAddress: this.orderInfoShippingAddress },
        ...{ payment_mode: this.paymentMode },
      };
      router.post("/checkout", dataToSend, {
        preserveState: false,
        preserveScroll: false,
        only: ["errors"],
      });
    },
  },
};
</script>
<script setup>
import FormInput from "../../Shared/FormComponents/FormInput.vue";
import Button from "../../Shared/FormComponents/Button.vue";
import Errors from "../../Shared/FormComponents/Errors.vue";
import FormRadioButton from "../../Shared/FormComponents/FormRadioButton.vue";
</script>
