import * as types from "@/store/mutation-types";
export default {
  [types.ADMIN_LIST](state, value) {
    state.adminList = value;
  },
  [types.ADMIN_TOTAL](state, value) {
    state.adminTotal = value;
  },
};
