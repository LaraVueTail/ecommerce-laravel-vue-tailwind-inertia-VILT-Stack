<template>
    <!-- login -->
    <div class="h-screen md:bg-gray-800">
        <div class="contain py-10 mb-5 px-4 md:px-64">
            <div
                class="bg-white max-w-md mx-auto md:shadow-xl px-6 py-7 rounded overflow-hidden"
            >
                <h2
                    class="text-xl text-center md:text-2xl uppercase font-medium mb-1"
                >
                    Login
                </h2>
                <p class="text-gray-600 mb-6 text-sm text-center">
                    welcome back customer
                </p>
                <form action="#" method="post" autocomplete="off" @submit.prevent="submit">
                    <div class="space-y-2">
                        <div>
                            <label for="email" class="text-gray-600 mb-2 block"
                                >Email address</label
                            >
                            <input
                            v-model="form.email"
                                type="email"
                                name="email"
                                id="email"
                                class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400"
                                placeholder="youremail.@domain.com"
                            />
                        </div>
                        <div>
                            <label
                                for="password"
                                class="text-gray-600 mb-2 block"
                                >Password</label
                            >
                            <input
                            v-model="form.password"
                                type="password"
                                name="password"
                                id="password"
                                class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400"
                                placeholder="*******"
                            />
                        </div>
                    </div>
                    <div class="flex items-center justify-between mt-6">
                        <div class="flex items-center">
                            <input
                                type="checkbox"
                                name="remember"
                                id="remember"
                                class="text-primary focus:ring-0 rounded-sm cursor-pointer"
                            />
                            <label
                                for="remember"
                                class="text-gray-600 ml-2 cursor-pointer text-sm"
                                >Remember me</label
                            >
                        </div>
                        <a href="#" class="text-primary text-sm"
                            >Forgot password</a
                        >
                    </div>
                    <div class="mt-4">
                        <button
                            type="submit"
                            class="block w-full py-2 text-center text-white bg-primary border border-primary rounded hover:bg-transparent hover:text-primary transition uppercase font-roboto font-medium text-sm"
                        >
                            Login
                        </button>
                    </div>
                </form>

                <p class="mt-4 text-center text-gray-600 text-sm">
                    Don't have account?
                    <a href="register.html" class="text-primary text-sm"
                        >Register now</a
                    >
                </p>
            </div>
        </div>
    </div>
    <!-- ./login -->
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';

let props = defineProps({
    csrf_token:String
});

console.log(props);

let form = useForm({
    email:'',
    password:'',
    _token:props.csrf_token,
});

let submit = ()=>{
    form.post('/login')
}
</script>