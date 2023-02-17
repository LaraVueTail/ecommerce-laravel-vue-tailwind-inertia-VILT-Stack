<template>
    <div class="container py-10 space-y-5">
        <!-- <h3 class="text-3xl font-bold text-gray-800">
            Welcome, {{ this.$page.props.auth.username }}
        </h3>
        <p>Hello, Welcome you your shop dashboard</p> -->
        <h3 class="text-2xl font-medium text-gray-600">Shipping Address</h3>
        <form action="" method="post" @submit.prevent="submit">
            <!-- info -->
            <div class="rounded pb-7 w-96">
                <div class="space-y-4">
                    <div class="grid gap-4">
                        <div>
                            <label for="address_line_1">Address Line 1</label>
                            <input
                                v-model="form.address_line_1"
                                type="text"
                                name="address_line_1"
                                id="address_line_1"
                                class="input-box"
                            />
                        </div>
                        <div>
                            <label for="address_line_2">Address Line 2</label>
                            <input
                                v-model="form.address_line_2"
                                type="text"
                                name="address_line_2"
                                id="address_line_2"
                                class="input-box"
                            />
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
                        </div>
                        <!-- <div>
                            <label for="gender">Gender</label>
                            <select
                                name="gender"
                                id="gender"
                                class="input-box"
                                v-model="form.gender"
                            >
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Others">Others</option>
                            </select>
                        </div> -->
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
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <button
                        type="submit"
                        class="w-full md:w-48 py-3 px-4 text-center text-white bg-primary border border-primary rounded-md hover:bg-transparent hover:text-primary transition font-medium"
                    >
                        save changes
                    </button>
                </div>
            </div>
            <!-- ./info -->
        </form>
    </div>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";

let props = defineProps({
    userInfo: Object,
});
let userInfo = props.userInfo;
let form = useForm(userInfo);
let submit = ()=>{
    form.post(`/dashboard/${userInfo.id}`)
}
</script>
