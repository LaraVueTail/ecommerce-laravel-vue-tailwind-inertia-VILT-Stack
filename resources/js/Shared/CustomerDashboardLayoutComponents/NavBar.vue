<template>
    <div class="bg-gray-800 py-4">
        <div
            class="container flex items-center text-white font-medium justify-between"
        >
            <h3 class="text-2xl">Dashboard</h3>
            <div
                class="text-white p-2 md:hidden"
                :class="{ 'rounded bg-slate-500': dropdown }"
                @click="dropdown = !dropdown"
            >
                <i class="text-2xl fa-solid fa-bars"></i>
            </div>

            <div class="hidden md:flex items-center space-x-10 py-6">
                <div class="hidden md:flex items-center space-x-10">
                    <Link href="/dashboard">
                        <h3 class="hover:text-primary cursor-pointer">
                            Manage Account
                        </h3>
                    </Link>

                    <Link href="/dashboard/manage-address">
                        <h3 class="hover:text-primary cursor-pointer">
                            Manage Address
                        </h3>
                    </Link>
                    <Link href="/dashboard/orders">
                        <h3 class="hover:text-primary cursor-pointer">
                            Manage Orders
                        </h3>
                    </Link>
                </div>

                <button
                    class="bg-white text-black rounded px-2 py-1 hover:bg-primary hover:text-white"
                    @click="$refs.logoutForm.submit()"
                >
                    Logout
                </button>
            </div>
        </div>
    </div>

    <div
        class="w-full absolute bg-gray-800 before:border-b-2 shadow-md z-10 divide-y divide-dashed text-md text-white transition opacity-0"
        :class="{ 'opacity-100': dropdown, hidden: !dropdown }"
    >
        <Link href="/"
            ><h3 class="py-3 pl-8 hover:bg-gray-500">Manage Account</h3></Link
        >
        <Link href="/dashboard/manage-address"
            ><h3 class="py-3 pl-8 hover:bg-gray-500">Manage Address</h3></Link
        >
        <Link href="/dashboard"
            ><h3 class="py-3 pl-8 hover:bg-gray-500">Order Details</h3></Link
        >
        <div class="py-3 pl-8">
            <button
                class="rounded py-1 hover:bg-primary hover:text-white"
                @click="$refs.logoutForm.submit()"
            >
                Logout
            </button>
        </div>
    </div>
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
