<template>
    <nav class="bg-gray-800">
        <div class="container hidden md:flex">
            <CategoryDropdown></CategoryDropdown>

            <div class="flex items-center justify-between flex-grow pl-12">
                <PageNav class="text-white"></PageNav>
                <div>
                    <div
                        v-if="$page.props.auth.firstName"
                        class="flex items-center space-x-4"
                    >
                        <h3 class="text-white">
                            Welcome, {{ $page.props.auth.firstName }}
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
            <SearchBar class="w-42 flex"></SearchBar>
            <span
                class="text-white p-2 dropdownIcon"
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
<script setup>
import CategoryDropdown from "../CategoryDropdown.vue";
import PageNav from "../PageNav.vue";
import SearchBar from "../SearchBar.vue";
</script>
