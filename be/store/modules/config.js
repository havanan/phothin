import actions from "./config/actions";
import getters from "./config/getters";
import mutations from "./config/mutations";
import state from "./config/state";

const configModule = {
  namespaced: true,
  state,
  actions,
  mutations,
  getters,
};

export default configModule;
