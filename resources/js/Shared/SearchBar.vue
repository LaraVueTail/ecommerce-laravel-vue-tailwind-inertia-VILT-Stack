<template>
    <div class="max-w-md relative">
        <span class="absolute left-4 top-3 text-lg text-gray-400">
            <i class="fa-solid fa-magnifying-glass"></i>
        </span>
        <input
            type="text"
            name="search"
            id="search"
            class="w-full border border-primary md:border-r-0 pl-12 py-3 pr-3 rounded-l-md rounded-r-md md:rounded-r-none md:rounded-l-md focus:outline-none"
            placeholder="search"
        />
        <button
            class="bg-primary border border-primary text-white px-8 rounded-r-md hover:bg-transparent hover:text-primary transition hidden md:block"
        >
            Search
        </button>
    </div>
</template>
