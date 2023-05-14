const resource = "/user";
export default ($axios) => ({
  postChangePassw(payload) {
    return $axios.post(`${resource}/change-passw`, payload);
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
