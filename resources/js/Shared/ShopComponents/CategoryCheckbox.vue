<template>
    <div class="flex items-center">
        <input
            type="checkbox"
            name="cat-2"
            :value="category.slug" 
            v-model="isChecked"
            id="cat-2"
            @change="$emit('checked',isChecked)"
            class="text-primary focus:ring-0 rounded-sm cursor-pointer"
        />
        <label for="cat-2" class="text-gray-600 ml-3 cusror-pointer"
            >{{ category.name }}</label
        >
        <div class="ml-auto text-gray-600 text-sm">(9)</div>
    </div>
</template>
<script setup>
defineProps({
    category:Object,
    oldSelectedCat:Object
})
</script>
<script>
export default {
    emits: ['checked'],
    mounted() {
        console.log(this.oldSelectedCat);
    },
    data(){
        return {
            isChecked: (Object.values(this.oldSelectedCat ?? {}).includes(this.category.slug))
        }
    }
}
</script>

