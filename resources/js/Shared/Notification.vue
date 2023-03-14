<script>
export default {
}
</script>

<template>
  <div class="relative">
    <div v-if="$page.props.flash.success"
      class="absolute top-0 left-0 right-0 m-5 p-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800 shadow-md flex justify-between place-content-center"
      role="alert">
      <div class="font-medium">
        {{ $page.props.flash.success }}
      </div>
      <!-- <div @click="show = !show" class="hover:text-gray-900 font-medium cursor-pointer">x</div> -->
    </div>
  </div>
</template>