import * as types from "@/store/mutation-types";

export default {
  postUpdatePassw({ commit, dispatch }, payload) {
    return new Promise((resolve, reject) => {
      this.$repositories.admin
        .postChangePassw(payload)
        .then((response) => {
          dispatch("modules/notification/showSuccessNotification", response, {
            root: true,
          });
          resolve();
        })
        .catch((error) => {
          dispatch("modules/notification/showErrorNotification", error, {
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
          if (response.data && response.data.data && response.data.data) {
            this.$auth.setUser(response.data.data);
            //notification
            dispatch("modules/notification/showSuccessNotification", response, {
              root: true,
            });
            resolve();
          }
        })
        .catch((error) => {
          dispatch("modules/notification/showErrorNotification", error, {
            root: true,
          });
          reject();
        });
    });
  },
  getListPaging({ commit }, payload) {
    return new Promise((resolve, reject) => {
      this.$repositories.admin
        .getListPaging(payload)
        .then((response) => {
          if (response.status === 200 && response.data && response.data.data) {
            const result = response.data;
            commit(types.ADMIN_LIST, result.data);
            commit(types.ADMIN_TOTAL, result.meta.pagination.total);
            resolve();
          }
        })
        .catch((error) => {
          reject(error);
        });
    });
  },
  postCreate({ dispatch }, payload) {
    return new Promise((resolve, reject) => {
      this.$repositories.admin
        .create(payload)
        .then((response) => {
          dispatch("modules/notification/showSuccessNotification", response, {
            root: true,
          });
          resolve();
        })
        .catch((error) => {
          dispatch("modules/notification/showErrorNotification", error, {
            root: true,
          });
          reject();
        });
    });
  },
  postUpdate({ dispatch }, payload) {
    return new Promise((resolve, reject) => {
      this.$repositories.admin
        .update(payload.id, payload)
        .then((response) => {
          dispatch("modules/notification/showSuccessNotification", response, {
            root: true,
          });
          resolve();
        })
        .catch((error) => {
          dispatch("modules/notification/showErrorNotification", error, {
            root: true,
          });
          reject();
        });
    });
  },
};
