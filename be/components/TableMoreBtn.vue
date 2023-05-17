<template>
  <v-menu bottom transition="slide-y-transition" offset-x>
    <template v-slot:activator="{ on, attrs }">
      <v-btn icon v-bind="attrs" v-on="on">
        <v-icon>mdi-dots-vertical</v-icon>
      </v-btn>
    </template>

    <v-list>
      <v-list-item to="/user/profile" exact>
        <v-list-item-icon><v-icon>mdi-account</v-icon></v-list-item-icon>
        <v-list-item-content>
          <v-list-item-title>Xem </v-list-item-title>
        </v-list-item-content>
      </v-list-item>
      <v-list-item exact>
        <v-list-item-icon><v-icon>mdi-exit-to-app</v-icon></v-list-item-icon>
        <v-list-item-content>
          <v-list-item-title>Sửa</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
    </v-list>
  </v-menu>
</template>
<script>
export default {
  name: "TableMoreButton",
};
</script>
