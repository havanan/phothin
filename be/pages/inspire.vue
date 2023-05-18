<template>
  <v-row>
    <v-col class="text-center">
      <img src="/v.png" alt="Vuetify.js" class="mb-5" />
      <blockquote class="blockquote">
        &#8220;First, solve the problem. Then, write the code.&#8221;
        <footer>
          <small @click="getAuthInfo()">
            <em>&mdash;John Johnson</em>
          </small>
        </footer>
      </blockquote>
    </v-col>
  </v-row>
</template>

<script>
import { mapState, mapActions } from "vuex";

export default {
  name: "InspirePage",
  computed: {
    ...mapState("modules/auth", ["authInfo"]),
  },
  methods: {
    ...mapActions("modules/auth", ["fetchAuthInfo"]),
    async getAuthInfo() {
      await this.fetchAuthInfo({ name: "kẹc" });
    },
  },
};
</script>
