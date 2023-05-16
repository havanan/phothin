const resource = "/admin-user";
export default ($axios) => ({
  postChangePassw(payload) {
    return $axios.post(`${resource}/change-passw`, payload);
  },
  postChangeInfo(payload) {
    return $axios.post(`${resource}/change-info`, payload);
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
