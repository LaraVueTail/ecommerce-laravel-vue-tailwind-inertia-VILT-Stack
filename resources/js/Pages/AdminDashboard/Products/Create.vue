<template>
  <section class="dark:bg-gray-900 h-screen overflow-x-hidden md:overflow-x-visible p-1">
    <div class="mx-auto max-w-screen-xl px-1 lg:px-12 my-11 pb-11">
      <!-- Modal content -->

      <Breadcrump :links="{ products: 'products', 'Create Product': '' }"></Breadcrump>

      <div
        class="relative p-4 bg-white border border-gray-200 rounded-lg shadow dark:border-gray-700 dark:bg-gray-800 sm:p-5"
      >
        <!-- Modal header -->
        <div
          class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600"
        >
          <h5
            class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"
          >
            Create Product
          </h5>
          <button
            type="button"
            @click="reloadPage()"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke-width="1.5"
              stroke="currentColor"
              class="w-6 h-6"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99"
              />
            </svg>

            <span class="sr-only">Refresh</span>
          </button>
        </div>
        <!-- Modal body -->
        <form action="#" @submit.prevent="">
          <div>
            <div class="mb-4">
              <div class="grid gap-4 mb-4 sm:grid-cols-5">
                <div class="grid sm:col-span-3 pr-4 border-r">
                  <p class="font-medium text-blue-600 dark:text-gray-400 my-4">
                    Product General Details:
                  </p>
                  <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    <div>
                      <div class="mb-2">
                        <label
                          for="name"
                          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                          >Product Name</label
                        >
                        <input
                          type="text"
                          name="name"
                          id="name"
                          v-model="productInfo.name"
                          :class="{
                            'border-2 border-rose-500': errors.name,
                          }"
                          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        />
                        <div
                          v-if="errors.name"
                          v-text="errors.name"
                          class="text-red-500 text-xs mt-1"
                        ></div>
                      </div>
                      <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                          <label
                            for="brand"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            >Brand</label
                          >
                          <input
                            type="text"
                            name="brand"
                            id="brand"
                            v-model="productInfo.brand"
                            :class="{
                              'border-2 border-rose-500': errors.brand,
                            }"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 mb-2"
                          />
                          <div
                            v-if="errors.brand"
                            v-text="errors.brand"
                            class="text-red-500 text-xs mt-1"
                          ></div>
                        </div>
                        <div>
                          <label
                            for="tag"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            >Tag</label
                          >
                          <select
                            id="tag"
                            v-model="productInfo.tag"
                            required
                            :class="{
                              'border-2 border-rose-500': errors.tag,
                            }"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 mb-2"
                          >
                            <option
                              v-for="tag in [
                                'best_seller',
                                'new_arrival',
                                'end_of_season',
                              ]"
                              :key="tag"
                              :value="tag"
                            >
                              {{ tag }}
                            </option>
                          </select>
                          <div
                            v-if="errors.tag"
                            v-text="errors.tag"
                            class="text-red-500 text-xs mt-1"
                          ></div>
                        </div>
                      </div>

                      <div class="mb-2">
                        <label
                          for="offer_text"
                          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                          >Offer text</label
                        >
                        <input
                          type="text"
                          name="offer_text"
                          id="offer_text"
                          placeholder="ex: Buy 1 Get 1 .."
                          v-model="productInfo.offer_text"
                          :class="{
                            'border-2 border-rose-500': errors.offer_text,
                          }"
                          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 mb-2"
                        />
                        <div
                          v-if="errors.offer_text"
                          v-text="errors.offer_text"
                          class="text-red-500 text-xs mt-1"
                        ></div>
                      </div>

                      <div>
                        <label
                          for="slug"
                          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                          >Product Slug (Unique Name)</label
                        >
                        <input
                          type="text"
                          name="slug"
                          id="slug"
                          v-model="productInfo.slug"
                          :class="{
                            'border-2 border-rose-500': errors.slug,
                          }"
                          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        />
                        <div
                          v-if="errors.slug"
                          v-text="errors.slug"
                          class="text-red-500 text-xs mt-1"
                        ></div>
                      </div>
                    </div>

                    <div>
                      <div>
                        <label
                          for="category_id"
                          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                          >Category</label
                        >
                        <select
                          id="category_id"
                          required
                          v-model="productInfo.category_id"
                          :class="{
                            'border-2 border-rose-500': errors.category_id,
                          }"
                          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 mb-2"
                        >
                          <option
                            v-for="category in categories"
                            :key="category.id"
                            :value="category.id"
                          >
                            {{ category.name }}
                          </option>
                          <!-- <option value="TV">TV/Monitors</option>
                                    <option value="PC">PC</option>
                                    <option value="GA">Gaming/Console</option>
                                    <option value="PH">Phones</option> -->
                        </select>
                        <div
                          v-if="errors.category_id"
                          v-text="errors.category_id"
                          class="text-red-500 text-xs mt-1"
                        ></div>
                      </div>

                      <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                          <label
                            for="inventory"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            >inventory</label
                          >
                          <input
                            type="number"
                            name="inventory"
                            id="inventory"
                            v-model="productInfo.inventory"
                            :class="{
                              'border-2 border-rose-500': errors.inventory,
                            }"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 mb-2"
                          />
                          <div
                            v-if="errors.inventory"
                            v-text="errors.inventory"
                            class="text-red-500 text-xs mt-1"
                          ></div>
                        </div>
                        <div>
                          <label
                            for="availability"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            >Availability</label
                          >
                          <select
                            id="availability"
                            v-model="productInfo.availability"
                            required
                            :class="{
                              'border-2 border-rose-500': errors.availability,
                            }"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 mb-2"
                          >
                            <option
                              v-for="availability in [
                                'available',
                                'out_of_stock',
                                'coming_soon',
                              ]"
                              :key="availability"
                              :value="availability"
                            >
                              {{ availability }}
                            </option>
                          </select>
                          <div
                            v-if="errors.availability"
                            v-text="errors.availability"
                            class="text-red-500 text-xs mt-1"
                          ></div>
                        </div>
                      </div>

                      <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                          <label
                            for="price"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            >Offer Price</label
                          >
                          <input
                            type="number"
                            name="price"
                            id="price"
                            v-model="productInfo.price"
                            :class="{
                              'border-2 border-rose-500': errors.price,
                            }"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 mb-2"
                          />
                          <div
                            v-if="errors.price"
                            v-text="errors.price"
                            class="text-red-500 text-xs mt-1"
                          ></div>
                        </div>

                        <div>
                          <label
                            for="price_no_offer"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            >Actual Price</label
                          >
                          <input
                            type="number"
                            name="price_no_offer"
                            id="price_no_offer"
                            v-model="productInfo.price_no_offer"
                            :class="{
                              'border-2 border-rose-500': errors.price_no_offer,
                            }"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 mb-2"
                          />
                          <div
                            v-if="errors.price_no_offer"
                            v-text="errors.price_no_offer"
                            class="text-red-500 text-xs mt-1"
                          ></div>
                        </div>
                      </div>

                      <div>
                        <label
                          for="link"
                          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                          >Product Link (From slug)</label
                        >
                        <input
                          type="text"
                          id="link"
                          aria-label="disabled input 2"
                          class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                          :value="slugify(productInfo.slug ?? '')"
                          disabled
                          readonly
                        />
                        <div
                          v-if="errors.link"
                          v-text="errors.link"
                          class="text-red-500 text-xs mt-1"
                        ></div>
                      </div>
                    </div>
                  </div>
                  <p class="font-medium text-blue-600 dark:text-gray-400 my-4">
                    Product Specifications/Attributes:
                  </p>

                  <div>
                    <div
                      class="text-sm font-medium my-3 text-gray-500"
                      v-if="productAttributes.length < 1"
                    >
                      No Attributes
                    </div>

                    <div class="relative overflow-x-auto border rounded-lg my-2" v-else>
                      <table
                        class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
                      >
                        <thead
                          class="text-xs text-gray-700 uppercase bg-blue-50 dark:bg-gray-700 dark:text-gray-400"
                        >
                          <tr>
                            <th scope="col" class="px-6 py-3">Attribute Name</th>
                            <th scope="col" class="px-6 py-3">Attribute Value</th>
                            <th scope="col" class="px-6 py-3"></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                            v-for="(attribute, index) in productAttributes"
                            :key="attribute"
                          >
                            <td
                              scope="row"
                              class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                            >
                              {{ attribute.attribute_label }}
                            </td>
                            <td
                              scope="row"
                              class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                            >
                              {{ attribute.attribute_value }}
                            </td>
                            <td class="px-6 py-4">
                              <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 35 35"
                                stroke-width="2.5"
                                stroke="currentColor"
                                class="w-6 h-6 text-red-500 hover:cursor-pointer hover:text-red-700"
                                @click="deleteProductAttribute(attribute)"
                              >
                                <path
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                                />
                              </svg>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>

                  <div class="p-2 bg-blue-50 rounded-lg">
                    <div class="grid sm:grid-cols-12 gap-2">
                      <div class="col-span-5">
                        <label
                          for="attribute_label"
                          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                          >Attribute Label</label
                        >
                        <input
                          type="text"
                          name="attribute_label"
                          id="attribute_label"
                          v-model="newAttribute.attribute_label"
                          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                          placeholder="ex: Color/Size/.."
                        />
                      </div>
                      <div class="col-span-5">
                        <label
                          for="attribute_value"
                          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                          >Attribute Value</label
                        >
                        <input
                          type="text"
                          name="attribute_value"
                          id="attribute_value"
                          v-model="newAttribute.attribute_value"
                          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                          placeholder="Red, Blue,  or XS,S,M,L.."
                        />
                      </div>

                      <div class="self-end col-span-2">
                        <button
                          @click.prevent="addProductAttribute()"
                          class="text-white w-full bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        >
                          Add
                        </button>
                      </div>
                    </div>
                  </div>

                  <div class="grid">
                    <p class="font-medium text-blue-600 dark:text-gray-400 my-4">
                      Product Descriptions:
                    </p>
                    <div class="sm:col-span-2">
                      <label
                        for="description"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >Short Description</label
                      >
                      <textarea
                        id="short_description"
                        v-model="productInfo.short_description"
                        rows="5"
                        class="mb-2 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Write a small description..."
                      ></textarea>
                    </div>
                    <div class="sm:col-span-2">
                      <label
                        for="description"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >Long Description</label
                      >
                      <textarea
                        id="description"
                        v-model="productInfo.description"
                        rows="5"
                        class="mb-2 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Write a detailed description..."
                      ></textarea>
                    </div>
                  </div>
                </div>

                <div class="grid sm:col-span-2">
                  <div>
                    <p class="font-medium text-blue-600 dark:text-gray-400 my-4">
                      Product Images:
                    </p>
                    <div>
                      <label
                        for="more_images"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >Thumbnail</label
                      >
                      <input
                        class="mb-2 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        :class="{
                          'border-2 border-rose-500': errors.thumbnail,
                        }"
                        id="file_input"
                        type="file"
                        ref="thumbnail"
                        @input="imageThumbnailAdded($event.target.files)"
                      />
                      <div
                        v-if="errors.thumbnail"
                        v-text="errors.thumbnail"
                        class="text-red-500 text-xs mt-1"
                      ></div>
                      <div
                        class="relative text-white hover:text-red-600 cursor-pointer mb-10"
                        v-if="uploadedThumbnailImage()"
                      >
                        <div
                          class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-10"
                        >
                          <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="currentColor"
                            class="w-6 h-6"
                            @click="deleteThumbnail()"
                          >
                            <path
                              fill-rule="evenodd"
                              d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z"
                              clip-rule="evenodd"
                            />
                          </svg>
                        </div>
                        <div
                          class="bg-contain bg-center bg-no-repeat shadow-2xl saturate-50 bg-blend-overlay bg-gray-900/75 h-48 w-full rounded-lg"
                          :style="`background-image: url(${uploadedImage(
                            addedThumbnail[0]
                          )})`"
                        ></div>
                      </div>
                    </div>
                    <div>
                      <label
                        for="more_images"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >More Images</label
                      >
                      <div class="flex items-center justify-center w-full">
                        <label
                          for="more_images"
                          class="flex flex-col items-center justify-center w-full h-34 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600"
                        >
                          <div
                            class="flex flex-col items-center justify-center pt-5 pb-6"
                          >
                            <svg
                              aria-hidden="true"
                              class="w-10 h-10 mb-3 text-gray-400"
                              fill="none"
                              stroke="currentColor"
                              viewBox="0 0 24 24"
                              xmlns="http://www.w3.org/2000/svg"
                            >
                              <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"
                              ></path>
                            </svg>
                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                              <span class="font-semibold">Click to upload</span>
                              or drag and drop
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                              SVG, PNG, JPG or GIF (MAX. 800x400px)
                            </p>
                          </div>
                          <input
                            id="more_images"
                            type="file"
                            class="hidden"
                            @input="imageAdded($event.target.files)"
                            multiple
                          />
                        </label>
                      </div>
                    </div>
                    <div class="grid grid-cols-2 gap-2 py-2 justify-items-stretch">
                      <div v-for="(addedImage, index) in addedImages" :key="addedImage">
                        <!-- <div class="h-24 w-full m-2">
                          <figure
                            class="relative transition-all duration-300 cursor-pointer filter grayscale hover:grayscale-0"
                          >
                            <a href="#">
                              <img
                                class="rounded-lg"
                                :src="uploadedImage(index)"
                                alt="image description"
                              />
                            </a>
                            <figcaption
                              class="absolute px-4 text-lg text-white top-1/2 bottom-1/2"
                            >
                              <p>remove</p>
                            </figcaption>
                          </figure>
                        </div> -->
                        <div
                          class="relative text-white hover:text-red-600 cursor-pointer"
                        >
                          <div
                            class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-10"
                          >
                            <svg
                              xmlns="http://www.w3.org/2000/svg"
                              viewBox="0 0 24 24"
                              fill="currentColor"
                              class="w-6 h-6"
                              @click="deleteAddedImage(index)"
                            >
                              <path
                                fill-rule="evenodd"
                                d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z"
                                clip-rule="evenodd"
                              />
                            </svg>
                          </div>
                          <div
                            class="bg-cover bg-center shadow-2xl saturate-50 bg-blend-overlay bg-gray-900/75 h-24 w-full rounded-lg"
                            :style="`background-image: url(${uploadedImage(addedImage)})`"
                          ></div>
                        </div>

                        <!-- <img
                          class="h-full max-w-full rounded-lg"
                          ref="uploadedImage"
                          alt="image description"
                          :src="uploadedImage(index)"
                        /> -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div>
            <div v-if="errors ?? false">
              <div
                v-for="(value, key, index) in errors"
                :key="index"
                v-text="value"
                class="text-red-600 text-sm mt-1 bg-red-200 p-2 rounded my-2"
              ></div>
            </div>
            <div class="flex items-center space-x-4">
              <button
                type="submit"
                @click.prevent="createProduct()"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
              >
                Create Product
              </button>
            </div>
          </div>
        </form>
      </div>

      <!-- <div
        class="relative p-4 bg-blue-100 border border-blue-100 rounded-lg shadow dark:border-gray-700 dark:bg-gray-800 sm:p-5 my-6"
      >
        <div class="bg-blue-100 px-3 rounded pb-4">
          <p class="font-medium text-blue-600 dark:text-gray-400 my-4">Order details:</p>
          <div>
            <label
              for="description"
              class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
              >Order Items</label
            >
            <div
              class="text-sm font-medium my-3 text-gray-500"
              v-if="orderContent.length < 1"
            >
              No Order Items
            </div>

            <div class="relative overflow-x-auto border rounded-lg my-2" v-else>
              <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead
                  class="text-xs text-gray-700 uppercase bg-blue-50 dark:bg-gray-700 dark:text-gray-400"
                >
                  <tr>
                    <th scope="col" class="px-6 py-3">Prod. ID</th>
                    <th scope="col" class="px-6 py-3">Prod. Name</th>
                    <th scope="col" class="px-6 py-3">Prod. Price</th>
                    <th scope="col" class="px-6 py-3">Quantity</th>
                    <th scope="col" class="px-6 py-3"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                    v-for="orderItem in orderContent"
                    :key="orderItem"
                  >
                    <th
                      scope="row"
                      class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                    >
                      {{ orderItem.id }}
                    </th>
                    <th
                      scope="row"
                      class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                    >
                      {{ orderItem.name }}
                    </th>
                    <th
                      scope="row"
                      class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                    >
                      {{ orderItem.price }}
                    </th>
                    <td class="px-6 py-4">
                      {{ orderItem.quantity }}
                    </td>
                    <td class="px-6 py-4">
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 35 35"
                        stroke-width="1.5"
                        stroke="currentColor"
                        @click="deleteOrderItem(orderItem)"
                        class="w-6 h-6 text-red-400 hover:cursor-pointer hover:text-red-700"
                      >
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                        />
                      </svg>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="grid sm:grid-cols-2">
            <div class="p-2 bg-blue-50 rounded-lg">
              <label
                for="description"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >Add item</label
              >
              <div class="grid grid-cols-2 gap-2">
                <div>
                  <label
                    for="product_id"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    >Product ID</label
                  >
                  <input
                    type="number"
                    name="product_id"
                    id="product_id"
                    min="1"
                    v-model="newOrderItem.id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="ex: 133"
                  />
                </div>
                <div>
                  <label
                    for="product_name"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    >Product Name</label
                  >
                  <input
                    type="text"
                    name="product_name"
                    id="product_name"
                    v-model="newOrderItem.name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder=""
                  />
                </div>
                <div>
                  <label
                    for="product_price"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    >Product Price</label
                  >
                  <input
                    type="number"
                    name="product_price"
                    id="product_price"
                    min="0"
                    v-model="newOrderItem.price"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder=""
                  />
                </div>
                <div>
                  <label
                    for="product_quantity"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    >Quantity</label
                  >
                  <input
                    type="number"
                    name="product_quantity"
                    id="product_quantity"
                    min="1"
                    v-model="newOrderItem.quantity"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="ex: 2"
                  />
                </div>
                <div class="justify-self-stretch col-span-2">
                  <button
                    @click.prevent="addOrderItem()"
                    class="text-white w-full bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                  >
                    Add Item
                  </button>
                </div>
              </div>
            </div>
            <div class="p-5 pb-0 flex flex-col justify-between">
              <div>
                <label class="text-md font-medium text-gray-900"
                  >Total Amount: {{ totalAmount }}</label
                ><br />
                <label class="text-md font-medium text-gray-900"
                  >Total No. Items: {{ orderContent.length }}</label
                ><br />
              </div>

              <div>
                <div v-if="errors ?? false">
                  <div
                    v-for="(value, key, index) in errors"
                    :key="index"
                    v-text="value"
                    class="text-red-600 text-sm mt-1 bg-red-200 p-2 rounded my-2"
                  ></div>
                </div>
                <div class="flex items-center space-x-4">
                  <button
                    type="submit"
                    @click.prevent="createOrder()"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                  >
                    Create Order
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> -->
    </div>
  </section>
</template>

<script>
import { router } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";
export default {
  props: ["errors", "categories"],
  data() {
    return {
      productInfo: {},
      //   orderInfoShippingAddress: {},
      //   orderContent: [],
      //   newOrderItem: {},
      form: {},
      newAttribute: {},
      productAttributes: [],
      addedImages: [],
      addedThumbnail: null,
    };
  },
  methods: {
    slugify(str) {
      return str
        .toLowerCase()
        .trim()
        .replace(/[^\w\s-]/g, "")
        .replace(/[\s_-]+/g, "-")
        .replace(/^-+|-+$/g, "");
    },
    addProductAttribute() {
      if (this.newAttribute.attribute_label && this.newAttribute.attribute_value) {
        this.productAttributes.push({
          attribute_label: this.newAttribute.attribute_label,
          attribute_value: this.newAttribute.attribute_value,
        });
        this, (this.newAttribute = {});
      }
      console.log(this.productAttributes);
    },
    deleteProductAttribute(item) {
      var index = this.productAttributes.indexOf(item);
      if (index !== -1) {
        this.productAttributes.splice(index, 1);
      }
    },
    imageAdded(files) {
      this.productInfo.thumbnail = files;
      console.log(this.addedImages);

      this.addedImages.push.apply(this.addedImages, files);
      console.log(files);
      console.log(URL.createObjectURL(this.addedImages[0]));
    },
    uploadedThumbnailImage() {
      var src = "";
      if (this.addedThumbnail) {
        src = URL.createObjectURL(this.addedThumbnail[0]);
      }
      return src;
    },
    deleteAddedImage(index) {
      console.log(this.addedImages);
      if (index !== -1) {
        this.addedImages.splice(index, 1);
      }
    },
    deleteThumbnail() {
      this.addedThumbnail = null;
      this.$refs.thumbnail.value = "";
    },
    imageThumbnailAdded(files) {
      this.addedThumbnail = files;
      console.log(URL.createObjectURL(this.addedThumbnail[0]));
    },
    uploadedImage(file) {
      var src = "";
      if (file) {
        src = URL.createObjectURL(file);
      }
      return src;
    },

    createProduct() {
      this.productInfo.product_attributes = JSON.stringify(this.productAttributes);
      this.productInfo.thumbnail = this.addedThumbnail;
      this.productInfo.more_images = this.addedImages;
      console.log(this.productInfo);

      this.form = useForm(this.productInfo);
      this.form.post(`/admin-dashboard/products`, {
        preserveScroll: true,
      });
    },
  },
};
</script>
<script setup>
import { onMounted, onUpdated } from "vue";
import { initFlowbite } from "flowbite";
import Breadcrump from "../../../Shared/AdminDashboardLayoutComponents/Breadcrump.vue";
onMounted(() => {
  initFlowbite();
});
onUpdated(() => {
  initFlowbite();
});
</script>
