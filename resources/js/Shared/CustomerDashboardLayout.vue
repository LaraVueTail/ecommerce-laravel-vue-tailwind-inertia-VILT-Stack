<template>
    <!-- header -->
    <Header></Header>
    <!-- ./header -->

    <!-- navbar -->
    <NavBar></NavBar>
    <!-- ./navbar -->

    <!-- sidebar -->
    <!-- <Sidebar class="hidden"></Sidebar> -->
    <!-- ./sidebar -->
    <slot></slot>

    <!-- footer -->
    <!-- <Footer></Footer> -->
    <!-- ./footer -->

    <!-- copyright -->
    <!-- <CopyRight></CopyRight> -->
    <!-- ./copyright -->
</template>
<script setup>
import Header from "./CustomerDashboardLayoutComponents/Header.vue";
import Sidebar from "./CustomerDashboardLayoutComponents/Sidebar.vue";
import NavBar from "./CustomerDashboardLayoutComponents/NavBar.vue";
// import Footer from "./CustomerLayoutComponents/Footer.vue";
// import CopyRight from "./CustomerLayoutComponents/CopyRight.vue";
</script>
