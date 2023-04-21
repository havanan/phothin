<template>
  <div class="app flex-row align-items-center">
    <div class="container">
      <b-row class="justify-content-center login">
        <b-col md="6">
          <b-card-group>
            <b-card no-body class="p-4">
              <b-card-body>
                <h1>Login</h1>
                <Notification :message="error" v-if="error" />
                <p class="text-muted">Sign In to your account</p>
                <b-input-group class="mb-3">
                  <b-input-group-prepend>
                    <b-input-group-text
                      ><i class="icon-user"></i
                    ></b-input-group-text>
                  </b-input-group-prepend>
                  <input
                    type="text"
                    class="form-control"
                    v-model="username"
                    placeholder="username"
                  />
                </b-input-group>

                <b-input-group class="mb-4">
                  <b-input-group-prepend>
                    <b-input-group-text
                      ><i class="icon-lock"></i
                    ></b-input-group-text>
                  </b-input-group-prepend>
                  <input
                    type="password"
                    class="form-control"
                    v-model="password"
                    placeholder="Password"
                  />
                </b-input-group>

                <b-row>
                  <b-col cols="6">
                    <b-button variant="primary" class="px-4" @click="login"
                      >Login</b-button
                    >
                  </b-col>
                </b-row>
              </b-card-body>
            </b-card>
          </b-card-group>
        </b-col>
      </b-row>
    </div>
  </div>
</template>

<script>
import Notification from "~/components/Notification";

export default {
  name: "Login",
  layout: "auth",
  components: {
    Notification,
  },

  data() {
    return {
      username: "",
      password: "",
      error: null,
    };
  },

  methods: {
    async login() {
      try {
        const response = await this.$axios.post("accounts/token/", {
          username: this.username,
          password: this.password,
        });

        await this.$auth.setToken("local", "Bearer " + response.data.access);
        await this.$auth.setRefreshToken("local", response.data.refresh);
        await this.$auth.setUserToken(response.data.access);
      } catch (e) {
        this.error = "Username or Password not valid";
      }
    },
  },
};
</script>
