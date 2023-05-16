import * as types from "@/store/mutation-types";
export default {
  setNotificationWeb({ commit }, payload) {
    commit(types.NOTIFICATION_MESSAGES, payload);
  },
  showNotificationWeb({}, payload) {
    const timeOut = 1500;
    const notifications = payload.data;

    if (
      payload.type === "success" &&
      notifications &&
      notifications.data &&
      notifications.data.message
    ) {
      this.$toast.success(notifications.data.message).goAway(timeOut);
    }
    if (
      payload.type === "error" &&
      notifications &&
      notifications.response &&
      notifications.response.data &&
      notifications.response.data.data &&
      notifications.response.data.data.errors
    ) {
      const res = notifications.response.data.data.errors;
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
