import Vue from "vue";

const mixin = {
  methods: {
    formatDate(oldDate, type = "DD/MM/YYYY") {
      return this.$moment(oldDate).format(type);
    },
    formatDateTime(oldDate, type = "DD/MM/YYYY H:mm:ss") {
      return this.$moment(oldDate).format(type);
    },
    buildPayloadPagination(pagination, search = {}) {
      const { page, itemsPerPage } = pagination;
      let { sortBy } = pagination;
      const sortDesc = pagination.sortDesc;
      let defaultSort = "desc";
      // When sorting you always get both values
      if (sortBy && sortBy.length === 1 && sortDesc && sortDesc.length === 1) {
        // Gets order
        defaultSort = sortDesc[0] === true ? "desc" : "asc";
        // Gets column to sort on
        sortBy = sortBy ? sortBy[0] : "";
      }
      // Merge search params
      const result = {
        order_by: sortBy,
        sort: defaultSort,
        page,
        limit: itemsPerPage,
      };
      if (Object.keys(search).length) {
        for (const item in search) {
          result[item] = search[item];
        }
      }

      return result;
    },
    mergeTwoArray(arr1, arr2) {
      const arr = arr1.concat(arr2);
      return arr.filter((item, pos) => arr.indexOf(item) === pos);
    },
  },
};
Vue.mixin(mixin);
