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
      <v-list>
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
        <span>Coppy right by Anhv &copy; {{ $moment().format("YYYY") }}</span>
      </div>
    </v-footer>
  </v-app>
</template>

<script>
import Group from "./common/navigation/Group.vue";
import Single from "./common/navigation/Single.vue";
export default {
  name: "DefaultLayout",
  middleware: "auth",
  components: { Group, Single },
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
            { title: "Danh sách", url: "/product" },
            { title: "Phân loại", url: "/product/category" },
            { title: "Thêm mới", url: "/product/create" },
            { title: "Trạng thái", url: "/bill/status" },
          ],
        },

        {
          icon: "mdi-note-multiple-outline",
          title: "Đơn hàng",
          childs: [
            { title: "Danh sách", url: "/bill" },
            { title: "Phân loại", url: "/bill/category" },
            { title: "Trạng thái", url: "/bill/status" },
          ],
        },
        {
          icon: "mdi-calendar-plus",
          title: "Đặt lịch",
          childs: [
            { title: "Danh sách", url: "/booking" },
            // { title: "Thêm mới", url: "/bill/create" },
          ],
        },
        {
          icon: "mdi-chart-line",
          title: "Thống kê",
          childs: [
            { title: "Doanh thu", url: "/report" },
            { title: "Tăng trưởng", url: "/report/growth" },
          ],
        },
        {
          icon: "mdi-newspaper",
          title: "Tin tức",

          childs: [
            { title: "Danh sách", url: "/news" },
            { title: "Thêm mới", url: "/news/create" },
            { title: "Phân loại", url: "/news/category" },
          ],
        },
        {
          icon: "mdi-developer-board",
          title: "Voucher",
          childs: [
            { title: "Danh sách", url: "/voucher" },
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
            { title: "Danh sách", url: "/user" },
            { title: "Thêm mới", url: "/user/create" },
          ],
        },
        {
          icon: "mdi-nature-people",
          title: "Đại lý",

          childs: [
            { title: "Danh sách", url: "/user" },
            { title: "Thêm mới", url: "/user/create" },
          ],
        },
        {
          icon: "mdi-account-network",
          title: "Tk hệ thống",
          childs: [
            { title: "Danh sách", url: "/admin" },
            { title: "Thêm mới", url: "/admin/create" },
          ],
        },
        {
          icon: "mdi-wrench",
          title: "Cài đặt",
          url: "/inspire",
          childs: [
            { title: "Hệ thống", url: "/setting" },
            { title: "Cấu hình SMS", url: "/setting/sms" },
            { title: "Gửi Mail", url: "/setting/mail" },
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
