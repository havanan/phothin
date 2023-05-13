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
        <v-list-item
          v-for="(item, i) in items"
          :key="i"
          :to="item.to"
          router
          exact
        >
          <v-list-item-action>
            <v-icon>{{ item.icon }}</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>{{ item.title }}</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>
    <v-app-bar :clipped-left="clipped" fixed app>
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
          <v-list-item to="user/profile" exact>
            <v-list-item-content>
              <v-list-item-title>Trang cá nhân</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          <v-list-item exact>
            <v-list-item-content>
              <v-list-item-title @click="handleLogout()"
                >Đăng xuất</v-list-item-title
              >
            </v-list-item-content>
          </v-list-item>
        </v-list>
      </v-menu>
    </v-app-bar>
    <v-main>
      <v-container>
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
export default {
  name: "DefaultLayout",
  middleware: "auth",
  head() {
    return {
      title: "Dashboard",
    };
  },
  data() {
    return {
      clipped: false,
      drawer: true,
      fixed: false,
      items: [
        {
          icon: "mdi-apps",
          title: "Welcome",
          to: "/",
        },
        {
          icon: "mdi-chart-bubble",
          title: "Inspire",
          to: "/inspire",
        },
      ],
      miniVariant: false,
      right: true,
      rightDrawer: false,
      title: "Quản trị Phở Thìn",
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
