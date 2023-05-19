import * as types from "@/store/mutation-types";
export default {
  setNotificationWeb({ commit }, payload) {
    commit(types.NOTIFICATION_MESSAGES, payload);
  },
  showSuccessNotification({}, payload) {
    const timeOut = 1500;
    if (payload.data && payload.data.message) {
      this.$toast.success(payload.data.message).goAway(timeOut);
    }
  },
  showErrorNotification({}, payload) {
    const timeOut = 1500;
    if (payload && payload.errors) {
      const res = payload.errors;
      let i = 1;
      for (const key in res) {
        if (res[key] && res[key][0]) {
          this.$toast.error(res[key][0]).goAway(timeOut + 100 * i);
          i++;
        }
      }
    }
  },
};
