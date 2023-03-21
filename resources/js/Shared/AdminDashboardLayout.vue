<template>
    <NavBar></NavBar>
    <SideBar></SideBar>



    <div class="p-4 sm:ml-64">

        <slot></slot>
        <!-- <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
          <div class="grid grid-cols-3 gap-4 mb-4">
             <div class="flex items-center justify-center h-24 rounded bg-gray-50 dark:bg-gray-800">
                <p class="text-2xl text-gray-400 dark:text-gray-500">+</p>
             </div>
             <div class="flex items-center justify-center h-24 rounded bg-gray-50 dark:bg-gray-800">
                <p class="text-2xl text-gray-400 dark:text-gray-500">+</p>
             </div>
             <div class="flex items-center justify-center h-24 rounded bg-gray-50 dark:bg-gray-800">
                <p class="text-2xl text-gray-400 dark:text-gray-500">+</p>
             </div>
          </div>
          <div class="flex items-center justify-center h-48 mb-4 rounded bg-gray-50 dark:bg-gray-800">
             <p class="text-2xl text-gray-400 dark:text-gray-500">+</p>
          </div>
          <div class="grid grid-cols-2 gap-4 mb-4">
             <div class="flex items-center justify-center rounded bg-gray-50 h-28 dark:bg-gray-800">
                <p class="text-2xl text-gray-400 dark:text-gray-500">+</p>
             </div>
             <div class="flex items-center justify-center rounded bg-gray-50 h-28 dark:bg-gray-800">
                <p class="text-2xl text-gray-400 dark:text-gray-500">+</p>
             </div>
             <div class="flex items-center justify-center rounded bg-gray-50 h-28 dark:bg-gray-800">
                <p class="text-2xl text-gray-400 dark:text-gray-500">+</p>
             </div>
             <div class="flex items-center justify-center rounded bg-gray-50 h-28 dark:bg-gray-800">
                <p class="text-2xl text-gray-400 dark:text-gray-500">+</p>
             </div>
          </div>
          <div class="flex items-center justify-center h-48 mb-4 rounded bg-gray-50 dark:bg-gray-800">
             <p class="text-2xl text-gray-400 dark:text-gray-500">+</p>
          </div>
          <div class="grid grid-cols-2 gap-4">
             <div class="flex items-center justify-center rounded bg-gray-50 h-28 dark:bg-gray-800">
                <p class="text-2xl text-gray-400 dark:text-gray-500">+</p>
             </div>
             <div class="flex items-center justify-center rounded bg-gray-50 h-28 dark:bg-gray-800">
                <p class="text-2xl text-gray-400 dark:text-gray-500">+</p>
             </div>
             <div class="flex items-center justify-center rounded bg-gray-50 h-28 dark:bg-gray-800">
                <p class="text-2xl text-gray-400 dark:text-gray-500">+</p>
             </div>
             <div class="flex items-center justify-center rounded bg-gray-50 h-28 dark:bg-gray-800">
                <p class="text-2xl text-gray-400 dark:text-gray-500">+</p>
             </div>
          </div>
       </div> -->
    </div>
</template>
<script setup>
import { onMounted } from 'vue'
import { initFlowbite } from 'flowbite'
import NavBar from './AdminDashboardLayoutComponents/NavBar.vue';
import SideBar from './AdminDashboardLayoutComponents/SideBar.vue';

// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
})
</script>
<script>
export default {
    data() {
        return {
            show: false,
        }
    },
    mounted() {
        this.show = true
        setTimeout(
            () => this.show = false,
            2000
        )
    },
    watch: {
        flash: {
            deep: true,
            handler(val, oldVal) {
                this.show = true
                setTimeout(
                    () => this.show = false,
                    2000
                )
            },
        },
    },
    computed: {
        flash() {
            return this.$page.props.flash
        },
    },
}
</script>