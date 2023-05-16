<template>
  <v-list-item :to="item.url" router exact>
    <v-list-item-action>
      <v-icon>{{ item.icon }}</v-icon>
    </v-list-item-action>
    <v-list-item-content>
      <v-tooltip bottom>
        <template #activator="{ on, attrs }">
          <v-list-item-title v-bind="attrs" v-on="on" v-text="item.title" />
        </template>
        <span>{{ item.title }}</span>
      </v-tooltip>
    </v-list-item-content>
  </v-list-item>
</template>
<script>
export default {
  name: 'Single',
  props: {
    item: {
      type: Object,
      default() {
        return {}
      },
    },
  },
}
</script>
