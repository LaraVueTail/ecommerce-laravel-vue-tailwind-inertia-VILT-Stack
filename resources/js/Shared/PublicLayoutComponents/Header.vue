<template>
        <!-- header -->
        <header class="py-4 shadow-sm bg-white">
        <div class="container flex items-center justify-between">

            <SiteLogo></SiteLogo>
            <SearchBar class="w-full hidden md:flex"></SearchBar>

            <div class="flex items-center space-x-4">

                <!-- <WishlistIcon></WishlistIcon> -->

                <CartIcon></CartIcon>

                <AccountIcon></AccountIcon>


            </div>
        </div>
    </header>

    
    <!-- ./header -->
</template>

<script setup>
import SiteLogo from '../SiteLogo.vue'
import SearchBar from '../SearchBar.vue'
import WishlistIcon from '../WishlistIcon.vue'
import CartIcon from '../CartIcon.vue'
import AccountIcon from '../AccountIcon.vue'
</script>