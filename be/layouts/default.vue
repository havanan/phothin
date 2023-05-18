<template>
  <v-app dark class="dashboard">
    <v-navigation-drawer
      v-model="drawer"
      :mini-variant="miniVariant"
      :clipped="clipped"
      fixed
      app
      class="left-navigation"
    >
      <v-list class="navigation-list">
        <div class="nav-logo d-flex justify-center">
          <nuxt-link to="/"
            ><img src="~/assets/image/logo.png" class="mb-5 nav-logo"
          /></nuxt-link>
        </div>
        <!-- menu list -->
        <div v-for="item in items" :key="item.title">
          <template v-if="item.childs">
            <Group :item="item"></Group>
          </template>
          <template v-else>
            <Single :item="item"></Single>
          </template>
        </div>
        <!-- menu list -->
      </v-list>
    </v-navigation-drawer>
    <v-app-bar class="header-top" :clipped-left="clipped" fixed app>
      <v-app-bar-nav-icon @click.stop="drawer = !drawer" />
      <v-toolbar-title>{{ title }}</v-toolbar-title>
      <v-spacer />
      <!-- <v-btn icon @click.stop="rightDrawer = !rightDrawer">
        <v-icon>mdi-menu</v-icon>
      </v-btn> -->
      <v-menu bottom transition="slide-y-transition" offset-y>
        <template v-slot:activator="{ on, attrs }">
          <v-btn text v-bind="attrs" v-on="on">
            <v-icon>mdi-account</v-icon> {{ $auth.user.name }}
            <v-icon small>mdi-chevron-down</v-icon>
          </v-btn>
        </template>

        <v-list>
          <v-list-item to="/user/profile" exact>
            <v-list-item-icon><v-icon>mdi-account</v-icon></v-list-item-icon>
            <v-list-item-content>
              <v-list-item-title>Trang cá nhân</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          <v-list-item exact>
            <v-list-item-icon
              ><v-icon>mdi-exit-to-app</v-icon></v-list-item-icon
            >
            <v-list-item-content>
              <v-list-item-title @click="handleLogout()"
                >Đăng xuất</v-list-item-title
              >
            </v-list-item-content>
          </v-list-item>
        </v-list>
      </v-menu>
    </v-app-bar>
    <v-main class="main-content">
      <v-container fluid>
        <Nuxt />
        <dialog-component>hihih đồ ngok</dialog-component>
      </v-container>
    </v-main>
    <v-navigation-drawer v-model="rightDrawer" :right="right" temporary fixed>
      <v-list>
        <v-list-item @click.native="right = !right">
          <v-list-item-action>
            <v-icon light> mdi-repeat </v-icon>
          </v-list-item-action>
          <v-list-item-title>Switch drawer (click me)</v-list-item-title>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>
    <v-footer :absolute="!fixed" app>
      <div class="dashboard-footer">
        <span
          >Made With <strong class="base-color">Anhv</strong> &copy;
          {{ $moment().format("YYYY") }}</span
        >
      </div>
    </v-footer>
  </v-app>
</template>

<script>
import DialogComponent from "../components/DialogComponent.vue";
import Group from "./common/navigation/Group.vue";
import Single from "./common/navigation/Single.vue";
export default {
  name: "DefaultLayout",
  middleware: ["auth", "checkRole"],
  components: { Group, Single, DialogComponent },
  data() {
    return {
      clipped: false,
      drawer: true,
      fixed: false,
      items: [
        {
          icon: "mdi-apps",
          title: "Dashboard",
          url: "/",
        },

        {
          icon: "mdi-package-variant",
          title: "Sản phẩm",

          childs: [
            { title: "Danh sách", url: "/product/list" },
            { title: "Phân loại", url: "/product/category" },
            { title: "Thêm mới", url: "/product/create" },
            { title: "Trạng thái", url: "/product/status" },
          ],
        },

        {
          icon: "mdi-note-multiple-outline",
          title: "Đơn hàng",
          childs: [
            { title: "Danh sách", url: "/bill/list" },
            { title: "Phân loại", url: "/bill/category" },
            { title: "Trạng thái", url: "/bill/status" },
          ],
        },
        {
          icon: "mdi-calendar-plus",
          title: "Đặt lịch",
          url: "/booking",
          // childs: [
          //   { title: "Danh sách", url: "/booking/list" },
          //   // { title: "Thêm mới", url: "/bill/create" },
          // ],
        },
        {
          icon: "mdi-chart-line",
          title: "Thống kê",
          childs: [
            { title: "Doanh thu", url: "/report/revenue" },
            { title: "Tăng trưởng", url: "/report/growth" },
          ],
        },
        {
          icon: "mdi-newspaper",
          title: "Tin tức",

          childs: [
            { title: "Danh sách", url: "/news/list" },
            { title: "Thêm mới", url: "/news/create" },
            { title: "Phân loại", url: "/news/category" },
          ],
        },
        {
          icon: "mdi-barcode-scan",
          title: "Voucher",
          childs: [
            { title: "Danh sách", url: "/voucher/list" },
            { title: "Thêm mới", url: "/voucher/create" },
          ],
        },
        {
          icon: "mdi-tooltip-text",
          title: "Bình luận",
          childs: [
            { title: "Chờ duyệt", url: "/comment/waiting" },
            { title: "Sản phẩm", url: "/comment/product" },
            { title: "Tin tức", url: "/comment/news" },
          ],
        },
        {
          icon: "mdi-account",
          title: "Khách hàng",
          childs: [
            { title: "Danh sách", url: "/user/list" },
            { title: "Thêm mới", url: "/user/create" },
            { title: "Phân loại", url: "/user/category" },
          ],
        },
        {
          icon: "mdi-nature-people",
          title: "Đại lý",
          childs: [
            { title: "Danh sách", url: "/agency/list" },
            { title: "Thêm mới", url: "/agency/create" },
            { title: "Phân loại", url: "/agency/category" },
          ],
        },
        {
          icon: "mdi-account-network",
          title: "Tk hệ thống",
          childs: [
            { title: "Danh sách", url: "/admin/list" },
            { title: "Thêm mới", url: "/admin/create" },
            { title: "Phân loại", url: "/admin/category" },
          ],
        },
        {
          icon: "mdi-wrench",
          title: "Cài đặt",
          url: "/inspire",
          childs: [
            { title: "Hệ thống", url: "/setting/list" },
            { title: "Nhóm quyền", url: "/setting/role" },
            { title: "Quyền", url: "/setting/permissions " },
            { title: "Cấu hình SMS", url: "/setting/sms" },
            { title: "Gửi Mail", url: "/setting/mail" },
          ],
        },
        {
          icon: "mdi-shield-half-full",
          title: "Phân quyền",
          url: "/role",
          childs: [
            { title: "Nhóm quyền", url: "/role/list" },
            { title: "Quyền", url: "/role/permissions " },
          ],
        },
      ],
      miniVariant: false,
      right: true,
      rightDrawer: false,
      title: `Quản trị ${process.env.siteName}`,
    };
  },
  methods: {
    async handleLogout() {
      try {
        await this.$auth.logout();
        this.$toast.success("Bạn đăng xuất khỏi hệ thống").goAway(1000);
        this.$router.push("login");
      } catch (error) {
        this.$toast.error("Lỗi đăng xuất").goAway(1300);
      }
    },
  },
};
</script>
