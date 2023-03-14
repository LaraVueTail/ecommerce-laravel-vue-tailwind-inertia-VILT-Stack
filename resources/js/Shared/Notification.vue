<script>
export default {
}
</script>

<template>

    <div v-if="$page.props.flash.success"
      class="absolute bottom-0 m-5 p-4 z-50 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800 shadow-md"
      role="alert">
      <div class="font-medium">
        {{ $page.props.flash.success }}
      </div>
      <!-- <div @click="show = !show" class="hover:text-gray-900 font-medium cursor-pointer">x</div> -->
    </div>

</template>