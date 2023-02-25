<template>
    <!-- header -->
    <header class="py-4 shadow-sm bg-white">
        <div class="container flex items-center justify-between">
            <SiteLogo></SiteLogo>

            <div class="flex items-center space-x-6 text-gray-700">
                <PageNav class="text-gra-600 font-medium"></PageNav>

                <div
                    class="text-gray-800 p-2 md:hidden"
                    :class="{ 'rounded bg-slate-500': dropdown }"
                    @click="dropdown = !dropdown"
                

                >
                    <i class="text-2xl fa-solid fa-bars"></i>
                </div>

                <CartIcon></CartIcon>
            </div>
        </div>


    </header>
    <div
                class="w-full absolute bg-slate-200 before:border-b-2 shadow-md z-10 divide-y divide-dashed text-md text-gray-800 transition opacity-0"
                :class="{ 'opacity-100': dropdown, hidden: !dropdown }"
            >
                <Link href="/"
                    ><h3 class="py-3 pl-8 hover:bg-gray-500">Home</h3></Link
                >
                <Link href="/shop"
                    ><h3 class="py-3 pl-8 hover:bg-gray-500">Shop</h3></Link
                >
                <Link href="/about"
                    ><h3 class="py-3 pl-8 hover:bg-gray-500">About</h3></Link
                >
                <Link href="/contact"
                    ><h3 class="py-3 pl-8 hover:bg-gray-500">Contact</h3></Link
                >
            </div>

    <!-- ./header -->
</template>
<script>

export default {
    data() {
        return {
            dropdown: false,
        };
    },
};
</script>
<script setup>
import SiteLogo from "../SiteLogo.vue";
import PageNav from "../PageNav.vue";
import CartIcon from "../CartIcon.vue";
</script>
