<template>
    <nav class="bg-gray-800">
        <div class="container hidden md:flex">
            <div
                class="px-8 py-4 bg-primary flex items-center cursor-pointer relative group"
            >
                <span class="text-white">
                    <i class="fa-solid fa-bars"></i>
                </span>
                <span class="capitalize ml-2 text-white">All Categories</span>

                <!-- dropdown -->
                <div
                    class="absolute w-full left-0 top-full bg-white shadow-md py-3 divide-y divide-gray-300 divide-dashed opacity-0 group-hover:opacity-100 transition duration-300 invisible group-hover:visible"
                >
                    <a
                        href="#"
                        class="flex items-center px-6 py-3 hover:bg-gray-100 transition"
                    >
                        <img
                            src="../assets/images/icons/sofa.svg"
                            alt="sofa"
                            class="w-5 h-5 object-contain"
                        />
                        <span class="ml-6 text-gray-600 text-sm">Sofa</span>
                    </a>
                    <a
                        href="#"
                        class="flex items-center px-6 py-3 hover:bg-gray-100 transition"
                    >
                        <img
                            src="../assets/images/icons/terrace.svg"
                            alt="terrace"
                            class="w-5 h-5 object-contain"
                        />
                        <span class="ml-6 text-gray-600 text-sm">Terarce</span>
                    </a>
                    <a
                        href="#"
                        class="flex items-center px-6 py-3 hover:bg-gray-100 transition"
                    >
                        <img
                            src="../assets/images/icons/bed.svg"
                            alt="bed"
                            class="w-5 h-5 object-contain"
                        />
                        <span class="ml-6 text-gray-600 text-sm">Bed</span>
                    </a>
                    <a
                        href="#"
                        class="flex items-center px-6 py-3 hover:bg-gray-100 transition"
                    >
                        <img
                            src="../assets/images/icons/office.svg"
                            alt="office"
                            class="w-5 h-5 object-contain"
                        />
                        <span class="ml-6 text-gray-600 text-sm">office</span>
                    </a>
                    <a
                        href="#"
                        class="flex items-center px-6 py-3 hover:bg-gray-100 transition"
                    >
                        <img
                            src="../assets/images/icons/outdoor-cafe.svg"
                            alt="outdoor"
                            class="w-5 h-5 object-contain"
                        />
                        <span class="ml-6 text-gray-600 text-sm">Outdoor</span>
                    </a>
                    <a
                        href="#"
                        class="flex items-center px-6 py-3 hover:bg-gray-100 transition"
                    >
                        <img
                            src="../assets/images/icons/bed-2.svg"
                            alt="Mattress"
                            class="w-5 h-5 object-contain"
                        />
                        <span class="ml-6 text-gray-600 text-sm">Mattress</span>
                    </a>
                </div>
            </div>

            <div class="flex items-center justify-between flex-grow pl-12">
                <div class="flex items-center space-x-6 capitalize">
                    <Link
                        href="/"
                        class="text-gray-200 hover:text-white transition"
                        >Home</Link
                    >
                    <Link
                        href="/shop"
                        class="text-gray-200 hover:text-white transition"
                        >Shop</Link
                    >
                    <Link
                        href="/about"
                        class="text-gray-200 hover:text-white transition"
                        >About us</Link
                    >
                    <Link
                        href="/contact"
                        class="text-gray-200 hover:text-white transition"
                        >Contact us</Link
                    >
                </div>
                <div>
                    <div
                        v-if="$page.props.auth.username"
                        class="flex items-center space-x-4"
                    >
                        <h3 class="text-white">
                            Welcome, {{ $page.props.auth.username }}
                        </h3>
                        <button
                            class="bg-white rounded px-2 py-1 hover:bg-primary hover:text-white"
                            @click="$refs.logoutForm.submit()"
                        >
                            Logout
                        </button>
                    </div>
                    <div v-else>
                        <Link href="login">
                            <button
                                class="bg-white rounded px-2 py-1 hover:bg-primary hover:text-white"
                            >
                                Login/Register
                            </button>
                        </Link>
                    </div>
                </div>
            </div>
        </div>
        <div class="container flex md:hidden py-3 items-center justify-between">
            <div class="w-42 max-w-xl relative flex">
                <span class="absolute left-4 top-3 text-sm text-gray-400">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </span>
                <input
                    type="text"
                    name="search"
                    id="search"
                    class="w-full border border-primary pl-10 py-2 pr-2 rounded focus:outline-none"
                    placeholder="search"
                />
            </div>
            <span
                class="text-white p-2"
                :class="{ 'rounded bg-slate-500': dropdown }"
                @click="dropdown = !dropdown"
            >
                <i class="text-2xl fa-solid fa-bars"></i>
            </span>
        </div>

        <div
            class="w-full absolute bg-gray-800 border-b-2 shadow-md z-10 pt-2 divide-y divide-dashed text-md text-white transition opacity-0"
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
            <div class="py-3 px-8">
                <div
                    v-if="$page.props.auth.username"
                    class="flex items-center space-x-4 justify-between"
                >
                    <h3 class="text-primary">
                        Welcome, {{ $page.props.auth.username }}
                    </h3>
                    <button
                        class="bg-white text-black rounded px-2 py-1 hover:bg-primary hover:text-white"
                        @click="$refs.logoutForm.submit()"
                    >
                        Logout
                    </button>
                </div>
                <div v-else>
                    <Link href="login">
                        <button
                            class="bg-white text-black rounded px-2 py-1 hover:bg-primary hover:text-white"
                        >
                            Login/Register
                        </button>
                    </Link>
                </div>
            </div>
        </div>
    </nav>

    <!-- logout form -->
    <form
        id="logout-form"
        method="POST"
        action="/logout"
        class="hidden"
        ref="logoutForm"
    >
        <input
            type="hidden"
            name="_token"
            :value="this.$page.props.csrf_token"
        />
    </form>
    <!-- ./logout form -->
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
