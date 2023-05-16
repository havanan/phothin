import actions from "./notification/actions";
import getters from "./notification/getters";
import mutations from "./notification/mutations";
import state from "./notification/state";

const notificationModule = {
  namespaced: true,
  state,
  actions,
  mutations,
  getters,
};

export default notificationModule;
