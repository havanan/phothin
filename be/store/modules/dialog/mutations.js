import * as types from "@/store/mutation-types";
export default {
  [types.SHOW_DIALOG](state, value) {
    state.showDialog = value;
  },
};
