<template>
  <v-list-group :v-model="item.active" :prepend-icon="item.icon" no-action>
    <template #activator>
      <v-list-item-content>
        <v-tooltip bottom>
          <template #activator="{ on, attrs }">
            <v-list-item-title v-bind="attrs" v-on="on" v-text="item.title" />
          </template>
          <span>{{ item.title }}</span>
        </v-tooltip>
      </v-list-item-content>
    </template>

    <v-list-item
      v-for="child in item.childs"
      :key="child.title"
      :to="child.url"
    >
      <v-list-item-content>
        <v-tooltip bottom>
          <template #activator="{ on, attrs }">
            <v-list-item-title v-bind="attrs" v-on="on" v-text="child.title" />
          </template>
          <span>{{ child.title }}</span>
        </v-tooltip>
      </v-list-item-content>
    </v-list-item>
  </v-list-group>
</template>
<script>
export default {
  name: 'Group',
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
