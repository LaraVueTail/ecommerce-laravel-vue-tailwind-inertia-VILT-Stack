
import { Link } from '@inertiajs/vue3';

<template>
    <Link
        href="/cart"
        class="text-center text-gray-700 hover:text-primary transition relative"
    >
        <div class="text-lg md:text-2xl">
            <i class="fa-solid fa-bag-shopping"></i>
        </div>
        <div class="text-xs leading-3">Cart</div>
        <div
            class="absolute -right-3 -top-1 w-5 h-5 rounded-full flex items-center justify-center bg-primary text-white text-xs"
        >
            {{ this.$page.props.cartCount ?? 0 }}
        </div>
    </Link>
</template>
