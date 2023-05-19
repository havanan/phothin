<template>
  <div class="login-form d-flex flex-column align-center justify-center">
    <img src="~/assets/image/logo.png" class="mb-5 login-logo" />
    <v-card>
      <v-tabs
        v-model="tab"
        show-arrows
        background-color="deep-purple accent-4"
        icons-and-text
        dark
        grow
      >
        <v-tabs-slider color="purple darken-4"></v-tabs-slider>
        <v-tab v-for="(i, index) in tabs" :key="index">
          <!-- <v-icon>{{ i.icon }}</v-icon> -->
          {{ i.name }}
        </v-tab>
        <v-tab-item>
          <v-card class="px-4">
            <v-card-text>
              <v-form ref="loginForm" v-model="valid" lazy-validation>
                <v-row>
                  <v-col cols="12">
                    <v-text-field
                      v-model="email"
                      :rules="loginEmailRules"
                      label="Tài khoản"
                      required
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-text-field
                      v-model="password"
                      :append-icon="show1 ? 'eye' : 'eye-off'"
                      :rules="[rules.required, rules.min]"
                      :type="show1 ? 'text' : 'password'"
                      name="input-10-1"
                      label="Mật khẩu"
                      hint="Tối thiểu 6 ký tự"
                      counter
                      @click:append="show1 = !show1"
                    ></v-text-field>
                  </v-col>
                  <v-col class="d-flex" cols="12" sm="6" xsm="12"> </v-col>
                  <v-spacer></v-spacer>
                  <v-col class="d-flex" cols="12" sm="3" xsm="12" align-end>
                    <v-btn
                      x-large
                      block
                      :disabled="!valid"
                      color="success"
                      @click="validate"
                    >
                      Đăng Nhập
                    </v-btn>
                  </v-col>
                </v-row>
              </v-form>
            </v-card-text>
          </v-card>
        </v-tab-item>
        <!-- <v-tab-item>
          <v-card class="px-4">
            <v-card-text>
              <v-form ref="registerForm" v-model="valid" lazy-validation>
                <v-row>
                  <v-col cols="12" sm="6" md="6">
                    <v-text-field
                      v-model="firstName"
                      :rules="[rules.required]"
                      label="First Name"
                      maxlength="20"
                      required
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="6" md="6">
                    <v-text-field
                      v-model="lastName"
                      :rules="[rules.required]"
                      label="Last Name"
                      maxlength="20"
                      required
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-text-field
                      v-model="email"
                      :rules="emailRules"
                      label="E-mail"
                      required
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-text-field
                      v-model="password"
                      :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
                      :rules="[rules.required, rules.min]"
                      :type="show1 ? 'text' : 'password'"
                      name="input-10-1"
                      label="Password"
                      hint="At least 8 characters"
                      counter
                      @click:append="show1 = !show1"
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-text-field
                      block
                      v-model="verify"
                      :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
                      :rules="[rules.required, passwordMatch]"
                      :type="show1 ? 'text' : 'password'"
                      name="input-10-1"
                      label="Confirm Password"
                      counter
                      @click:append="show1 = !show1"
                    ></v-text-field>
                  </v-col>
                  <v-spacer></v-spacer>
                  <v-col class="d-flex ml-auto" cols="12" sm="3" xsm="12">
                    <v-btn
                      x-large
                      block
                      :disabled="!valid"
                      color="success"
                      @click="validate"
                      >Đăng ký</v-btn
                    >
                  </v-col>
                </v-row>
              </v-form>
            </v-card-text>
          </v-card>
        </v-tab-item> -->
      </v-tabs>
    </v-card>
  </div>
</template>

<script>
import { mapActions } from "vuex";

export default {
  name: "Login",
  layout: "auth",
  middleware: "checkLogin",
  head() {
    return {
      title: "Đăng Nhập",
    };
  },
  data() {
    return {
      email: "admin@gmail.com",
      password: "abcd1234",
      tab: 0,
      tabs: [
        { name: "Đăng Nhập Quản Trị", icon: "mdi-account" },
        // { name: "Đăng Ký", icon: "mdi-account-outline" },
      ],
      valid: true,
      firstName: "",
      lastName: "",
      verify: "",
      loginEmailRules: [
        (v) => !!v || "Required",
        (v) => /.+@.+\..+/.test(v) || "E-mail không đúng định dạng",
      ],
      show1: false,
      rules: {
        required: (value) => !!value || "Vui lòng không để trống",
        min: (v) => (v && v.length >= 6) || "Tối thiểu 6 kí tự",
      },
    };
  },
  methods: {
    ...mapActions("modules/auth", ["fetchAuthInfo"]),

    validate() {
      if (this.$refs.loginForm.validate()) {
        this.login();
      }
    },
    reset() {
      this.$refs.form.reset();
    },
    resetValidation() {
      this.$refs.form.resetValidation();
    },
    async login() {
      try {
        await this.$auth
          .loginWith("local", {
            data: {
              email: this.email,
              password: this.password,
            },
          })
          .then(() => {
            this.$toast.success("Đăng nhập thành công").goAway(1000);
            this.$router.push("/");
          });
      } catch (error) {
        this.$toast
          .error(error.message ? error.message : "Server đang bảo trì")
          .goAway(1300);
      }
    },
  },
};
</script>
