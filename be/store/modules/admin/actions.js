export default {
  postUpdatePassw({ commit, dispatch }, payload) {
    return new Promise((resolve, reject) => {
      this.$repositories.admin
        .postChangePassw(payload)
        .then((response) => {
          const res = { data: response, type: "success" };
          dispatch("modules/notification/showNotificationWeb", res, {
            root: true,
          });

          resolve();
        })
        .catch((error) => {
          const res = {
            data: error,
            type: "error",
          };
          dispatch("modules/notification/showNotificationWeb", res, {
            root: true,
          });
          reject();
        });
    });
  },
  postUpdateInfo({ commit, dispatch }, payload) {
    return new Promise((resolve, reject) => {
      this.$repositories.admin
        .postChangeInfo(payload)
        .then((response) => {
          const res = { data: response, type: "success" };

          if (response.data && response.data.data) {
            this.$auth.setUser(response.data.data);
          }
          //notification
          dispatch("modules/notification/showNotificationWeb", res, {
            root: true,
          });

          resolve();
        })
        .catch((error) => {
          const res = {
            data: error,
            type: "error",
          };
          dispatch("modules/notification/showNotificationWeb", res, {
            root: true,
          });
          reject();
        });
    });
  },
};
