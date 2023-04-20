import actions from "./auth/actions";
import getters from "./auth/getters";
import mutations from "./auth/mutations";
import state from "./auth/state";

const authModule = {
  namespaced: true,
  state,
  actions,
  mutations,
  getters,
};

export default authModule;
