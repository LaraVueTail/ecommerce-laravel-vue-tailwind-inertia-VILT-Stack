<template>
    <div class="container p-9">
        <form action="/checkout" method="post" @submit.prevent="submit">
            <div class="grid grid-cols-2 place-content-center">
                <div>
                    <h2 class="text-3xl font-medium py-6 text-primary">
                        Shipping Address
                    </h2>
                    <div class="rounded pb-7 max-w-md">
                        <div class="space-y-4">
                            <div class="grid gap-4">
                                <div>
                                    <label for="shipping_first_name"
                                        >First Name</label
                                    >
                                    <input
                                        v-model="form.first_name"
                                        type="text"
                                        name="shipping_first_name"
                                        id="shipping_first_name"
                                        class="input-box"
                                    />
                                    <div
                                        v-if="form.errors.first_name"
                                        v-text="form.errors.first_name"
                                        class="text-red-500 text-xs mt-1"
                                    ></div>
                                </div>

                                <div>
                                    <label for="shipping_last_name"
                                        >Last Name</label
                                    >
                                    <input
                                        v-model="form.last_name"
                                        type="text"
                                        name="shipping_last_name"
                                        id="shipping_last_name"
                                        class="input-box"
                                    />
                                    <div
                                        v-if="form.errors.last_name"
                                        v-text="form.errors.last_name"
                                        class="text-red-500 text-xs mt-1"
                                    ></div>
                                </div>
                                <div>
                                    <label for="shipping_phone_number"
                                        >Phone Number</label
                                    >
                                    <input
                                        v-model="form.phone_number"
                                        type="text"
                                        name="shipping_phone_number"
                                        id="shipping_phone_number"
                                        class="input-box"
                                    />
                                    <div
                                        v-if="form.errors.phone_number"
                                        v-text="form.errors.phone_number"
                                        class="text-red-500 text-xs mt-1"
                                    ></div>
                                </div>
                                <div>
                                    <label for="shipping_email">Email</label>
                                    <input
                                        v-model="form.email"
                                        type="email"
                                        name="shipping_email"
                                        id="shipping_email"
                                        class="input-box"
                                    />
                                    <div
                                        v-if="form.errors.email"
                                        v-text="form.errors.email"
                                        class="text-red-500 text-xs mt-1"
                                    ></div>
                                </div>
                                <div>
                                    <label for="address_line_1"
                                        >Address Line 1</label
                                    >
                                    <input
                                        v-model="form.address_line_1"
                                        type="text"
                                        name="address_line_1"
                                        id="address_line_1"
                                        class="input-box"
                                    />
                                    <div
                                        v-if="form.errors.address_line_1"
                                        v-text="form.errors.address_line_1"
                                        class="text-red-500 text-xs mt-1"
                                    ></div>
                                </div>
                                <div>
                                    <label for="address_line_2"
                                        >Address Line 2</label
                                    >
                                    <input
                                        v-model="form.address_line_2"
                                        type="text"
                                        name="address_line_2"
                                        id="address_line_2"
                                        class="input-box"
                                    />
                                    <div
                                        v-if="form.errors.address_line_2"
                                        v-text="form.errors.address_line_2"
                                        class="text-red-500 text-xs mt-1"
                                    ></div>
                                </div>
                            </div>
                            <div class="grid gap-4">
                                <div>
                                    <label for="city">City</label>
                                    <input
                                        v-model="form.city"
                                        type="text"
                                        name="city"
                                        id="city"
                                        class="input-box"
                                    />
                                    <div
                                        v-if="form.errors.city"
                                        v-text="form.errors.city"
                                        class="text-red-500 text-xs mt-1"
                                    ></div>
                                </div>
                            </div>
                            <div class="grid gap-4">
                                <div>
                                    <label for="pin_code">Pin Code</label>
                                    <input
                                        v-model="form.pin_code"
                                        type="text"
                                        name="pin_code"
                                        id="pin_code"
                                        class="input-box"
                                    />
                                    <div
                                        v-if="form.errors.pin_code"
                                        v-text="form.errors.pin_code"
                                        class="text-red-500 text-xs mt-1"
                                    ></div>
                                </div>
                                <div>
                                    <label for="country">Country</label>
                                    <input
                                        v-model="form.country"
                                        type="text"
                                        name="country"
                                        id="country"
                                        class="input-box"
                                    />
                                    <div
                                        v-if="form.errors.country"
                                        v-text="form.errors.country"
                                        class="text-red-500 text-xs mt-1"
                                    ></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <input type="hidden" name="_token" :value=props.csrf_token> -->
                    <!-- <button type="submit">checkkout</button> -->
                </div>
                <div>
                    <h2 class="text-3xl font-medium py-6 text-primary">
                        Cart Details
                    </h2>
                    <h2 class="text-xl font-medium py-2 text-gray-600">
                        Total Items: {{ $page.props.cartCount }}
                    </h2>
                    <h2 class="text-xl font-medium py-2 text-gray-600">
                        Total Amount: {{ $page.props.cartTotal }}
                    </h2>

                    <div class="mt-4">
                        <button
                            type="submit"
                            class="w-full md:w-48 py-3 px-4 text-center text-white bg-primary border border-primary rounded-md hover:bg-transparent hover:text-primary transition font-medium"
                        >
                            Checkout
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>
<script setup>
import { useForm } from "@inertiajs/vue3";

let props = defineProps({
    userInfo: Object,
});
let userInfo = props.userInfo;

console.log(props.userInfo);
let form = useForm(userInfo);
let submit = () => {
    form.post("/checkout");
};
</script>
