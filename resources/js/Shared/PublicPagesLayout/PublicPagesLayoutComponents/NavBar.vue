<template>
  <TransitionRoot as="template" :show="open">
    <Dialog as="div" class="relative z-40 lg:hidden" @close="open = false">
      <TransitionChild
        as="template"
        enter="transition-opacity ease-linear duration-300"
        enter-from="opacity-0"
        enter-to="opacity-100"
        leave="transition-opacity ease-linear duration-300"
        leave-from="opacity-100"
        leave-to="opacity-0"
      >
        <div class="fixed inset-0 bg-black bg-opacity-25" />
      </TransitionChild>

      <div class="fixed inset-0 z-50 flex">
        <TransitionChild
          as="template"
          enter="transition ease-in-out duration-300 transform"
          enter-from="-translate-x-full"
          enter-to="translate-x-0"
          leave="transition ease-in-out duration-300 transform"
          leave-from="translate-x-0"
          leave-to="-translate-x-full"
        >
          <DialogPanel
            class="relative flex w-full max-w-xs flex-col overflow-y-auto bg-white pb-12 shadow-xl"
          >
            <div class="flex px-4 pb-2 pt-5">
              <button
                type="button"
                class="-m-2 inline-flex items-center justify-center rounded-md p-2 text-gray-400"
                @click="open = false"
              >
                <span class="sr-only">Close menu</span>
                <XMarkIcon class="h-6 w-6" aria-hidden="true" />
              </button>
            </div>

            <!-- Links -->
            <TabGroup as="div" class="mt-2">
              <div class="border-b border-gray-200">
                <TabList class="-mb-px flex space-x-8 px-4">
                  <Tab
                    as="template"
                    v-for="category in navMenu.categories"
                    :key="category.name"
                    v-slot="{ selected }"
                  >
                    <button
                      :class="[
                        selected
                          ? 'border-blue-700 text-blue-700'
                          : 'border-transparent text-gray-900',
                        'flex-1 whitespace-nowrap border-b-2 px-1 py-4 text-base font-medium',
                      ]"
                    >
                      {{ category.name }}
                    </button>
                  </Tab>
                </TabList>
              </div>
              <TabPanels as="template">
                <TabPanel
                  v-for="category in navMenu.categories"
                  :key="category.name"
                  class="space-y-10 px-4 pb-8 pt-10 z-50"
                >
                  <div class="grid grid-cols-2 gap-x-4">
                    <div
                      v-for="item in category.featured"
                      :key="item.name"
                      class="group relative text-sm"
                    >
                      <div
                        class="aspect-h-1 aspect-w-1 overflow-hidden rounded-lg bg-gray-100 group-hover:opacity-75"
                      >
                        <img
                          :src="item.imageSrc"
                          :alt="item.imageAlt"
                          class="object-cover object-center"
                        />
                      </div>
                      <Link
                        :href="item.href"
                        class="mt-6 block font-medium text-gray-900"
                      >
                        <span class="absolute inset-0 z-10" aria-hidden="true" />
                        {{ item.name }}
                      </Link>
                      <p aria-hidden="true" class="mt-1">Shop now</p>
                    </div>
                  </div>
                  <div v-for="section in category.sections" :key="section.name">
                    <p
                      :id="`${category.id}-${section.id}-heading-mobile`"
                      class="font-medium text-gray-900"
                    >
                      {{ section.name }}
                    </p>
                    <ul
                      role="list"
                      :aria-labelledby="`${category.id}-${section.id}-heading-mobile`"
                      class="mt-6 flex flex-col space-y-6"
                    >
                      <li
                        v-for="item in section.items"
                        :key="item.name"
                        @click="open = false"
                        class="flow-root"
                      >
                        <Link
                          :href="item.link"
                          class="-m-2 block p-2 text-gray-500"
                          preser
                          >{{ item.name }}</Link
                        >
                      </li>
                    </ul>
                  </div>
                </TabPanel>
              </TabPanels>
            </TabGroup>

            <div class="space-y-6 border-t border-gray-200 px-4 py-6">
              <div v-for="page in navMenu.pages" :key="page.name" class="flow-root">
                <Link
                  :href="page.href"
                  class="-m-2 block p-2 font-medium text-gray-900"
                  >{{ page.name }}</Link
                >
              </div>
            </div>

            <div class="space-y-6 border-t border-gray-200 px-4 py-6">
              <div class="flow-root">
                <a href="#" class="-m-2 block p-2 font-medium text-gray-900">Sign in</a>
              </div>
              <div class="flow-root">
                <a href="#" class="-m-2 block p-2 font-medium text-gray-900"
                  >Create account</a
                >
              </div>
            </div>

            <div class="border-t border-gray-200 px-4 py-6">
              <a href="#" class="-m-2 flex items-center p-2">
                <img
                  src="https://tailwindui.com/img/flags/flag-canada.svg"
                  alt=""
                  class="block h-auto w-5 flex-shrink-0"
                />
                <span class="ml-3 block text-base font-medium text-gray-900">CAD</span>
                <span class="sr-only">, change currency</span>
              </a>
            </div>
          </DialogPanel>
        </TransitionChild>
      </div>
    </Dialog>
  </TransitionRoot>

  <header class="relative bg-white">
    <Link
      href="/admin-dashboard"
      v-if="usePage().props.auth.isAdmin"
      class="fixed top-0 left-0 right-0 z-50 flex h-10 items-center justify-center bg-gray-800 px-4 text-xs font-medium text-white sm:px-6 lg:px-8 hover:underline cursor-pointer gap-2"
    >
      <svg
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 24 24"
        fill="currentColor"
        class="w-4 h-4"
      >
        <path
          fill-rule="evenodd"
          d="M2.25 13.5a8.25 8.25 0 018.25-8.25.75.75 0 01.75.75v6.75H18a.75.75 0 01.75.75 8.25 8.25 0 01-16.5 0z"
          clip-rule="evenodd"
        />
        <path
          fill-rule="evenodd"
          d="M12.75 3a.75.75 0 01.75-.75 8.25 8.25 0 018.25 8.25.75.75 0 01-.75.75h-7.5a.75.75 0 01-.75-.75V3z"
          clip-rule="evenodd"
        />
      </svg>

      Hello Admin, Visit Admin Dashboard!
    </Link>

    <p
      class="flex h-10 items-center justify-center bg-blue-600 px-4 text-sm font-medium text-white sm:px-6 lg:px-8"
    >
      {{ usePage().props.banner_text }}
    </p>

    <nav aria-label="Top" class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="border-b border-gray-200">
        <div class="flex h-16 items-center">
          <button
            type="button"
            class="rounded-md bg-white p-2 text-gray-400 lg:hidden"
            @click="open = true"
          >
            <span class="sr-only">Open menu</span>
            <Bars3Icon class="h-6 w-6" aria-hidden="true" />
          </button>

          <!-- Logo -->
          <div class="ml-4 flex lg:ml-0">
            <Link :href="navMenu.logo.href">
              <span class="sr-only">Your Company</span>
              <img class="h-8 w-auto" :src="navMenu.logo.imageSrc" alt="" />
            </Link>
          </div>

          <!-- Flyout menus -->
          <PopoverGroup class="hidden lg:ml-8 lg:block lg:self-stretch z-50">
            <div class="flex h-full space-x-8">
              <Popover
                v-for="category in navMenu.categories"
                :key="category.name"
                class="flex"
                v-slot="{ open }"
              >
                <div class="relative flex">
                  <PopoverButton
                    :class="[
                      open
                        ? 'border-blue-700 text-blue-700'
                        : 'border-transparent text-gray-700 hover:text-gray-800',
                      'relative z-10 -mb-px flex items-center border-b-2 pt-px text-sm font-medium transition-colors duration-200 ease-out',
                    ]"
                    >{{ category.name }}</PopoverButton
                  >
                </div>

                <transition
                  enter-active-class="transition ease-out duration-200"
                  enter-from-class="opacity-0"
                  enter-to-class="opacity-100"
                  leave-active-class="transition ease-in duration-150"
                  leave-from-class="opacity-100"
                  leave-to-class="opacity-0"
                >
                  <PopoverPanel
                    class="absolute inset-x-0 top-full text-sm text-gray-500"
                    v-slot="{ close }"
                  >
                    <!-- Presentational element used to render the bottom shadow, if we put the shadow on the actual panel it pokes out the top, so we use this shorter element to hide the top of the shadow -->
                    <div
                      class="absolute inset-0 top-1/2 bg-white shadow"
                      aria-hidden="true"
                    />

                    <div class="relative bg-white">
                      <div class="mx-auto max-w-7xl px-8">
                        <div class="grid grid-cols-2 gap-x-8 gap-y-10 py-16">
                          <div class="col-start-2 grid grid-cols-2 gap-x-8">
                            <div
                              v-for="item in category.featured"
                              :key="item.name"
                              class="group relative text-base sm:text-sm"
                            >
                              <div
                                class="overflow-hidden rounded-lg bg-gray-100 group-hover:opacity-75 h-48 w-48"
                              >
                                <img
                                  :src="item.imageSrc"
                                  :alt="item.imageAlt"
                                  @click="close"
                                  class="object-cover object-center"
                                />
                              </div>
                              <Link
                                :href="item.href"
                                @click="close"
                                class="mt-6 block font-medium text-gray-900"
                              >
                                <span class="absolute inset-0 z-10" aria-hidden="true" />
                                {{ item.name }}
                              </Link>
                              <p aria-hidden="true" class="mt-1">Shop now</p>
                            </div>
                          </div>
                          <div
                            class="row-start-1 grid grid-cols-3 gap-x-8 gap-y-10 text-sm"
                          >
                            <div v-for="section in category.sections" :key="section.name">
                              <p
                                :id="`${section.name}-heading`"
                                class="font-medium text-gray-900"
                              >
                                {{ section.name }}
                              </p>
                              <ul
                                role="list"
                                :aria-labelledby="`${section.name}-heading`"
                                class="mt-6 gap-4 sm:gap-4 grid grid-rows-6 grid-flow-col"
                              >
                                <li
                                  v-for="item in section.items"
                                  :key="item.name"
                                  class="flex"
                                >
                                  <Link
                                    :href="item.link"
                                    class="hover:text-gray-800"
                                    @click="close"
                                    >{{ item.name }}</Link
                                  >
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </PopoverPanel>
                </transition>
              </Popover>

              <Link
                v-for="page in navMenu.pages"
                :key="page.name"
                :href="page.href"
                class="flex items-center text-sm font-medium text-gray-700 hover:text-gray-800"
                >{{ page.name }}</Link
              >
            </div>
          </PopoverGroup>

          <div class="ml-auto flex items-center">
            <div
              class="hidden lg:flex lg:flex-1 lg:items-center lg:justify-end lg:space-x-6"
            >
              <Link
                href="/login"
                class="text-sm font-medium text-gray-700 hover:text-gray-800"
                v-if="!usePage().props.auth.firstName ?? false"
                >Sign in</Link
              >
              <Link
                href="/dashboard"
                class="text-sm font-medium text-gray-700 hover:text-gray-800 flex items-center gap-2"
                v-else
              >
                Welcome, {{ usePage().props.auth.firstName }}
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 24 24"
                  fill="currentColor"
                  class="w-6 h-6"
                >
                  <path
                    fill-rule="evenodd"
                    d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"
                    clip-rule="evenodd"
                  />
                </svg>
              </Link>
              <span class="h-6 w-px bg-gray-200" aria-hidden="true" />
              <Link
                href="/register"
                class="text-sm font-medium text-gray-700 hover:text-gray-800"
                v-if="!usePage().props.auth.firstName ?? false"
                >Create account</Link
              >
              <Link
                href="/logout"
                method="post"
                as="button"
                class="text-sm font-medium text-gray-700 hover:text-gray-800"
                v-else
                >Log out</Link
              >
            </div>

            <div class="hidden lg:ml-8 lg:flex">
              <a href="#" class="flex items-center text-gray-700 hover:text-gray-800">
                <img
                  src="https://tailwindui.com/img/flags/flag-canada.svg"
                  alt=""
                  class="block h-auto w-5 flex-shrink-0"
                />
                <span class="ml-3 block text-sm font-medium">CAD</span>
                <span class="sr-only">, change currency</span>
              </a>
            </div>

            <!-- Search -->
            <div class="flex lg:ml-6">
              <button
                class="p-2 text-gray-400 hover:text-gray-500"
                data-dropdown-toggle="dropdownSearch"
                data-dropdown-placement="bottom"
                id="dropdownSearchButton"
              >
                <span class="sr-only">Search</span>
                <MagnifyingGlassIcon class="h-6 w-6" aria-hidden="true" />
              </button>
            </div>
            <div
              id="dropdownSearch"
              class="z-10 bg-gray-400 rounded-lg shadow w-60 dark:bg-gray-700 mt-10"
              :class="{ 'hidden ': !searchTerm }"
            >
              <div class="p-3">
                <label for="input-group-search" class="sr-only">Search</label>
                <div class="relative">
                  <div
                    class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"
                  >
                    <svg
                      class="w-5 h-5 text-gray-500 dark:text-gray-400"
                      aria-hidden="true"
                      fill="currentColor"
                      viewBox="0 0 20 20"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        fill-rule="evenodd"
                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                        clip-rule="evenodd"
                      ></path>
                    </svg>
                  </div>
                  <input
                    type="text"
                    id="input-group-search"
                    v-model="searchTerm"
                    class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Search product"
                  />
                </div>
              </div>
            </div>

            <!-- Cart -->
            <div class="ml-4 flow-root lg:ml-6">
              <div class="group -m-2 flex items-center p-2">
                <ShoppingBagIcon
                  class="h-6 w-6 flex-shrink-0 text-gray-400 group-hover:text-gray-500 cursor-pointer"
                  aria-hidden="true"
                  @click="$emit('cartOpen', true)"
                />
                <span
                  class="ml-2 text-sm font-medium text-gray-700 group-hover:text-gray-800"
                  >{{ usePage().props.cartCount ?? 0 }}</span
                >
                <span class="sr-only">items in cart, view bag</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </nav>
  </header>
</template>
<script>
import { usePage } from "@inertiajs/vue3";
const page = usePage();
export default {
  props: ["navMenu"],
  emits: ["cartOpen"],
  watch: {
    searchTerm() {
      if (this.searchTerm) {
        router.get("/shop", {
          search: this.searchTerm,
        });
      } else {
        router.get("/shop");
      }
    },
  },
  data() {
    return {
      searchTerm: usePage().props.filters ? usePage().props.filters.search ?? "" : "",
    };
  },
};
</script>
<script setup>
import { ref } from "vue";
import {
  Dialog,
  DialogPanel,
  Popover,
  PopoverButton,
  PopoverGroup,
  PopoverPanel,
  Tab,
  TabGroup,
  TabList,
  TabPanel,
  TabPanels,
  TransitionChild,
  TransitionRoot,
} from "@headlessui/vue";
import {
  Bars3Icon,
  MagnifyingGlassIcon,
  ShoppingBagIcon,
  XMarkIcon,
} from "@heroicons/vue/24/outline";
import { router } from "@inertiajs/vue3";

const open = ref(false);
</script>
