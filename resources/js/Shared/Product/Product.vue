<template>
    <div class="bg-white shadow rounded overflow-hidden group">
        <div class="relative">
            <img
                src="assets/images/products/product1.jpg"
                alt="product 1"
                class="w-full"
            />
            <div
                class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100 transition"
            >
                <Link
                    :href="product.link"
                    class="text-white text-lg w-9 h-8 rounded-full bg-primary flex items-center justify-center hover:bg-gray-800 transition"
                    title="view product"
                >
                    <i class="fa-solid fa-magnifying-glass"></i>
                </Link>
                <a
                    href="#"
                    class="text-white text-lg w-9 h-8 rounded-full bg-primary flex items-center justify-center hover:bg-gray-800 transition"
                    title="add to wishlist"
                >
                    <i class="fa-solid fa-heart"></i>
                </a>
            </div>
        </div>
        <div class="pt-4 pb-3 px-4">
            <Link :href="product.link">
                <h4
                    class="font-medium text-sm md:text-xl mb-2 text-gray-800 hover:text-primary transition"
                >
                    {{ product.name }}
                </h4>
            </Link>
            <div class="flex items-baseline mb-1 space-x-2">
                <p class="text-xs md:text-lg text-primary font-semibold">
                    {{ product.price }}
                </p>
                <p class="text-xs text-gray-400 line-through">
                    {{ Math.round(product.price * 140) / 100 }}
                </p>
            </div>
            <div class="flex items-center">
                <div class="flex text-xs text-blue-400">
                    <span><i class="fa-solid fa-star"></i></span>
                    <span><i class="fa-solid fa-star"></i></span>
                    <span><i class="fa-solid fa-star"></i></span>
                    <span><i class="fa-solid fa-star"></i></span>
                    <span><i class="fa-solid fa-star"></i></span>
                </div>
                <div class="text-xs text-gray-500 ml-3">(150)</div>
            </div>
        </div>
        <a
            href="#"
            class="block w-full py-1 text-sm md:text-lg text-center text-white bg-primary border border-primary rounded-b hover:bg-transparent hover:text-primary transition"
            @click.prevent="addToCart"
            >{{ added ? 'Added' : 'Add to cart' }}</a
        >
    </div>
</template>
<script setup>
import { reactive, watch } from 'vue'
import { router,useForm,usePage } from '@inertiajs/vue3'

let props = defineProps({
    product: Object,
    csrf_token:String
});

// let flash =  usePage().props.flash.success

let itemToCart = useForm({
    product:props.product,
    quantity:1,
    _token:props.csrf_token,
});
let added = false
let addToCart = () => {
    added = true
    setTimeout(()=>added=false,500)
    itemToCart.post('/cart/add',{preserveScroll: true})
}
</script>
