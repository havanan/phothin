<template>
  <v-row>
    <v-col md="4">
      <v-card> left </v-card>
    </v-col>
    <v-col md="8">
      <v-card> right </v-card>
    </v-col>
  </v-row>
</template>
<script>
export default {
  name: "UserProfile",
  head() {
    return {
      title: "Thông tin tài khoản",
    };
  },
};
</script>
