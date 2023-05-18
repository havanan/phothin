<template>
  <div>
    <v-btn :color="colorName" :class="className" @click="create()">
      Thêm <v-icon>mdi-plus</v-icon></v-btn
    >
  </div>
</template>
<script>
export default {
  name: "CreateButton",
  props: {
    colorName: {
      type: String,
      default() {
        return "current";
      },
    },
    className: {
      type: String,
      default() {
        return "text-white";
      },
    },
  },
  methods: {
    create() {
      this.$emit("create-method", true);
    },
  },
};
</script>
