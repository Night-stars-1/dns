<template>
  <router-view />
  <v-snackbar id="message" v-model="snackbar.value" location="right top" :color="snackbar.color"
    @click="snackbar.value = false">
    <span v-html="snackbar.text"></span>
  </v-snackbar>
</template>

<script lang="ts">
import { ref } from "vue";
export default {
  setup() {
    const visible = ref(false)
    return { visible };
  },
  computed: {
    snackbar() {
      return this.$store.state.snackbar.snackbar;
    }
  }
};
</script>

<style>
#app {
  height: 100%;
  background-image: ''; /* url('https://t.mwm.moe/ycy') */
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center;
}

::-webkit-scrollbar {
  width: 0;
  /* 适用于Chrome、Safari和新版Edge浏览器 */
}

#message {
  cursor: pointer;
}
</style>