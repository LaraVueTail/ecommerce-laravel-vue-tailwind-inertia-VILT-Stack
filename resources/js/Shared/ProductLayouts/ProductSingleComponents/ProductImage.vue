<template>
  <div class="mx-auto mt-6 max-w-2xl sm:px-6 lg:max-w-7xl lg:px-8 space-y-3 md:hidden">
    <img
      :src="thumbnail"
      @click="$emit('sendToLightbox', thumbnail)"
      class="h-full w-full object-cover object-center md:rounded-lg cursor-pointer"
    />
    <img
      :src="JSON.parse(more_images)[0]"
      @click="$emit('sendToLightbox', JSON.parse(more_images)[0])"
      v-if="JSON.parse(more_images).length === 1"
      class="hidden max-h-48 md:max-h-80 w-auto rounded-lg md:block cursor-pointer"
    />
    <div class="md:hidden grid grid-cols-3 gap-x-3 mx-3 pb-3">
      <img
        v-for="image in JSON.parse(more_images)"
        @click="$emit('sendToLightbox', image)"
        :key="image"
        :src="image"
        class="w-full object-cover object-center rounded-lg md:hidden cursor-pointer"
        :class="{
          'h-40': JSON.parse(more_images).length <= 3,
          'h-28': JSON.parse(more_images).length > 3,
        }"
      />
    </div>
  </div>

  <div
    class="hidden md:block mx-auto mt-6 max-w-2xl sm:px-6 lg:grid lg:max-w-7xl lg:gap-x-8 lg:px-8"
    :class="{
      'lg:grid-cols-1': JSON.parse(more_images).length === 0,
      'lg:grid-cols-2': JSON.parse(more_images).length === 1,
      'lg:grid-cols-3 col-span-2': JSON.parse(more_images).length > 1,
      'lg:grid-cols-4 col-span-2': JSON.parse(more_images).length > 3,
    }"
  >
    <div class="aspect-h-4 aspect-w-3 overflow-hidden block">
      <img
        :src="thumbnail"
        @click="$emit('sendToLightbox', thumbnail)"
        class="h-full w-full object-cover object-center rounded-lg cursor-pointer"
      />
    </div>
    <div
      class="aspect-h-4 aspect-w-3 overflow-hidden rounded-lg block"
      v-if="JSON.parse(more_images).length < 3 && JSON.parse(more_images).length !== 0"
    >
      <img
        :src="JSON.parse(more_images)[0]"
        @click="$emit('sendToLightbox', JSON.parse(more_images)[0])"
        class="h-full w-full object-cover object-center cursor-pointer"
      />
    </div>
    <div
      class="hidden lg:grid lg:grid-cols-1 lg:gap-y-8"
      v-if="JSON.parse(more_images).length > 2"
    >
      <div class="aspect-h-2 aspect-w-3 overflow-hidden rounded-lg">
        <img
          :src="JSON.parse(more_images)[1]"
          @click="$emit('sendToLightbox', JSON.parse(more_images)[1])"
          class="h-full w-full object-cover object-center cursor-pointer"
        />
      </div>
      <div class="aspect-h-2 aspect-w-3 overflow-hidden rounded-lg">
        <img
          :src="JSON.parse(more_images)[2]"
          @click="$emit('sendToLightbox', JSON.parse(more_images)[2])"
          class="h-full w-full object-cover object-center cursor-pointer"
        />
      </div>
    </div>
    <div
      class="aspect-h-5 aspect-w-4 lg:aspect-h-4 lg:aspect-w-3 sm:overflow-hidden sm:rounded-lg"
      v-if="JSON.parse(more_images).length > 1"
    >
      <img
        :src="JSON.parse(more_images)[1]"
        @click="$emit('sendToLightbox', JSON.parse(more_images)[1])"
        class="h-full w-full object-cover object-center cursor-pointer"
      />
    </div>

    <div
      class="aspect-h-4 aspect-w-3 overflow-hidden rounded-lg block"
      v-if="JSON.parse(more_images).length === 4"
    >
      <img
        :src="JSON.parse(more_images)[3]"
        @click="$emit('sendToLightbox', JSON.parse(more_images)[3])"
        class="h-full w-full object-cover object-center cursor-pointer"
      />
    </div>
    <div
      class="hidden lg:grid lg:grid-cols-1 lg:gap-y-8"
      v-if="JSON.parse(more_images).length > 4"
    >
      <div class="aspect-h-2 aspect-w-3 overflow-hidden rounded-lg">
        <img
          :src="JSON.parse(more_images)[3]"
          @click="$emit('sendToLightbox', JSON.parse(more_images)[3])"
          class="h-full w-full object-cover object-center cursor-pointer"
        />
      </div>
      <div class="aspect-h-2 aspect-w-3 overflow-hidden rounded-lg">
        <img
          :src="JSON.parse(more_images)[4]"
          @click="$emit('sendToLightbox', JSON.parse(more_images)[4])"
          class="h-full w-full object-cover object-center cursor-pointer"
        />
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["thumbnail", "more_images"],
  emits: ["sendToLightbox"],
};
</script>
