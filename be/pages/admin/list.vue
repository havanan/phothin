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
            label="Outlined style"
            dense
            outlined
            hide-details
            class="mr-4"
          ></v-select>
          <v-text-field
            placeholder="Tìm kiếm"
            class="mr-4"
            hide-details
            clearable
            outlined
            dense
          ></v-text-field>
          <create-buttons @create-method="create"></create-buttons>
        </div>
      </v-card-text>
    </v-card>
    <v-card class="mt-5">
      <v-data-table
        v-model="selected"
        :headers="headers"
        :items="desserts"
        item-key="name"
        show-select
        class="custom-table"
      >
        <template v-slot:item.id="{ item }">
          <strong class="base-color"> #{{ item.id }}</strong>
        </template>
        <template v-slot:item.action="{ item }">
          <table-default-buttons
            :item="{ item }"
            @show-method="show"
            @edit-method="edit"
            @remove-method="remove"
          ></table-default-buttons>
        </template>
      </v-data-table>
    </v-card>
    <v-navigation-drawer v-model="rightDrawer" :right="right" temporary fixed>
      <v-container class="mt-10">
        <v-form class="d-flex flex-column align-center">
          <v-text-field
            class="w-full"
            outlined
            label="Tên hiển thị"
          ></v-text-field>
          <v-text-field
            class="w-full"
            outlined
            label="Số điện thoại"
          ></v-text-field>
          <v-text-field
            class="w-full"
            outlined
            label="Trạng thái"
          ></v-text-field>
          <v-text-field class="w-full" outlined label="Ngày tạo"></v-text-field>
          <div class="d-flex flex-column align-center w-full">
            <v-btn class="success mb-3 w-full">Lưu</v-btn>
            <v-btn class="w-full" outlined type="reset">Nhập lại</v-btn>
          </div>
        </v-form>
      </v-container>
    </v-navigation-drawer>
  </v-container>
</template>
<script>
import TableDefaultButtons from "~/components/TableDefaulButtons.vue";
import CreateButtons from "~/components/CreateButtons.vue";
import { mapState, mapActions } from "vuex";

export default {
  components: { TableDefaultButtons, CreateButtons },
  name: "AdminList",
  head() {
    return {
      title: "Danh sách tài khoản hệ thống",
    };
  },
  data() {
    return {
      rightDrawer: false,
      right: true,
      btnOptions: {},
      items: ["Foo", "Bar", "Fizz", "Buzz"],
      selected: [],
      headers: [
        { text: "#ID", value: "id" },
        {
          text: "Dessert (100g serving)",
          align: "start",
          sortable: false,
          value: "name",
        },
        { text: "Calories", value: "calories" },
        { text: "Fat (g)", value: "fat" },
        { text: "Carbs (g)", value: "carbs" },
        { text: "Protein (g)", value: "protein" },
        { text: "Iron (%)", value: "iron" },
        { text: "", value: "action" },
      ],
      desserts: [
        {
          id: 13,
          name: "Frozen Yogurt",
          calories: 159,
          fat: 6.0,
          carbs: 24,
          protein: 4.0,
          iron: 1,
        },
        {
          id: 32,
          name: "Ice cream sandwich",
          calories: 237,
          fat: 9.0,
          carbs: 37,
          protein: 4.3,
          iron: 1,
        },
        {
          id: 3,
          name: "Eclair",
          calories: 262,
          fat: 16.0,
          carbs: 23,
          protein: 6.0,
          iron: 7,
        },
      ],
    };
  },
  computed: {
    ...mapState("modules/dialog", ["showDialog"]),
  },
  watch: {
    rightDrawer(newVal) {
      this.toggleShowDialog(newVal);
    },
  },
  methods: {
    ...mapActions("modules/dialog", ["toggleShowDialog"]),
    create(params) {
      this.rightDrawer = true;
    },
    show(item) {
      this.rightDrawer = true;
    },
    edit(item) {
      this.rightDrawer = true;
    },
    remove(item) {
      this.rightDrawer = true;
    },
  },
};
</script>
