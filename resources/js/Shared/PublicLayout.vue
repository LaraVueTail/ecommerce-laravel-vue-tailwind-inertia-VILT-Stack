<template>
    <!-- header -->
    <Header></Header>
    <!-- ./header -->

    <!-- navbar -->
    <NavBar></NavBar>
    <!-- ./navbar -->

    <slot></slot>
    
    <Notification></Notification>
    <!-- footer -->
    <!-- <Footer></Footer> -->
    <!-- ./footer -->

    <!-- copyright -->
    <!-- <CopyRight></CopyRight> -->
    <!-- ./copyright -->
</template>
<script setup>
import Header from "./PublicLayoutComponents/Header.vue";
import NavBar from "./PublicLayoutComponents/NavBar.vue";
import Footer from "./PublicLayoutComponents/Footer.vue";
import CopyRight from "./PublicLayoutComponents/CopyRight.vue";
import Notification from "./Notification.vue";
</script>
