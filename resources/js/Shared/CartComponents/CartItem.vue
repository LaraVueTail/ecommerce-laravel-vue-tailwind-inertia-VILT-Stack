<template>
    <div
        class="flex items-center justify-between border gap-6 p-4 border-gray-200 rounded"
    >
        <div class="w-1/2 md:w-1/4">
            <img
                src="../assets/images/products/product6.jpg"
                alt="product 6"
                class="w-full"
            />
        </div>
        <div
            class="w-1/2 space-y-4 md:space-y-0 md:w-3/4 md:flex justify-around items-center"
        >
            <div class="">
                <h2 class="text-gray-800 text-md font-medium uppercase">
                    {{ cartItem.name }} - {{ cartItem.id }}
                </h2>
                <p class="text-gray-500 text-sm">Price: {{ cartItem.price }}</p>
            </div>

            <div class="">
                <h3 class="text-sm text-gray-600 mb-1">Quantity</h3>
                <div
                    class="flex border border-gray-300 text-gray-600 divide-x divide-gray-300 w-max"
                >
                    <div
                        class="h-8 w-8 text-xl flex items-center justify-center cursor-pointer select-none"
                        @click="quantity--"
                    >
                        -
                    </div>
                    <div
                        class="h-8 w-8 text-base flex items-center justify-center"
                    >
                        {{ quantity }}
                    </div>
                    <div
                        class="h-8 w-8 text-xl flex items-center justify-center cursor-pointer select-none"
                        @click="quantity++"
                    >
                        +
                    </div>
                </div>
            </div>

            <div class="w-full md:w-auto">
                <a
                    href="#"
                    @click.prevent="removeItem"
                    class="px-6 py-2 text-center text-sm text-white bg-primary border border-primary rounded hover:bg-transparent hover:text-primary transition uppercase font-roboto font-medium"
                    ><i class="fa-solid fa-trash mr-3"></i>Remove</a
                >
            </div>
        </div>
    </div>
</template>
<script setup>
import { useForm } from '@inertiajs/vue3';
import { ref,watch } from 'vue';
const quantity = ref(props.cartItem.quantity)

let props = defineProps({
    cartItem: Object,
    csrf_token:String
});
let form = useForm({
    id: props.cartItem.id,
    quantity:quantity
})
watch(quantity, (newQuantity) => {
  form.post('cart/update',
  {preserveScroll: true})
})

let removeItem = () => {
    form.post('cart/remove',
  {preserveScroll: true})
}
</script>
