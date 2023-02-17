<template>
                    <div class="pt-4">
                    <h3 class="text-sm text-gray-800 uppercase mb-1">Size</h3>
                    <div class="flex items-center gap-2">
                        <div class="size-selector">
                            <input
                                type="radio"
                                name="size"
                                id="size-xs"
                                class="hidden"
                            />
                            <label
                                for="size-xs"
                                class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600"
                                >XS</label
                            >
                        </div>
                        <div class="size-selector">
                            <input
                                type="radio"
                                name="size"
                                id="size-sm"
                                class="hidden"
                            />
                            <label
                                for="size-sm"
                                class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600"
                                >S</label
                            >
                        </div>
                        <div class="size-selector">
                            <input
                                type="radio"
                                name="size"
                                id="size-m"
                                class="hidden"
                            />
                            <label
                                for="size-m"
                                class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600"
                                >M</label
                            >
                        </div>
                        <div class="size-selector">
                            <input
                                type="radio"
                                name="size"
                                id="size-l"
                                class="hidden"
                            />
                            <label
                                for="size-l"
                                class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600"
                                >L</label
                            >
                        </div>
                        <div class="size-selector">
                            <input
                                type="radio"
                                name="size"
                                id="size-xl"
                                class="hidden"
                            />
                            <label
                                for="size-xl"
                                class="text-xs border border-gray-200 rounded-sm h-6 w-6 flex items-center justify-center cursor-pointer shadow-sm text-gray-600"
                                >XL</label
                            >
                        </div>
                    </div>
                </div>

                <div class="pt-4">
                    <h3
                        class="text-xl text-gray-800 mb-3 uppercase font-medium"
                    >
                        Color
                    </h3>
                    <div class="flex items-center gap-2">
                        <div class="color-selector">
                            <input
                                type="radio"
                                name="color"
                                id="red"
                                class="hidden"
                            />
                            <label
                                for="red"
                                class="border border-gray-200 rounded-sm h-6 w-6 cursor-pointer shadow-sm block"
                                style="background-color: #fc3d57"
                            ></label>
                        </div>
                        <div class="color-selector">
                            <input
                                type="radio"
                                name="color"
                                id="black"
                                class="hidden"
                            />
                            <label
                                for="black"
                                class="border border-gray-200 rounded-sm h-6 w-6 cursor-pointer shadow-sm block"
                                style="background-color: #000"
                            ></label>
                        </div>
                        <div class="color-selector">
                            <input
                                type="radio"
                                name="color"
                                id="white"
                                class="hidden"
                            />
                            <label
                                for="white"
                                class="border border-gray-200 rounded-sm h-6 w-6 cursor-pointer shadow-sm block"
                                style="background-color: #fff"
                            ></label>
                        </div>
                    </div>
                </div>
</template>