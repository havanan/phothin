const resource = "/auth";
export default ($axios) => ({
  postLogin(payload) {
    return $axios.post(`${resource}`, payload);
  },
  info() {
    return $axios.get(`${resource}/info`);
  },

  // create(payload) {
  //   return $axios.post(`${resource}`, payload);
  // },

  // update(id, payload) {
  //   return $axios.post(`${resource}/${id}`, payload);
  // },

  // delete(id) {
  //   return $axios.delete(`${resource}/${id}`);
  // },
});
