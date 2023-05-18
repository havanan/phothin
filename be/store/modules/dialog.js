import actions from "./dialog/actions";
import getters from "./dialog/getters";
import mutations from "./dialog/mutations";
import state from "./dialog/state";

const dialogModule = {
  namespaced: true,
  state,
  actions,
  mutations,
  getters,
};

export default dialogModule;
