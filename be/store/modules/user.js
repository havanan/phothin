import actions from "./user/actions";
import getters from "./user/getters";
import mutations from "./user/mutations";
import state from "./user/state";

const userModule = {
  namespaced: true,
  state,
  actions,
  mutations,
  getters,
};

export default userModule;
