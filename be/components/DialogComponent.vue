<template>
  <v-row justify="space-around">
    <v-col cols="auto">
      <v-dialog
        v-model="isShow"
        transition="dialog-bottom-transition"
        max-width="600"
      >
        <v-card>
          <v-toolbar color="primary" dark>Opening from the bottom</v-toolbar>
          <v-card-text>
            <div class="text-h2 pa-12">Hello world!</div>
          </v-card-text>
          <v-card-actions class="justify-end">
            <v-btn text @click="closeDialog()">Close</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-col>
  </v-row>
</template>
<script>
import { mapState, mapActions } from "vuex";

export default {
  name: "DialogComponent",
  computed: {
    ...mapState("modules/dialog", ["showDialog"]),
    isShow() {
      return this.showDialog;
    },
  },
  watch: {
    isShow(newVal) {},
  },
  methods: {
    ...mapActions("modules/dialog", ["toggleShowDialog"]),
    closeDialog() {
      this.toggleShowDialog(false);
    },
  },
};
</script>
