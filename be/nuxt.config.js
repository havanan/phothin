import colors from "vuetify/es5/util/colors";

export default {
  ssr: false,
  env: {
    siteName: process.env.SITE_NAME,
    baseDevUrl: process.env.BASE_DEV_URL,
    baseProductUrl: process.env.BASE_PRODUCT_URL,
  },
  server: {
    port: process.env.BACKEND_PORT || 3300,
  },
  target: "static",
  head: {
    titleTemplate: "%s - " + process.env.SITE_NAME,
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
  loading: {
    color: "#1867c0",
    height: "5px",
  },
  css: ["@/assets/sass/auth", "@/assets/sass/dashboard"],
  plugins: [
    "~/plugins/repositories",
    "~/plugins/axios",
    "~/plugins/auth",
    "~/plugins/mixin",
    "~/plugins/VuetifyConfirm",
  ],

  components: true,
  buildModules: ["@nuxtjs/vuetify", "@nuxtjs/moment"],
  modules: [
    "@nuxtjs/axios",
    "@nuxtjs/i18n",
    "@nuxtjs/auth-next",
    "@nuxtjs/toast",
  ],
  moment: {
    defaultLocale: "vi",
  },
  // axios: {
  //   baseURL: process.env.BASE_URL,
  //   retry: { retries: 3 },
  //   headers: {
  //     common: {
  //       Accept: "application/json",
  //       "Content-Type": "application/json",
  //     },
  //   },
  // },
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
            url: "auth/login",
            method: "post",
          },
          logout: { url: "auth/logout", method: "post" },
          user: { url: "auth/user", method: "get", data: "data" },
        },
      },
    },
    watchLoggedIn: true,
    redirect: {
      login: "/login",
      logout: "/",
      callback: false,
      home: false,
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
        light: {
          current: "#753020",
        },
      },
    },
  },

  // Build Configuration: https://go.nuxtjs.dev/config-build
  build: {
    transpile: ["@nuxtjs/auth"],
  },
};
