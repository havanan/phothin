<template>
  <v-container fluid class="user-profile">
    <!-- <v-tabs color="#753020" background-color="var(--base-color)">
      <v-tab>Item One</v-tab>
      <v-tab>Item Two</v-tab>
      <v-tab>Item Three</v-tab>
    </v-tabs> -->
    <v-tabs
      color="current"
      background-color="var(--base-color)"
      class="custom-tab"
      v-model="currrentTab"
    >
      <v-tab><v-icon>mdi-account-outline</v-icon>Thông tin cá nhân</v-tab>
      <v-tab><v-icon>mdi-lock-open-outline</v-icon> Cập nhật mật khẩu</v-tab>
      <v-tab-item>
        <v-container fluid>
          <v-card>
            <v-card-title>Cập nhật thông tin</v-card-title>
            <v-card-text>
              <v-form ref="formChageInfo">
                <v-row>
                  <v-col cols="12" md="12">
                    <v-text-field
                      disabled
                      v-model="userInfo.email"
                      label="E-mail"
                      required
                      outlined
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12" md="6">
                    <v-text-field
                      v-model="userInfo.name"
                      label="Tên hiển thị"
                      required
                      outlined
                    ></v-text-field>
                  </v-col>

                  <v-col cols="12" md="6">
                    <v-text-field
                      v-model="userInfo.phone"
                      :counter="19"
                      label="Số điện thoại"
                      required
                      outlined
                    ></v-text-field>
                  </v-col>

                  <v-col cols="12" md="12" class="d-flex justify-center">
                    <v-btn
                      large
                      :disabled="loading2"
                      color="success"
                      @click="updateInfo()"
                      class="mr-3"
                    >
                      Cập nhật
                    </v-btn>
                    <v-btn large type="reset" color="primary" outlined
                      >Nhập lại</v-btn
                    >
                  </v-col>
                </v-row>
              </v-form>
            </v-card-text>
          </v-card></v-container
        >
      </v-tab-item>
      <v-tab-item>
        <v-container fluid>
          <v-card>
            <v-card-title>Cập nhật mật khẩu</v-card-title>
            <v-card-text>
              <v-form ref="formChagePassw">
                <v-row>
                  <v-col cols="12" md="6">
                    <v-text-field
                      v-model="pass.old"
                      :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
                      :type="show1 ? 'text' : 'password'"
                      :rules="passRules"
                      @click:append="show1 = !show1"
                      label="Mật khẩu cũ"
                      outlined
                      required
                    ></v-text-field>
                  </v-col>
                </v-row>
                <v-row>
                  <v-col cols="12" md="6">
                    <v-text-field
                      v-model="pass.new"
                      :rules="passRules"
                      :append-icon="show2 ? 'mdi-eye' : 'mdi-eye-off'"
                      :type="show2 ? 'text' : 'password'"
                      @click:append="show2 = !show2"
                      outlined
                      label="Mật khẩu mới"
                      required
                    ></v-text-field>
                  </v-col>

                  <v-col cols="12" md="6">
                    <v-text-field
                      v-model="pass.re"
                      outlined
                      :rules="passRules.concat(passwordConfirmationRule)"
                      :append-icon="show3 ? 'mdi-eye' : 'mdi-eye-off'"
                      :type="show3 ? 'text' : 'password'"
                      @click:append="show3 = !show3"
                      label="Xác thực mật khẩu mới"
                      required
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12" md="12" class="d-flex justify-center">
                    <v-btn
                      class="mr-3"
                      :disabled="loading"
                      color="error"
                      @click="updatePassword()"
                      large
                    >
                      Đổi mật khẩu
                    </v-btn>
                    <v-btn large type="reset" color="primary" outlined
                      >Nhập lại</v-btn
                    >
                  </v-col>
                </v-row>
              </v-form>
            </v-card-text>
          </v-card>
        </v-container>
      </v-tab-item>
    </v-tabs>
  </v-container>
</template>
<script>
import { mapActions } from "vuex";
export default {
  name: "UserProfile",
  head() {
    return {
      title: "Thông tin tài khoản",
    };
  },
  data: () => ({
    loading: false,
    loading2: false,
    show1: false,
    show2: false,
    show3: false,
    currrentTab: 1,
    nameRules: [
      (v) => !!v || "Tên không được để trống",
      (v) => v.length >= 6 || "Tên tối thiểu 6 kí tự",
    ],
    passRules: [
      (v) => !!v || "Vui lòng không được để trống",
      (v) => (v && v.length >= 6) || "Tối thiểu 6 kí tự",
    ],
    userInfo: {
      email: null,
      name: null,
      phone: null,
    },
    pass: {
      old: null,
      new: null,
      re: null,
    },
  }),
  computed: {
    passwordConfirmationRule() {
      return () =>
        this.pass.new === this.pass.re || "Xác thực mật khẩu không khớp";
    },
  },
  mounted() {
    this.userInfo = Object.assign({}, this.$auth.user);
    this.pass.user_id = this.$auth.user.id;
  },
  watch: {
    currrentTab(newVal) {
      if (newVal === 1) {
        this.resetFormChagePass();
      }
    },
  },
  methods: {
    ...mapActions("modules/admin", ["postUpdatePassw", "postUpdateInfo"]),
    async updatePassword() {
      try {
        this.loading = true;
        await this.postUpdatePassw(this.pass);
        this.resetFormChagePass();
      } catch (error) {}
      this.loading = false;
    },
    resetFormChagePass() {
      this.pass.old = null;
      this.pass.new = null;
      this.pass.re = null;
      if (this.$refs.formChagePassw) {
        this.$refs.formChagePassw.reset();
      }
    },
    async updateInfo() {
      try {
        this.loading = true;
        await this.postUpdateInfo({
          id: this.userInfo.id,
          name: this.userInfo.name,
          phone: this.userInfo.phone,
        });
        // this.$refs.formChageInfo.reset();
      } catch (error) {}
      this.loading = false;
    },
  },
};
</script>
<style>
@import "~/assets/sass/user-profile.scss";
</style>
