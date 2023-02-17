<template>
    <!-- breadcrumb -->
    <Breadcrump
        :routeTree="['Products', product.category.name, product.name]"
    ></Breadcrump>
    <!-- ./breadcrumb -->

    <!-- product-detail -->
    <div class="container grid grid-cols-2 gap-6">
        <!-- product-images -->
        <ProductImages></ProductImages>
        <!-- ./product-images -->

        <div>
            <h2 class="text-3xl font-medium uppercase mb-2">
                {{ product.name }}
            </h2>

            <!-- product-rating -->
            <ProductRating></ProductRating>
            <!-- ./product-rating -->

            <div class="space-y-2">
                <p class="text-gray-800 font-semibold space-x-2">
                    <span>Availability: </span>
                    <span class="text-green-600">{{
                        product.availability
                    }}</span>
                </p>
                <p class="space-x-2">
                    <span class="text-gray-800 font-semibold">Brand: </span>
                    <span class="text-gray-600">{{ product.brand }}</span>
                </p>
                <p class="space-x-2">
                    <span class="text-gray-800 font-semibold">Category: </span>
                    <span class="text-gray-600">{{
                        product.category.name
                    }}</span>
                </p>
                <!-- <p class="space-x-2">
                        <span class="text-gray-800 font-semibold">SKU: </span>
                        <span class="text-gray-600">BE45VGRT</span>
                    </p> -->
            </div>
            <div class="flex items-baseline mb-1 space-x-2 font-roboto mt-4">
                <p class="text-xl text-primary font-semibold">
                    {{ product.price }}
                </p>
                <p class="text-base text-gray-400 line-through">
                    {{ product.price_no_offer }}
                </p>
            </div>

            <p class="mt-4 text-gray-600">
                {{ product.short_description }}
            </p>

            <!-- product-variants -->
            <!-- <ProductVariants></ProductVariants> -->
            <!-- ./product-variants -->

            <!-- quantity -->
            <Quantity></Quantity>
            <!-- ./quantity -->

            <div class="mt-6 flex gap-3 border-b border-gray-200 pb-5 pt-5">
                <AddToCartButton></AddToCartButton>
                <WishlistButton></WishlistButton>
            </div>

            <div class="flex gap-3 mt-4">
                <a
                    href="#"
                    class="text-gray-400 hover:text-gray-500 h-8 w-8 rounded-full border border-gray-300 flex items-center justify-center"
                >
                    <i class="fa-brands fa-facebook-f"></i>
                </a>
                <a
                    href="#"
                    class="text-gray-400 hover:text-gray-500 h-8 w-8 rounded-full border border-gray-300 flex items-center justify-center"
                >
                    <i class="fa-brands fa-twitter"></i>
                </a>
                <a
                    href="#"
                    class="text-gray-400 hover:text-gray-500 h-8 w-8 rounded-full border border-gray-300 flex items-center justify-center"
                >
                    <i class="fa-brands fa-instagram"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- ./product-detail -->

    <!-- details -->
    <ProductDetails :product="product"></ProductDetails>
    <!-- ./details -->

    <!-- related product -->
    <!-- <ProductGrid :products="products">RELATED PRODUCT</ProductGrid> -->
    <!-- ./related product -->
</template>
<script setup>
import ProductDetails from "../../Shared/SingleProductComponents/ProductDetails.vue";
import Breadcrump from "../../Shared/PublicLayoutComponents/Breadcrump.vue";
import ProductImages from "../../Shared/SingleProductComponents/ProductImages.vue";
import ProductRating from "../../Shared/SingleProductComponents/ProductRating.vue";
import ProductVariants from "../../Shared/SingleProductComponents/ProductVariants.vue";
import Quantity from "../../Shared/SingleProductComponents/Quantity.vue";

import AddToCartButton from "../../Shared/Buttons/AddToCartButton.vue";
import WishlistButton from "../../Shared/Buttons/WishlistButton.vue";

import ProductGrid from "../../Shared/Product/ProductGrid.vue";

defineProps({
    product: Object,
});
</script>
