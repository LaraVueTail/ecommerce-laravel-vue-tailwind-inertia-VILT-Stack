<template>
    <div class="container py-10 space-y-5">
        <h3 class="text-3xl font-bold text-gray-800">Orders</h3>
        <p>Your past orders</p>
        <div
            class="border p-5 rounded grid grid-cols-4 gap-1"
            v-for="order in orders"
            :key="order"
        >
            <div class="text-lg text-gray-700">
                <h3 class="text-primary font-semibold">Order Date</h3>
                <h3 class="text-lg text-gray-700">{{ toDate(order.updated_at) }}</h3>
            </div>
            <div>
                <h3 class="text-lg text-primary font-semibold">
                    Ordered Items
                </h3>
                <div
                    class="text-lg text-gray-700 grid grid-cols-3 gap-1"
                    v-for="cartItem in JSON.parse(order.cart_content)"
                    :key="cartItem"
                >
                    <div>{{ cartItem.name }}</div>
                    <div>x</div>
                    <div>{{ cartItem.quantity }}</div>
                    <!-- <div>{{ cartItem.price }}</div> -->
                </div>
            </div>
            <div class="text-lg text-gray-700">
                <h3 class="text-primary font-semibold">Total Price</h3>
                <h3 class="text-lg text-gray-700">{{ order.total_price }}</h3>
            </div>
            <div class="text-lg text-gray-700">
                <h3 class="text-primary font-semibold">Payment Status</h3>
                <h3 class="text-lg text-gray-700">{{ order.status }}</h3>
            </div>
        </div>
    </div>

</template>
<script>
export default {
    props: ["orders"],
    // computed:{
    //     toDate(date){
    //         var d = new Date(date)
    //         return d.toDateString
    //     }
    // },
    methods:{
        toDate(date){
            console.log(date);
            var d = new Date(date)
            let text = d.toDateString();
            return text
        }
    }
};
</script>
