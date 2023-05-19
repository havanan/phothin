// export default ({ $axios, $config: { baseUrlIam, secretToken } }) => {
//   // console.log(secretToken);
//   $axios.defaults.baseURL = process.env.baseUrl;
//   // $axios.defaults.headers.Authorization = secretToken;
// };

export default function ({ $axios, error: nuxtError }) {
  if (process.client) {
    $axios.setBaseURL(process.env.baseDevUrl);
  }
  if (process.server) {
    $axios.setBaseURL(process.env.baseUrl);
  }
  // $axios.onResponse((onResponse) => {
  //   console.log("onResponse");
  // });
  $axios.onResponseError((error) => {
    if (error.response) {
      // form validate return error code
      if (
        error.response.status === 400 &&
        error.response.data &&
        error.response.data.data
      ) {
        return Promise.reject(error.response.data.data);
      }
    }
    return Promise.reject(error);
  });
  // $axios.onError((error) => {
  //   // const code = parseInt(error.response && error.response.status);
  //   console.log("onError", error.response.status, error.message);
  // });
  // $axios.onRequestError((onResponse) => {
  //   console.log("onRequestError");
  // });
}
