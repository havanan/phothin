import * as types from "@/store/mutation-types";
export default {
  toggleShowDialog({ commit }, payload) {
    commit(types.SHOW_DIALOG, payload);
  },
};
