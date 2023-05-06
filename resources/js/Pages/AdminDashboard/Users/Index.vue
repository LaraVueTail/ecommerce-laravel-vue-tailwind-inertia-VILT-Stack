<template>
  <section
    class="dark:bg-gray-900 w-full h-screen overflow-x-hidden md:overflow-x-visible p-1"
  >
    <div class="mx-auto max-w-screen-xl px-1 lg:px-12 pb-10">
      <!-- Start coding here -->
      <h1 class="text-2xl text-gray-800 mb-2 font-poppins py-3 sm:py-2 font-medium">
        Users
      </h1>

      <AlertDelete
        v-if="deleteAlertUser"
        @close="deleteAlertUser = false"
        @confirm="deleteUserConfirm()"
        :text="deleteAlertUserText"
      ></AlertDelete>

      <!-- <Link href="/admin-dashboard/users/create"> -->
      <div class="my-2">
        <Button
          @click.prevent="router.visit('/admin-dashboard/users/create')"
          :text="'+ Add User'"
          :color="'blue'"
        ></Button>
      </div>

      <!-- <button
          type="button"
          class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
        >
          + Add User
        </button> -->
      <!-- </Link> -->

      <div
        class="bg-white dark:bg-gray-800 relative shadow-md rounded-lg border-2 border-gray-200"
      >
        <Filters
          :filters="filters"
          :searchPlaceHolder="'Search by User ID/Name/Email/Phone Number..'"
          :currentPage="users.current_page"
          :dataName="'users'"
          :enableFilters="{
            search: true,
            dateRange: true,
            sortBy: true,
          }"
          :sortByFilters="{ dateSort: true }"
        ></Filters>

        <TableUsers :users="users" @deleteUser="deleteUser"></TableUsers>

        <PageNavigation :data="users"></PageNavigation>
      </div>
    </div>
  </section>
</template>

<script>
import { router } from "@inertiajs/vue3";
export default {
  props: ["users", "filters"],
  data() {
    return {
      deleteAlertUser: false,
      deleteAlertUserText: "",
      userId: null,
    };
  },
  methods: {
    deleteUser(userId) {
      window.scrollTo(0, 0);
      this.deleteAlertUser = true;
      this.userId = userId;
      this.deleteAlertUserText = `Deleting the user will permanently removed from the database. You can't recover the
        user again. Are you sure about deleting?`;
      setTimeout(() => (this.deleteAlertUser = false), 5000);
    },
    deleteUserConfirm() {
      router.delete(`/admin-dashboard/users/${this.userId}`, {
        preserveState: false,
      });
    },
  },
};
</script>
<script setup>
import { onMounted, onUpdated } from "vue";
import { initFlowbite } from "flowbite";
import Filters from "../../../Shared/Filters/Filters.vue";
import TableUsers from "../../../Shared/Tables/TableUsers.vue";
import PageNavigation from "../../../Shared/AdminDashboardComponents/PageNavigation.vue";
import AlertDelete from "../../../Shared/AdminDashboardComponents/AlertDelete.vue";
import Button from "../../../Shared/FormComponents/Button.vue";

onMounted(() => {
  initFlowbite();
});
onUpdated(() => {
  initFlowbite();
});
</script>
