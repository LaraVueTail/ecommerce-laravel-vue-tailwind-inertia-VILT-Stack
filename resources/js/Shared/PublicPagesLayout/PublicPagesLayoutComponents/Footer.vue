<template>
  <footer class="p-4 bg-gray-100 sm:p-6 dark:bg-gray-800 w-full">
    <div class="mx-auto max-w-screen-xl">
      <div class="sm:flex sm:items-center sm:justify-between">
        <Link href="https://flowbite.com/" class="flex items-center mb-4 sm:mb-0">
          <img :src="site_logo" class="h-8 mr-3" alt="Flowbite Logo" />
          <span
            class="self-center text-lg font-semibold text-gray-700 whitespace-nowrap dark:text-white"
            >{{ site_name }}</span
          >
        </Link>
        <ul
          class="flex flex-wrap items-center mb-6 text-sm font-medium text-gray-500 sm:mb-0 dark:text-gray-400"
        >
          <li v-for="pageLink in pageLinks" :key="pageLink">
            <Link :href="pageLink.pageLink" class="mr-4 hover:underline md:mr-6">{{
              pageLink.pageName
            }}</Link>
          </li>
          <!-- <li>
            <a href="#" class="mr-4 hover:underline md:mr-6">Privacy Policy</a>
          </li>
          <li>
            <a href="#" class="mr-4 hover:underline md:mr-6">Licensing</a>
          </li>
          <li>
            <a href="#" class="hover:underline">Contact</a>
          </li> -->
        </ul>
      </div>
      <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
      <div class="sm:flex sm:items-center sm:justify-between">
        <span class="text-xs text-gray-500 sm:text-center dark:text-gray-400"
          >{{ new Date().getFullYear() }}
          <a href="https://flowbite.com" class="hover:underline">{{ site_name }}</a
          >. All Rights Reserved.
        </span>
        <div class="flex mt-4 space-x-6 sm:justify-center sm:mt-0">
          <a
            :href="socialLink.socialLink"
            class="text-gray-500 hover:text-gray-900 dark:hover:text-white"
            v-for="socialLink in socialLinks"
            :key="socialLink"
          >
            <i
              :class="`fa-brands fa-${socialLink.socialName} text-lg text-gray-500 hover:text-gray-900`"
            ></i>
          </a>
        </div>
      </div>
    </div>
  </footer>
</template>
<script>
export default {
  data() {
    return {
      pageLinks: JSON.parse(this.$page.props.footerContent.page_links),
      socialLinks: JSON.parse(this.$page.props.footerContent.social_links),
      site_logo: this.$page.props.footerContent.site_logo,
      site_name: this.$page.props.footerContent.site_name,
    };
  },
};
</script>
