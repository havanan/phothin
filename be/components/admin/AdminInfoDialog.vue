<template>
  <div>
    <v-dialog
      :value="value"
      transition="dialog-bottom-transition"
      max-width="70%"
      @input="$emit('input', $event)"
    >
      <v-form ref="formAdmin" v-model="validForm" lazy-validation>
        <v-card>
          <v-toolbar color="current" dark>
            <h6 class="text-h6">
              {{ editedItem.id ? "Thêm người dùng hệ thống" : "Sửa thông tin" }}
            </h6>
          </v-toolbar>
          <v-card-text class="mt-10">
            <v-row>
              <v-col cols="12" md="12"
                ><v-text-field
                  outlined
                  :readonly="action !== 'create'"
                  :rules="emailRules"
                  v-model="editedItem.email"
                  label="Email"
                ></v-text-field
              ></v-col>
              <v-col cols="12" md="6"
                ><v-text-field
                  outlined
                  v-model="editedItem.name"
                  label="Tên hiển thị"
                  :readonly="action === 'show'"
                  :rules="[
                    () =>
                      !!editedItem.name || 'Tên hiển thị không được để trống',
                  ]"
                ></v-text-field
              ></v-col>
              <v-col cols="12" md="6"
                ><v-text-field
                  outlined
                  v-model="editedItem.phone"
                  label="Số điện thoại"
                  :readonly="action === 'show'"
                  :rules="[
                    () =>
                      !!editedItem.name || 'Số điện thoại không được để trống',
                  ]"
                ></v-text-field
              ></v-col>

              <v-col cols="12" md="6">
                <v-select
                  :items="roleList"
                  item-value="code"
                  item-text="name"
                  label="Chọn quyền"
                  outlined
                  class="mr-4"
                  v-model="editedItem.role"
                  :readonly="action === 'show'"
                  :rules="[() => !!editedItem.role || 'Vui lòng chọn quyền']"
                ></v-select>
              </v-col>
              <v-col cols="12" md="6">
                <v-select
                  :items="statusList"
                  item-value="code"
                  item-text="name"
                  label="Trạng thái"
                  outlined
                  class="mr-4"
                  v-model="editedItem.status"
                  :readonly="action === 'show'"
                  :rules="[
                    () => !!editedItem.role || 'Vui lòng chọn trạng thái',
                  ]"
                ></v-select>
              </v-col>
              <v-col cols="12" md="12">
                <v-text-field
                  label="Địa chỉ"
                  auto-grow
                  outlined
                  v-model="editedItem.address"
                  :readonly="action === 'show'"
                ></v-text-field>
              </v-col>
              <v-col cols="12" md="12">
                <v-textarea
                  label="Ghi chú"
                  auto-grow
                  outlined
                  rows="4"
                  row-height="30"
                  :readonly="action === 'show'"
                  v-model="editedItem.note"
                ></v-textarea>
              </v-col>
            </v-row>
          </v-card-text>
          <v-card-actions class="justify-end">
            <v-btn
              v-if="action !== 'show'"
              large
              outlined
              color="success"
              @click="validate()"
              :disabled="!validForm"
              >Lưu</v-btn
            >
            <v-btn
              v-if="action !== 'show'"
              large
              color="warning"
              outlined
              type="reset"
              >Nhập lại</v-btn
            >
            <v-btn large color="error" outlined @click="closeDialog()"
              >Đóng</v-btn
            >
          </v-card-actions>
        </v-card>
      </v-form>
    </v-dialog>
  </div>
</template>
<script>
import { mapActions } from "vuex";
export default {
  name: "AdminInfoDialog",
  props: {
    editedItem: {
      type: Object,
      default() {
        return {
          address: null,
          avatar: null,
          created_at: null,
          deleted_at: null,
          email: null,
          email_verified_at: null,
          id: null,
          locations: null,
          name: null,
          note: null,
          phone: null,
          role_id: 0,
          status: 1,
          updated_at: null,
          verify_email_token: null,
          address: null,
        };
      },
    },
    value: {
      type: Boolean,
      default() {
        return false;
      },
    },
    roleList: {
      type: Array,
      default() {
        return [];
      },
    },
    statusList: {
      type: Array,
      default() {
        return [];
      },
    },
    action: {
      type: String,
      default() {
        return "create";
      },
    },
  },
  data() {
    return {
      validForm: true,
      emailRules: [
        (v) => !!v || "Required",
        (v) => (v && /.+@.+\..+/.test(v)) || "E-mail không đúng định dạng",
      ],
    };
  },
  computed: {},
  watch: {},
  methods: {
    ...mapActions("modules/admin", ["postCreate", "postUpdate"]),
    closeDialog() {
      this.$refs.formAdmin.reset();
      this.$emit("input", false);
    },
    validate() {
      if (this.$refs.formAdmin.validate()) {
        this.saveForm();
      }
    },
    async saveForm() {
      try {
        if (this.editedItem.id) {
          await this.postUpdate(this.editedItem);
        } else {
          await this.postCreate(this.editedItem);
        }
        this.closeDialog();
      } catch (error) {}
    },
  },
};
</script>
