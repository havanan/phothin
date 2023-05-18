<template>
  <div>
    <v-btn v-if="options.isShowView" @click="show(item)" icon class="mr-2"
      ><v-icon>mdi-eye-outline</v-icon></v-btn
    >
    <v-btn
      v-if="options.isShowEdit"
      color="primary"
      @click="edit(item)"
      icon
      class="mr-2"
      ><v-icon>mdi-pencil-outline</v-icon></v-btn
    >
    <v-btn v-if="options.isShowDelete" color="error" @click="remove(item)" icon
      ><v-icon>mdi-delete-outline</v-icon></v-btn
    >
  </div>
</template>
<script>
export default {
  name: "TableDefaulButton",
  props: {
    item: {
      type: Object,
      default() {
        return {};
      },
    },
    options: {
      type: Object,
      default() {
        return {
          isShowView: true,
          isShowEdit: true,
          isShowDelete: true,
        };
      },
    },
  },
  methods: {
    show(item) {
      this.$emit("show-method", item);
    },
    edit(item) {
      this.$emit("edit-method", item);
    },
    remove(item) {
      this.$emit("remove-method", item);
    },
  },
};
</script>
