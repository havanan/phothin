export default function ({ $axios, store }) {
  $axios.setHeader("Content-Type", "application/json");
  $axios.setToken(store.state.api_token, "Bearer");

  $axios.onError((error) => {
    const statusCode = error.response.status;

    // refresh token if it expired
    if (statusCode === 403) {
      const originalRequest = error.config;
      if (!originalRequest._retry) {
        originalRequest._retry = true;
        return $axios
          .post("api/admin/auth/token", {
            refresh: app.$auth.getRefreshToken("local"),
          })
          .then((response) => {
            originalRequest.headers["Authorization"] =
              "Bearer " + response.data.access;
            app.$auth.setToken("local", "Bearer " + response.data.access);
            return $axios(originalRequest);
          });
      }
    }

    return Promise.reject(error);
  });
}
