<template>
  <PublicPagesLayout>
    <div
      class="mx-auto max-w-6xl px-6 lg:px-8 md:my-10 pt-3 pb-10 md:py-5 rounded-lg bg-white min-h-[668px]"
    >
      <div class="mx-auto lg:mx-0">
        <h1
          class="text-xl md:text-4xl font-bold tracking-tight text-gray-900 border-b-2 md:p-4"
        >
          Dashboard
        </h1>
        <div class="relative h-full">
          <button
            data-drawer-target="default-sidebar"
            data-drawer-toggle="default-sidebar"
            aria-controls="default-sidebar"
            type="button"
            class="inline-flex items-center p-2 mt-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
          >
            <span class="sr-only">Open sidebar</span>
            <svg
              class="w-6 h-6"
              aria-hidden="true"
              fill="currentColor"
              viewBox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                clip-rule="evenodd"
                fill-rule="evenodd"
                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"
              ></path>
            </svg>
          </button>

          <aside
            id="default-sidebar"
            class="absolute top-0 left-0 z-40 w-64 transition-transform -translate-x-full sm:translate-x-0 rounded-lg"
            aria-label="Sidebar"
          >
            <div
              class="h-full px-3 py-4 overflow-y-auto bg-white dark:bg-gray-800 rounded-lg"
            >
              <ul class="space-y-2 font-medium">
                <li>
                  <Link
                    href="/dashboard"
                    class="flex items-center p-2 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700"
                    :class="
                      $page.url === '/dashboard' ? 'text-blue-700' : 'text-gray-700'
                    "
                  >
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 24 24"
                      fill="currentColor"
                      class="flex-shrink-0 w-6 h-6 transition duration-75 dark:text-gray-400 group-hover:text-gray-700 dark:group-hover:text-white"
                    >
                      <path
                        fill-rule="evenodd"
                        d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z"
                        clip-rule="evenodd"
                      />
                    </svg>

                    <span class="ml-3">User Info</span>
                  </Link>
                </li>
                <li>
                  <Link
                    href="/dashboard/orders"
                    class="flex items-center p-2 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700"
                    :class="
                      $page.url === '/dashboard/orders'
                        ? 'text-blue-700'
                        : 'text-gray-700'
                    "
                  >
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 24 24"
                      fill="currentColor"
                      class="flex-shrink-0 w-6 h-6 transition duration-75 dark:text-gray-400 group-hover:text-gray-700 dark:group-hover:text-white"
                    >
                      <path
                        fill-rule="evenodd"
                        d="M5.478 5.559A1.5 1.5 0 016.912 4.5H9A.75.75 0 009 3H6.912a3 3 0 00-2.868 2.118l-2.411 7.838a3 3 0 00-.133.882V18a3 3 0 003 3h15a3 3 0 003-3v-4.162c0-.299-.045-.596-.133-.882l-2.412-7.838A3 3 0 0017.088 3H15a.75.75 0 000 1.5h2.088a1.5 1.5 0 011.434 1.059l2.213 7.191H17.89a3 3 0 00-2.684 1.658l-.256.513a1.5 1.5 0 01-1.342.829h-3.218a1.5 1.5 0 01-1.342-.83l-.256-.512a3 3 0 00-2.684-1.658H3.265l2.213-7.191z"
                        clip-rule="evenodd"
                      />
                      <path
                        fill-rule="evenodd"
                        d="M12 2.25a.75.75 0 01.75.75v6.44l1.72-1.72a.75.75 0 111.06 1.06l-3 3a.75.75 0 01-1.06 0l-3-3a.75.75 0 011.06-1.06l1.72 1.72V3a.75.75 0 01.75-.75z"
                        clip-rule="evenodd"
                      />
                    </svg>

                    <span class="flex-1 ml-3 whitespace-nowrap">Orders</span>
                  </Link>
                </li>
                <li>
                  <Link
                    href="/dashboard/address"
                    class="flex items-center p-2 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700"
                    :class="
                      $page.url === '/dashboard/address'
                        ? 'text-blue-700'
                        : 'text-gray-700'
                    "
                  >
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 24 24"
                      fill="currentColor"
                      class="flex-shrink-0 w-6 h-6 transition duration-75 dark:text-gray-400 group-hover:text-gray-700 dark:group-hover:text-white"
                    >
                      <path
                        fill-rule="evenodd"
                        d="M4.5 3.75a3 3 0 00-3 3v10.5a3 3 0 003 3h15a3 3 0 003-3V6.75a3 3 0 00-3-3h-15zm4.125 3a2.25 2.25 0 100 4.5 2.25 2.25 0 000-4.5zm-3.873 8.703a4.126 4.126 0 017.746 0 .75.75 0 01-.351.92 7.47 7.47 0 01-3.522.877 7.47 7.47 0 01-3.522-.877.75.75 0 01-.351-.92zM15 8.25a.75.75 0 000 1.5h3.75a.75.75 0 000-1.5H15zM14.25 12a.75.75 0 01.75-.75h3.75a.75.75 0 010 1.5H15a.75.75 0 01-.75-.75zm.75 2.25a.75.75 0 000 1.5h3.75a.75.75 0 000-1.5H15z"
                        clip-rule="evenodd"
                      />
                    </svg>

                    <span class="flex-1 ml-3 whitespace-nowrap">Address</span>
                  </Link>
                </li>
                <li>
                  <Link
                    href="/logout"
                    method="post"
                    class="flex items-center p-2 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700"
                  >
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 24 24"
                      fill="currentColor"
                      class="flex-shrink-0 w-6 h-6 transition duration-75 dark:text-gray-400 group-hover:text-gray-700 dark:group-hover:text-white"
                    >
                      <path
                        fill-rule="evenodd"
                        d="M7.5 3.75A1.5 1.5 0 006 5.25v13.5a1.5 1.5 0 001.5 1.5h6a1.5 1.5 0 001.5-1.5V15a.75.75 0 011.5 0v3.75a3 3 0 01-3 3h-6a3 3 0 01-3-3V5.25a3 3 0 013-3h6a3 3 0 013 3V9A.75.75 0 0115 9V5.25a1.5 1.5 0 00-1.5-1.5h-6zm10.72 4.72a.75.75 0 011.06 0l3 3a.75.75 0 010 1.06l-3 3a.75.75 0 11-1.06-1.06l1.72-1.72H9a.75.75 0 010-1.5h10.94l-1.72-1.72a.75.75 0 010-1.06z"
                        clip-rule="evenodd"
                      />
                    </svg>

                    <span class="flex-1 ml-3 whitespace-nowrap">Logout</span>
                  </Link>
                </li>
              </ul>
            </div>
          </aside>

          <div class="md:p-4 sm:ml-64">
            <div class="md:p-4 sm:border-l border-gray-200 dark:border-gray-700">
              <slot></slot>
            </div>
          </div>
        </div>
      </div>
    </div>
  </PublicPagesLayout>
</template>
<script setup>
import PublicPagesLayout from "../PublicPagesLayout/PublicPagesLayout.vue";
</script>
