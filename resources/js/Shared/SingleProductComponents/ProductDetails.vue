<template>
            <div class="container pb-16">
            <h3
                class="border-b border-gray-200 font-roboto text-gray-800 pb-3 font-medium"
            >
                Product details
            </h3>
            <div class="w-3/5 pt-6">
                <div class="text-gray-600" v-html="product.description">
                    
                </div>

                <table
                    class="table-auto border-collapse w-full text-left text-gray-600 text-sm mt-6"
                >
                    <tr v-for="(value,key,index) in JSON.parse(product.product_details)" :key="index">
                        <th
                            class="py-2 px-4 border border-gray-300 w-40 font-medium"
                        >
                            {{ key }}
                        </th>
                        <th class="py-2 px-4 border border-gray-300">
                            {{ value }}
                        </th>
                    </tr>
                    <!-- <tr>
                        <th
                            class="py-2 px-4 border border-gray-300 w-40 font-medium"
                        >
                            Material
                        </th>
                        <th class="py-2 px-4 border border-gray-300">Latex</th>
                    </tr>
                    <tr>
                        <th
                            class="py-2 px-4 border border-gray-300 w-40 font-medium"
                        >
                            Weight
                        </th>
                        <th class="py-2 px-4 border border-gray-300">55kg</th>
                    </tr> -->
                </table>
            </div>
        </div>
</template>
<script setup>
defineProps({
    product:Object
})
</script>