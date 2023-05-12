<template>
  <v-app class="auth-layout">
    <!-- Sizes your content based upon application components -->
    <v-main>
      <!-- Provides the application the proper gutter -->
      <v-container fluid class="content">
        <Nuxt />
      </v-container>
    </v-main>
    <v-footer app class="footer d-flex justify-center">
      <h4>Coppy right by Anhv @{{ $moment().format("YYYY") }}</h4>
    </v-footer>
  </v-app>
</template>
<script>
export default {
  data() {
    return {};
  },
};
</script>
