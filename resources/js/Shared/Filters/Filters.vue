<template>
    <div
        class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4"
    >
        <SearchBar v-model="search"></SearchBar>

        <DaterangePicker
            :dateStart="dateStart"
            :dateEnd="dateEnd"
            @dateChanged="dateRangePick"
        ></DaterangePicker>

        <SortDropdown v-model="sortBy"></SortDropdown>

        <FilterDropdown v-model="orderStatusFilters"></FilterDropdown>
    </div>
</template>

<script>
import debounce from "lodash/debounce";
import { router } from "@inertiajs/core";
export default {
    props: ["orders", "filters"],
    data() {
        return {
            search:
                this.filters.search !== undefined ? this.filters.search : "",
            dateStart:
                this.filters.dateStart !== undefined
                    ? decodeURIComponent(this.filters.dateStart)
                    : "",
            dateEnd:
                this.filters.dateEnd !== undefined
                    ? decodeURIComponent(this.filters.dateEnd)
                    : "",
            sortBy:
                this.filters.sortBy !== undefined ? this.filters.sortBy : "",
            orderStatusFilters:
                this.filters.orderStatus !== undefined
                    ? JSON.parse(this.filters.orderStatus)
                    : [],
        };
    },

    watch: {
        search: debounce(function () {
            this.filterResults();
        }, 300),
        dateStart() {
            this.filterResults();
        },
        dateEnd() {
            this.filterResults();
        },
        sortBy() {
            this.filterResults();
        },
        orderStatusFilters() {
            this.filterResults();
        },
    },
    methods: {
        dateRangePick(dateRange) {
            this.dateStart = dateRange.getDates("mm/dd/yyyy")[0];
            this.dateEnd = dateRange.getDates("mm/dd/yyyy")[1];
        },
        filterResults() {
            let filterQueries = {};
            if (this.search !== "") {
                filterQueries.search = this.search;
            }
            if (this.dateStart !== "" || this.dateEnd !== "") {
                filterQueries.dateStart = this.dateStart;
                filterQueries.dateEnd = this.dateEnd;
            }
            if (this.sortBy !== "") {
                filterQueries.sortBy = this.sortBy;
            }
            if (this.orderStatusFilters.length > 0) {
                filterQueries.orderStatus = JSON.stringify(
                    this.orderStatusFilters
                );
            }
            router.get("/admin-dashboard/orders", filterQueries, {
                preserveState: true,
                replace: true,
            });
        },
    },
};
</script>
<script setup>
import { onMounted } from "vue";
import { initFlowbite } from "flowbite";
import SearchBar from "../../Shared/Filters/SearchBar.vue";
import DaterangePicker from "../../Shared/Filters/DaterangePicker.vue";
import SortDropdown from "../../Shared/Filters/SortDropdown.vue";
import FilterDropdown from "../../Shared/Filters/FilterDropdown.vue";
onMounted(() => {
    initFlowbite();
});
</script>
