import colors from "vuetify/es5/util/colors";

export default {
  // Disable server-side rendering: https://go.nuxtjs.dev/ssr-mode
  ssr: false,
  server: {
    port: process.env.BACKEND_PORT || 3000,
  },
  // Target: https://go.nuxtjs.dev/config-target
  target: "static",
  // Global page headers: https://go.nuxtjs.dev/config-head
  head: {
    titleTemplate: "%s - Quản Trị Phở Thìn Hà Nội",
    title: "",
    htmlAttrs: {
      lang: "vi",
    },
    meta: [
      { charset: "utf-8" },
      { name: "viewport", content: "width=device-width, initial-scale=1" },
      { hid: "description", name: "description", content: "" },
      { name: "format-detection", content: "telephone=no" },
    ],
    link: [{ rel: "icon", type: "image/x-icon", href: "/logo.ico" }],
  },

  css: ["@/assets/sass/auth", "@/assets/sass/dashboard"],

  plugins: [
    "~/plugins/repositories.js",
    // "~/plugins/axios.js",
    "~/plugins/auth.js",
  ],

  // Auto import components: https://go.nuxtjs.dev/config-components
  components: true,
  // Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
  buildModules: [
    // https://go.nuxtjs.dev/vuetify
    "@nuxtjs/vuetify",
    "@nuxtjs/moment",
  ],
  // Modules: https://go.nuxtjs.dev/config-modules
  modules: [
    "@nuxtjs/axios",
    "@nuxtjs/i18n",
    "@nuxtjs/auth-next",
    "@nuxtjs/toast",
  ],
  moment: {
    defaultLocale: "vi",
  },
  axios: {
    baseURL: process.env.BASE_URL,
    retry: { retries: 3 },
    headers: {
      common: {
        Accept: "application/json",
        "Content-Type": "application/json",
      },
    },
  },
  i18n: {
    /* module options */
  },
  toast: {
    position: "top-right",
    register: [
      // Register custom toasts
      // {
      //   name: "my-error",
      //   message: "Oops...Something went wrong",
      //   options: {
      //     type: "error",
      //   },
      // },
    ],
  },
  auth: {
    strategies: {
      local: {
        token: {
          property: "access_token",
          // maxAge: 1800,
        },
        user: {
          property: "data",
          autoFetch: true,
        },
        endpoints: {
          login: {
            url: "admin/auth/login",
            method: "post",
          },
          logout: { url: "admin/auth/logout", method: "post" },
          user: { url: "admin/auth/user", method: "get", data: "data" },
        },
      },
    },
    watchLoggedIn: true,
    redirect: {
      login: "/login",
      logout: "/",
      callback: "/login",
      home: "/",
    },
  },
  // Vuetify module configuration: https://go.nuxtjs.dev/config-vuetify
  vuetify: {
    customVariables: ["~/assets/sass/variables.scss"],
    theme: {
      dark: false,
      themes: {
        dark: {
          primary: colors.blue.darken2,
          accent: colors.grey.darken3,
          secondary: colors.amber.darken3,
          info: colors.teal.lighten1,
          warning: colors.amber.base,
          error: colors.deepOrange.accent4,
          success: colors.green.accent3,
        },
      },
    },
  },

  // Build Configuration: https://go.nuxtjs.dev/config-build
  build: {
    transpile: ["@nuxtjs/auth"],
  },
};
