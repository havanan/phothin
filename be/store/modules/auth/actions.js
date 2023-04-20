export default {
  fetchAuthInfo({ commit }) {
    console.log("ahihi");
    // const res = this.$repositories.auth.info();
    // const { status, data } = res;
    // if (status === 200 && data.success && data.code) {
    //   const { data } = data;
    //   commit("AUTH_INFO", data);
    // } else {
    // }
  },
  postLogin({ commit }, payload) {
    const res = this.$repositories.auth.info(payload);
  },
};
