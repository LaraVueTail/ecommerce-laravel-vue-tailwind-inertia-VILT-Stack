<template>
    <!-- header -->
    <header class="py-4 shadow-sm bg-white">
        <div class="container flex items-center justify-between">
            <a href="index.html">
                <img
                    src="assets/images/logo.svg"
                    alt="Logo"
                    class="w-24 md:w-32"
                />
            </a>

            <div class="flex items-center space-x-6 text-gray-700">
                <div class="hidden md:flex space-x-10 items-center">
                    <h3 class="font-medium hover:text-primary cursor-pointer">
                        Home
                    </h3>
                    <h3 class="font-medium hover:text-primary cursor-pointer">
                        Shop
                    </h3>
                    <h3 class="font-medium hover:text-primary cursor-pointer">
                        About
                    </h3>
                    <h3 class="font-medium hover:text-primary cursor-pointer">
                        Contact
                    </h3>
                </div>

                <div
                    class="text-gray-800 p-2 md:hidden"
                    :class="{ 'rounded bg-slate-500': dropdown }"
                    @click="dropdown = !dropdown"
                @mouseout="dropdown = false"

                >
                    <i class="text-2xl fa-solid fa-bars"></i>
                </div>

                <a
                    href="#"
                    class="text-center text-gray-700 hover:text-primary transition relative"
                >
                    <div class="text-lg md:text-2xl">
                        <i class="fa-solid fa-bag-shopping"></i>
                    </div>
                    <div class="text-xs leading-3">Cart</div>
                    <div
                        class="absolute -right-3 -top-1 w-5 h-5 rounded-full flex items-center justify-center bg-primary text-white text-xs"
                    >
                        2
                    </div>
                </a>
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
