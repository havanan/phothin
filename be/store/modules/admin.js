import actions from "./admin/actions";
import getters from "./admin/getters";
import mutations from "./admin/mutations";
import state from "./admin/state";

const adminModule = {
  namespaced: true,
  state,
  actions,
  mutations,
  getters,
};

export default adminModule;
