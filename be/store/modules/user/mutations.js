import * as types from "@/store/mutation-types";
export default {
  [types.AUTH_INFO](state, value) {
    state.authInfo = value;
  },
};
