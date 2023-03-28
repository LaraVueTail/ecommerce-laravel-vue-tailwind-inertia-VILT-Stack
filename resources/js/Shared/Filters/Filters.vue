<template>
  <div
    class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4"
  >
    <SearchBar
      v-model="search"
      v-if="enableFilters.search"
      :searchPlaceHolderText="searchPlaceHolder"
    ></SearchBar>

    <DaterangePicker
      v-if="enableFilters.dateRange"
      :dateStart="dateStart"
      :dateEnd="dateEnd"
      @dateChanged="dateRangePick"
    ></DaterangePicker>

    <SortDropdown v-model="sortBy" v-if="enableFilters.sortBy"></SortDropdown>

    <FilterDropdown
      :filters="filters"
      @filterByFilterChangeEmit="(n) => (this.filterByFilter = n)"
      v-if="enableFilters.filterBy"
      :enableFilterByFilters="enableFilters.filterBy"
    ></FilterDropdown>
  </div>
</template>

<script>
import debounce from "lodash/debounce";
import { router } from "@inertiajs/core";
export default {
  props: ["dataName", "filters", "enableFilters", "searchPlaceHolder"],
  data() {
    return {
      search: this.filters.search !== undefined ? this.filters.search : "",
      dateStart:
        this.filters.dateStart !== undefined
          ? decodeURIComponent(this.filters.dateStart)
          : "",
      dateEnd:
        this.filters.dateEnd !== undefined
          ? decodeURIComponent(this.filters.dateEnd)
          : "",
      sortBy: this.filters.sortBy !== undefined ? this.filters.sortBy : "",
      filterByFilter: {},
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
    filterByFilter() {
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
      if (Object.keys(this.filterByFilter).length > 0) {
        Object.assign(filterQueries, this.filterByFilter);
      }
      router.get(`/admin-dashboard/${this.dataName}`, filterQueries, {
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
