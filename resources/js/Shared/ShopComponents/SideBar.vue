<template>
    <!-- sidebar -->
    <div
        class="col-span-12 md:col-span-1 bg-white px-4 md:pb-6 md:shadow rounded overflow-hidden"
    >
        <div class="block md:hidden">
            <h3
                class="text-center text-md text-gray-800 font medium py-2 rounded border border-gray-400 hover:bg-primary hover:text-white"
                @click="dropdown=!dropdown"
            >
                Filters
            </h3>
        </div>

        <div
            class="divide-y divide-gray-200 space-y-5 transition ease-in-out delay-150 duration-1000"
            :class="{ '-translate-y-0 opacity-100 block mt-3 md:block': dropdown,'opacity-0 md:opacity-100 md:-translate-y-0 -translate-y-10 hidden md:block':!dropdown }"
        >
            <div>
                <h3 class="text-xl text-gray-800 mb-3 uppercase font-medium">
                    Categories
                </h3>
                <div class="space-y-2">
                    <CategoryCheckbox
                        v-for="category in categories"
                        :key="category"
                        :category="category"
                        :oldSelectedCat="oldSelectedCat"
                        @checked="
                            (ischecked) => checkedCat(ischecked, category)
                        "
                    ></CategoryCheckbox>
                </div>
            </div>

            <!-- <BrandCheckbox></BrandCheckbox> -->

            <div class="pt-4">
                <h3 class="text-xl text-gray-800 mb-3 uppercase font-medium">
                    Price
                </h3>
                <div class="mt-4 flex items-center">
                    <input
                        type="number"
                        min="0"
                        :max="maxPrice"
                        name="min"
                        v-model="minPrice"
                        id="min"
                        @change="sendRequest()"
                        class="w-full border-gray-300 focus:border-primary rounded focus:ring-0 px-3 py-1 text-gray-600 shadow-sm"
                        placeholder="min"
                    />
                    <span class="mx-3 text-gray-500">-</span>
                    <input
                        type="number"
                        name="max"
                        id="max"
                        :min="minPrice ?? 0"
                        v-model="maxPrice"
                        @change="sendRequest()"
                        class="w-full border-gray-300 focus:border-primary rounded focus:ring-0 px-3 py-1 text-gray-600 shadow-sm"
                        placeholder="max"
                    />
                </div>
            </div>

            <!-- <div class="pt-4">
                    <h3 class="text-xl text-gray-800 mb-3 uppercase font-medium">size</h3>
                    <div class="flex items-center gap-2">
                        <div class="size-selector">
                            <input type="radio" name="size" id="size-xs" class="hidden">
                            <label for="size-xs"
                                class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600">XS</label>
                        </div>
                        <div class="size-selector">
                            <input type="radio" name="size" id="size-sm" class="hidden">
                            <label for="size-sm"
                                class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600">S</label>
                        </div>
                        <div class="size-selector">
                            <input type="radio" name="size" id="size-m" class="hidden">
                            <label for="size-m"
                                class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600">M</label>
                        </div>
                        <div class="size-selector">
                            <input type="radio" name="size" id="size-l" class="hidden">
                            <label for="size-l"
                                class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600">L</label>
                        </div>
                        <div class="size-selector">
                            <input type="radio" name="size" id="size-xl" class="hidden">
                            <label for="size-xl"
                                class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600">XL</label>
                        </div>
                    </div>
                </div> -->

            <!-- <div class="pt-4">
                    <h3 class="text-xl text-gray-800 mb-3 uppercase font-medium">Color</h3>
                    <div class="flex items-center gap-2">
                        <div class="color-selector">
                            <input type="radio" name="color" id="red" class="hidden">
                            <label for="red"
                                class="border border-gray-200 rounded-sm h-6 w-6  cursor-pointer shadow-sm block"
                                style="background-color: #fc3d57;"></label>
                        </div>
                        <div class="color-selector">
                            <input type="radio" name="color" id="black" class="hidden">
                            <label for="black"
                                class="border border-gray-200 rounded-sm h-6 w-6  cursor-pointer shadow-sm block"
                                style="background-color: #000;"></label>
                        </div>
                        <div class="color-selector">
                            <input type="radio" name="color" id="white" class="hidden">
                            <label for="white"
                                class="border border-gray-200 rounded-sm h-6 w-6  cursor-pointer shadow-sm block"
                                style="background-color: #fff;"></label>
                        </div>

                    </div>
                </div> -->
        </div>
    </div>
    <!-- ./sidebar -->
</template>
<script setup>
import { useForm, router } from "@inertiajs/vue3";
import CategoryCheckbox from "./CategoryCheckbox.vue";
import BrandCheckbox from "./BrandCheckbox.vue";
let props = defineProps({
    categories: Array,
});
</script>
<script>
export default {
    data() {
        return {
            selectedCat: new Set(),
            oldSelectedCat:  typeof this.$page.props.query.categories !== "undefined"
                ? JSON.parse(this.$page.props.query.categories)
                : null,
            minPrice: this.$page.props.query.minPrice ?? null,
            maxPrice: this.$page.props.query.maxPrice ?? null,
            searchQuery: {},
            dropdown: false ||  Object.keys(this.$page.props.query).length>0
        };
    },
    mounted() {
        this.selectedCat = new Set(Object.values(this.oldSelectedCat ?? {}));
    },
    methods: {
        checkedCat(ischecked, category) {
            if (ischecked) {
                this.selectedCat.add(category.slug);
            } else {
                this.selectedCat.delete(category.slug);
            }
            this.sendRequest();
        },
        sendRequest() {
            this.selectedCat.size > 0
                ? (this.searchQuery.categories = JSON.stringify([
                      ...this.selectedCat,
                  ]))
                : false;
            this.minPrice > 0 || this.maxPrice > 0
                ? Object.assign(this.searchQuery, {
                      minPrice: this.minPrice,
                      maxPrice: this.maxPrice,
                  })
                : false;
            router.get("/shop", this.searchQuery);
        },
    },
};
</script>
