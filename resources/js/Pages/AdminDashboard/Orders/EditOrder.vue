<template>
    <section
        class="dark:bg-gray-900 h-screen overflow-x-hidden md:overflow-x-visible p-1"
    >
        <div class="mx-auto max-w-screen-xl px-1 lg:px-12 my-11">
            <!-- Modal content -->
            <div
                class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5"
            >
                <!-- Modal header -->
                <div
                    class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600"
                >
                    <h5
                        class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"
                    >
                        Edit - Order #{{ order.id }}
                    </h5>
                    <button
                        type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-6 h-6"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99"
                            />
                        </svg>

                        <span class="sr-only">Refresh</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form action="#">
                    <div>
                        <div class="grid gap-4 mb-4 grid-col-1 sm:grid-cols-3">
                            <div class="sm:col-span-2">
                                <p
                                    class="font-medium text-blue-600 dark:text-gray-400 my-4"
                                >
                                    Shipping Adrress:
                                </p>
                                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                                    <div>
                                        <label
                                            for="first_name"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                            >First Name</label
                                        >
                                        <input
                                            type="text"
                                            name="first_name"
                                            id="first_name"
                                            v-model="
                                                orderInfoShippingAddress.first_name
                                            "
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Ex. Apple iMac 27&ldquo;"
                                        />
                                    </div>
                                    <div>
                                        <label
                                            for="last_name"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                            >Last Name</label
                                        >
                                        <input
                                            type="text"
                                            name="last_name"
                                            id="last_name"
                                            v-model="
                                                orderInfoShippingAddress.last_name
                                            "
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Ex. Apple iMac 27&ldquo;"
                                        />
                                    </div>
                                    <div>
                                        <label
                                            for="email"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                            >Email</label
                                        >
                                        <input
                                            type="email"
                                            name="email"
                                            id="email"
                                            v-model="
                                                orderInfoShippingAddress.email
                                            "
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Ex. Apple iMac 27&ldquo;"
                                        />
                                    </div>
                                    <div>
                                        <label
                                            for="phone_number"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                            >Phone Number</label
                                        >
                                        <input
                                            type="text"
                                            name="phone_number"
                                            id="phone_number"
                                            v-model="
                                                orderInfoShippingAddress.phone_number
                                            "
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Ex. Apple iMac 27&ldquo;"
                                        />
                                    </div>
                                    <div>
                                        <label
                                            for="address_line_1"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                            >Address Line 1</label
                                        >
                                        <input
                                            type="text"
                                            name="address_line_1"
                                            id="address_line_1"
                                            v-model="
                                                orderInfoShippingAddress.address_line_1
                                            "
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Ex. Apple iMac 27&ldquo;"
                                        />
                                    </div>
                                    <div>
                                        <label
                                            for="address_line_2"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                            >Address Line 2</label
                                        >
                                        <input
                                            type="text"
                                            name="address_line_2"
                                            id="address_line_2"
                                            v-model="
                                                orderInfoShippingAddress.address_line_2
                                            "
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Ex. Apple iMac 27&ldquo;"
                                        />
                                    </div>
                                    <div>
                                        <label
                                            for="city"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                            >City</label
                                        >
                                        <input
                                            type="text"
                                            name="city"
                                            id="city"
                                            v-model="
                                                orderInfoShippingAddress.city
                                            "
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Ex. Apple iMac 27&ldquo;"
                                        />
                                    </div>
                                    <div>
                                        <label
                                            for="pin_code"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                            >Pin code</label
                                        >
                                        <input
                                            type="text"
                                            name="pin_code"
                                            id="pin_code"
                                            v-model="
                                                orderInfoShippingAddress.pin_code
                                            "
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Ex. Apple iMac 27&ldquo;"
                                        />
                                    </div>
                                    <div>
                                        <label
                                            for="country"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                            >Country</label
                                        >
                                        <input
                                            type="text"
                                            name="country"
                                            id="country"
                                            v-model="
                                                orderInfoShippingAddress.country
                                            "
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Ex. Apple iMac 27&ldquo;"
                                        />
                                    </div>
                                </div>
                            </div>
                            <!-- <div>
                            <label
                                for="brand"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                >Brand</label
                            >
                            <input
                                type="text"
                                name="brand"
                                id="brand"
                                value="Google"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Ex. Apple"
                            />
                        </div>
                        <div>
                            <label
                                for="price"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                >Price</label
                            >
                            <input
                                type="number"
                                value="399"
                                name="price"
                                id="price"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="$299"
                            />
                        </div> -->

                            <div class="bg-blue-100 px-3 rounded pb-4">
                                <p
                                    class="font-medium text-blue-600 dark:text-gray-400 my-4"
                                >
                                    Order details:
                                </p>
                                <div>
                                    <label
                                        for="status"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                        >Order Status</label
                                    >
                                    <select
                                        id="status"
                                        :value="order.status"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 mb-4"
                                    >
                                        <option
                                            :selected="order.status === status"
                                            v-for="status in [
                                                'unpaid',
                                                'paid',
                                                'shipped',
                                                'delivered',
                                                'cancelled',
                                            ]"
                                            :key="status"
                                            :value="status"
                                        >
                                            {{ status }}
                                        </option>
                                        <!-- <option value="TV">TV/Monitors</option>
                                <option value="PC">PC</option>
                                <option value="GA">Gaming/Console</option>
                                <option value="PH">Phones</option> -->
                                    </select>
                                </div>
                                <div>
                                    <label
                                        for="description"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                        >Description</label
                                    >
                                    <textarea
                                        id="description"
                                        rows="5"
                                        v-model="order.cart_content"
                                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Write a description..."
                                    ></textarea
                                    >
                                </div>
                            </div>

                            <!-- <div class="sm:col-span-2">
                            <label
                                for="description"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                >Description</label
                            >
                            <textarea
                                id="description"
                                rows="5"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Write a description..."
                            >
Standard glass, 3.8GHz 8-core 10th-generation Intel Core i7 processor, Turbo Boost up to 5.0GHz, 16GB 2666MHz DDR4 memory, Radeon Pro 5500 XT with 8GB of GDDR6 memory, 256GB SSD storage, Gigabit Ethernet, Magic Mouse 2, Magic Keyboard - US</textarea
                            >
                        </div> -->
                        </div>
                    </div>

                    <div class="flex items-center space-x-4">
                        <button
                            type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        >
                            Update product
                        </button>
                        <button
                            type="button"
                            class="text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900"
                        >
                            <svg
                                class="mr-1 -ml-1 w-5 h-5"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                    clip-rule="evenodd"
                                ></path>
                            </svg>
                            Delete
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</template>
<script>
export default {
    props: ["order"],
    data() {
        return {
            orderInfo: this.order,
            orderInfoShippingAddress: JSON.parse(this.order.shipping_address),
        };
    },
};
</script>
<script setup>
import { onMounted, onUpdated } from "vue";
import { initFlowbite } from "flowbite";
onMounted(() => {
    initFlowbite();
});
onUpdated(() => {
    initFlowbite();
});
</script>
