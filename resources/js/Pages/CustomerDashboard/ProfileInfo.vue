<template>
    <div class="container py-10 space-y-5">
        <h3 class="text-3xl font-bold text-gray-800">
            Welcome, {{ this.$page.props.auth.username }}
        </h3>
        <p>Hello, Welcome you your shop dashboard</p>
        <h3 class="text-2xl font-medium text-gray-600">Personal Info</h3>
        <form action="" method="post" @submit.prevent="submit">
            <!-- info -->
            <div class="col-span-9 rounded pb-7">
                <div class="space-y-4">
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label for="first">First name</label>
                            <input
                                v-model="form.first_name"
                                type="text"
                                name="first"
                                id="first"
                                class="input-box"
                            />
                        </div>
                        <div>
                            <label for="last">Last name</label>
                            <input
                                v-model="form.last_name"
                                type="text"
                                name="last"
                                id="last"
                                class="input-box"
                            />
                        </div>
                    </div>
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label for="birthday">Birthday</label>
                            <input
                                v-model="form.birthday"
                                type="date"
                                name="birthday"
                                id="birthday"
                                class="input-box"
                            />
                        </div>
                        <div>
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
                        </div>
                    </div>
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label for="email">Email Address</label>
                            <input
                                v-model="form.email"
                                type="email"
                                name="email"
                                id="email"
                                class="input-box"
                            />
                        </div>
                        <div>
                            <label for="phone">Phone number</label>
                            <input
                                v-model="form.phone_number"
                                type="text"
                                name="phone"
                                id="phone"
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
// let form = useForm({
//     first_name:userInfo.first_name,
//     last_name:userInfo.last_name,
//     birthday:userInfo.birthday,
//     gender:userInfo.gender,
//     email:userInfo.email,
//     phone_number:userInfo.phone_number
// });
let submit = ()=>{
    form.post(`/dashboard/${userInfo.id}`)
}
</script>
