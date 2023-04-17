<template>
  <CustomerDashboardLayoutVue>
    <div
      class="relative p-4 bg-white border border-gray-200 rounded-lg shadow dark:border-gray-700 dark:bg-gray-800 sm:p-5"
    >
      <!-- Modal body -->
      <form action="#" @submit.prevent="">
        <div>
          <div class="grid gap-4 mb-4">
            <div class="pr-5 border-r">
              <p class="font-medium text-blue-600 dark:text-gray-400 my-4">
                Shipping Address:
              </p>
              <div class="grid gap-4 sm:grid-cols-2">
                <FormInput
                  :label="'First Name'"
                  :name="'first_name'"
                  :type="'text'"
                  v-model="orderInfoShippingAddress.first_name"
                ></FormInput>
                <FormInput
                  :label="'last Name'"
                  :name="'last_name'"
                  :type="'text'"
                  v-model="orderInfoShippingAddress.last_name"
                ></FormInput>
              </div>
              <div class="grid gap-4 sm:grid-cols-2">
                <FormInput
                  :label="'Email'"
                  :name="'email'"
                  :type="'email'"
                  v-model="orderInfoShippingAddress.email"
                ></FormInput>
                <FormInput
                  :label="'Phone Number'"
                  :name="'phone_number'"
                  :type="'text'"
                  v-model="orderInfoShippingAddress.phone_number"
                ></FormInput>
              </div>
              <div class="grid gap-4 sm:grid-cols-2">
                <FormInput
                  :label="'Address Line 1'"
                  :name="'address_line_1'"
                  :type="'text'"
                  v-model="orderInfoShippingAddress.address_line_1"
                ></FormInput>
                <FormInput
                  :label="'Address Line 2'"
                  :name="'address_line_2'"
                  :type="'text'"
                  v-model="orderInfoShippingAddress.address_line_2"
                ></FormInput>
              </div>
              <div class="grid gap-4 sm:grid-cols-2">
                <FormInput
                  :label="'City'"
                  :name="'city'"
                  :type="'text'"
                  v-model="orderInfoShippingAddress.city"
                ></FormInput>
                <FormInput
                  :label="'Pin code'"
                  :name="'pin_code'"
                  :type="'text'"
                  v-model="orderInfoShippingAddress.pin_code"
                ></FormInput>
              </div>
              <div class="grid gap-4 sm:grid-cols-2">
                <FormInput
                  :label="'Country'"
                  :name="'country'"
                  :type="'text'"
                  v-model="orderInfoShippingAddress.country"
                ></FormInput>
              </div>
            </div>
          </div>
        </div>

        <div>
          <Errors :errors="errors ?? false"></Errors>

          <div class="flex items-center space-x-4">
            <Button @click.prevent="update()" :text="'Update'" :color="'blue'"></Button>
          </div>
        </div>
      </form>
    </div>
  </CustomerDashboardLayoutVue>
  <!-- Modal content -->
</template>
<script>
import { router } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";
export default {
  props: ["user", "errors"],
  data() {
    return {
      userInfo: this.user,
      orderInfoShippingAddress: JSON.parse(this.order.shipping_address),
      orderContent: JSON.parse(this.order.cart_content),
      newOrderItem: {},
      form: {},
    };
  },
  computed: {
    totalAmount() {
      var total = 0;
      this.orderContent.forEach((element) => {
        total += element.price * element.quantity;
      });
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
    deleteOrder() {
      window.scrollTo(0, 0);
      this.deleteAlertOrder = true;
      this.deleteAlertOrderText = `Deleting the Order will permanently removed from the database. You can't recover the
          order again. Are you sure about deleting?`;
      setTimeout(() => (this.deleteAlertOrder = false), 5000);
    },
    deleteOrderConfirm() {
      console.log("dd");
      router.delete(`/admin-dashboard/orders/${this.order.id}`);
    },
    updateOrder() {
      this.orderInfo.shipping_address = JSON.stringify(this.orderInfoShippingAddress);
      this.orderInfo.cart_content = JSON.stringify(this.orderContent);
      this.form = useForm(this.orderInfo);
      console.log(this.orderInfo);
      this.form.put(`/admin-dashboard/orders/${this.order.id}`, {
        preserveScroll: true,
      });
    },
  },
};
</script>
<script setup>
import { onMounted, onUpdated } from "vue";
import { initFlowbite } from "flowbite";
import FormInput from "../../../Shared/AdminDashboardLayoutComponents/FormInput.vue";
import Button from "../../../Shared/AdminDashboardLayoutComponents/Button.vue";
import Errors from "../../../Shared/AdminDashboardLayoutComponents/Errors.vue";
import CustomerDashboardLayoutVue from "../../../Shared/CustomerDashboard/CustomerDashboardLayout.vue";

onMounted(() => {
  initFlowbite();
});
onUpdated(() => {
  initFlowbite();
});
</script>
