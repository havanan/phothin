const resource = "/admin-user";
export default ($axios) => ({
  postChangePassw(payload) {
    return $axios.post(`${resource}/change-passw`, payload);
  },
  postChangeInfo(payload) {
    return $axios.post(`${resource}/change-info`, payload);
  },
  getListPaging(payload) {
    return $axios.get(`${resource}/list`, { params: payload });
  },
  create(payload) {
    return $axios.post(`${resource}/create`, payload);
  },
  update(id, payload) {
    return $axios.post(`${resource}/update/${id}`, payload);
  },
  delete(id) {
    return $axios.get(`${resource}/delete/${id}`);
  },
});
