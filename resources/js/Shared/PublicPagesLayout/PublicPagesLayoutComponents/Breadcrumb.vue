<template>
  <nav aria-label="Breadcrumb">
    <ol
      role="list"
      class="mx-auto flex max-w-2xl items-center space-x-2 px-4 sm:px-6 lg:max-w-7xl lg:px-8"
    >
      <li v-for="breadcrumb in breadcrumbs" :key="breadcrumb.id">
        <div class="flex items-center">
          <Link :href="breadcrumb.link" class="mr-2 text-sm font-medium text-gray-900">{{
            breadcrumb.name
          }}</Link>
          <svg
            width="16"
            height="20"
            viewBox="0 0 16 20"
            fill="currentColor"
            aria-hidden="true"
            class="h-5 w-4 text-gray-300"
          >
            <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z" />
          </svg>
        </div>
      </li>
      <li class="text-sm">
        <Link
          :href="product.href"
          aria-current="page"
          class="font-medium text-gray-500 hover:text-gray-600"
          >{{ product.name }}</Link
        >
      </li>
    </ol>
  </nav>
</template>
<script>
export default {
  props: ["breadcrumbs", "product"],
};
</script>
