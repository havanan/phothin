import * as types from "@/store/mutation-types";
export default {
  [types.NOTIFICATION_MESSAGES](state, value) {
    state.messages = value;
  },
};
