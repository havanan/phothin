<template>
  <v-container fluid>
    <v-card>
      <v-card-title>
        <span class="text-base">Danh sách người dùng hệ thống</span>
      </v-card-title>
      <v-card-text class="d-flex flex-wrap">
        <div class="flex-grow-1"></div>
        <div class="d-flex flex-row align-center">
          <v-select
            :items="items"
            item-value="code"
            item-text="name"
            label="Chọn quyền"
            dense
            outlined
            hide-details
            class="mr-4"
            v-model="searchParams.role"
          ></v-select>
          <v-select
            :items="statusLst"
            item-value="code"
            item-text="name"
            label="Trạng thái"
            dense
            outlined
            hide-details
            class="mr-4"
            v-model="searchParams.status"
          ></v-select>
          <v-text-field
            placeholder="Tìm kiếm"
            class="mr-4"
            hide-details
            clearable
            outlined
            dense
            v-model="searchParams.free_word"
          ></v-text-field>
          <create-buttons @create-method="create"></create-buttons>
        </div>
      </v-card-text>
    </v-card>
    <v-card class="mt-5 pt-5 pb-5">
      <v-data-table
        v-model="selected"
        :headers="headers"
        :items="desserts"
        item-key="name"
        :show-select="false"
        :loading="tableLoading"
        hide-default-footer
        loading-text="Đang cập nhật dữ liệu..."
        no-data-text="Không có dữ liệu"
        no-results-text="Không có kết quả phù hợp"
        :page.sync="page"
        :items-per-page="itemsPerPage"
        :options.sync="pagination"
        :server-items-length="totalItems"
        @page-count="pageCount = $event"
        class="custom-table"
      >
        <!-- <template v-slot:header.action="{ header }">
          <div class="d-flex justify-end">
            <v-btn icon color="error"
              ><v-icon>mdi-delete-outline</v-icon></v-btn
            >
          </div>
        </template> -->
        <template v-slot:item.created_at="{ item }">
          {{ formatDateTime(item.created_at) }}
        </template>
        <template v-slot:item.id="{ item }">
          <strong class="base-color"> #{{ item.id }}</strong>
        </template>
        <template v-slot:item.role="{ item }">
          <template v-for="(role, index) in items">
            <span v-if="item.role === role.code" :key="index"
              ><v-icon class="mr-2" :color="role.color">{{ role.icon }}</v-icon>
              {{ role.name }}</span
            >
          </template>
        </template>
        <template v-slot:item.status="{ item }">
          <v-switch
            v-model="item.status"
            :color="item.status === 1 ? 'success' : ''"
            readonly
            hide-details
          ></v-switch>
        </template>
        <template v-slot:item.action="{ item }">
          <table-default-buttons
            :item="item"
            @show-method="show"
            @edit-method="edit"
            @remove-method="remove"
          ></table-default-buttons>
        </template>
      </v-data-table>
      <div v-if="pageCount > 1" class="pt-5 pb-5">
        <v-pagination v-model="page" :length="pageCount"></v-pagination>
      </div>
    </v-card>
    <admin-info-dialog
      v-model="dialog"
      :role-list="items"
      :status-list="statusLst"
      :edited-item="editedItem"
      :action="action"
    ></admin-info-dialog>
  </v-container>
</template>
<script>
import TableDefaultButtons from "~/components/TableDefaulButtons.vue";
import CreateButtons from "~/components/CreateButtons.vue";
import { mapState, mapActions, mapGetters } from "vuex";
import AdminInfoDialog from "../../components/admin/AdminInfoDialog.vue";

export default {
  components: { TableDefaultButtons, CreateButtons, AdminInfoDialog },
  name: "AdminList",
  head() {
    return {
      title: "Danh sách tài khoản hệ thống",
    };
  },
  data() {
    return {
      dialog: false,
      tableLoading: false,
      page: 1,
      pageCount: 0,
      action: "create",
      btnOptions: {},
      pagination: {},
      selected: [],
      editedItem: {},
      searchParams: {
        free_word: null,
        role: null,
        status: null,
      },
      items: [
        {
          name: "Nhân viên",
          code: 0,
          color: "success",
          icon: "mdi-account-outline",
        },
        { name: "Admin", code: 1, color: "error", icon: "mdi-account-star" },
        { name: "Kế toán", code: 2, color: "primary", icon: "mdi-glasses" },
      ],
      statusLst: [
        { name: "Kích hoạt", code: 1 },
        { name: "Vô hiệu hoá", code: 0 },
      ],

      headers: [
        { text: "#ID", value: "id" },
        {
          text: "Tên hiển thị",
          value: "name",
        },
        { text: "Diện thoại", value: "phone" },
        { text: "Email", value: "email" },
        { text: "Quyền", value: "role" },
        { text: "Trạng thái", value: "status" },
        { text: "Ngày tạo", value: "created_at" },
        { text: "", value: "action", sortable: false },
      ],
    };
  },
  computed: {
    ...mapGetters("modules/admin", ["adminList", "adminTotal"]),
    ...mapState("modules/config", ["defaultItemsPerPage", "defaultDateFormat"]),
    itemsPerPage() {
      return this.defaultItemsPerPage;
    },
    dateFormat() {
      return this.defaultDateFormat;
    },
    totalItems() {
      return this.adminTotal;
    },
    desserts() {
      return this.adminList;
    },
  },
  watch: {
    pagination(newVal) {
      this.searchForm();
    },
  },
  methods: {
    ...mapActions("modules/admin", ["getListPaging"]),
    create(params) {
      this.action = "create";
      this.dialog = true;
    },
    show(item) {
      this.action = "show";
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },
    edit(item) {
      this.action = "edit";
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },
    remove(item) {
      this.dialog = true;
    },
    async searchForm() {
      try {
        this.loading = true;
        const params = this.buildPayloadPagination(
          this.pagination,
          this.searchParams
        );
        await this.getListPaging(params);
        this.loading = false;
      } catch (error) {
        console.log(error);
        this.loading = false;
      }
    },
  },
};
</script>
