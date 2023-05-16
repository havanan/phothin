<template>
  <v-row class="mt-10">
    <v-col cols="12" md="4">
      <v-card>
        <v-form ref="formChagePassw">
          <v-container>
            <v-row>
              <v-col md="12">
                <h4 class="text-h5">Cập nhật mật khẩu</h4>
              </v-col>
              <v-col cols="12" md="12">
                <v-text-field
                  v-model="pass.old"
                  :rules="passRules"
                  label="Mật khẩu cũ"
                  required
                ></v-text-field>
              </v-col>

              <v-col cols="12" md="12">
                <v-text-field
                  v-model="pass.new"
                  :rules="passRules"
                  label="Mật khẩu mới"
                  required
                ></v-text-field>
              </v-col>

              <v-col cols="12" md="12">
                <v-text-field
                  v-model="pass.re"
                  :rules="passRules.concat(passwordConfirmationRule)"
                  label="Xác thực mật khẩu mới"
                  required
                ></v-text-field>
              </v-col>
              <v-col cols="12" md="12" class="d-flex justify-center">
                <v-btn
                  class="ma-2"
                  :disabled="loading"
                  color="error"
                  @click="updatePassword()"
                >
                  Đổi mật khẩu
                </v-btn>
              </v-col>
            </v-row>
          </v-container>
        </v-form>
      </v-card>
    </v-col>
    <v-col cols="12" md="8">
      <v-card>
        <v-form ref="formChageInfo">
          <v-container>
            <v-row>
              <v-col md="12">
                <h4 class="text-h5">Cập nhật thông tin</h4>
              </v-col>
              <v-col cols="12" md="12">
                <v-text-field
                  disabled
                  v-model="userInfo.email"
                  label="E-mail"
                  required
                ></v-text-field>
              </v-col>
              <v-col cols="12" md="6">
                <v-text-field
                  v-model="userInfo.name"
                  label="Tên hiển thị"
                  required
                ></v-text-field>
              </v-col>

              <v-col cols="12" md="6">
                <v-text-field
                  v-model="userInfo.phone"
                  :counter="19"
                  label="Số điện thoại"
                  required
                ></v-text-field>
              </v-col>

              <v-col cols="12" md="12" class="d-flex justify-end">
                <v-btn
                  class="ma-2"
                  :disabled="loading2"
                  color="success"
                  @click="updateInfo()"
                >
                  Cập nhật
                </v-btn>
              </v-col>
            </v-row>
          </v-container>
        </v-form>
      </v-card>
    </v-col>
  </v-row>
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
  watch: {},
  methods: {
    ...mapActions("modules/admin", ["postUpdatePassw", "postUpdateInfo"]),
    async updatePassword() {
      try {
        this.loading = true;
        await this.postUpdatePassw(this.pass);
        this.pass.old = null;
        this.pass.new = null;
        this.pass.re = null;
        this.$refs.formChagePassw.reset();
      } catch (error) {}
      this.loading = false;
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
