<template>
  <div class="d-flex align-center" style="width: 100%; height: 100%;">
    <v-card class="mx-auto pa-12 pb-8" elevation="8" max-width="448" rounded="lg">
      <div class="text-subtitle-1 text-medium-emphasis">账号</div>

      <v-text-field density="compact" placeholder="Email或Uid" prepend-inner-icon="mdi-email-outline" v-model="username"
        variant="outlined"></v-text-field>

      <div class="text-subtitle-1 text-medium-emphasis d-flex align-center justify-space-between"
        style="min-width: 350px;">
        密码
      </div>
      <v-text-field :append-inner-icon="visible ? 'mdi-eye-off' : 'mdi-eye'" :type="visible ? 'text' : 'password'"
        density="compact" placeholder="输入你的密码" prepend-inner-icon="mdi-lock-outline" variant="outlined" v-model="password"
        @click:append-inner="visible = !visible"></v-text-field>

      <v-card class="mb-12" color="surface-variant" variant="tonal">
        <v-card-text class="text-medium-emphasis text-caption text-center">
          登录提示
        </v-card-text>
      </v-card>

      <v-btn :loading="loading" block class="mb-8" color="blue" size="large" variant="tonal" @click="login">
        登录
      </v-btn>

      <v-card-text class="text-center">
        <router-link class="text-blue text-decoration-none" to="/register" rel="noopener noreferrer">
          注册 <v-icon icon="mdi-chevron-right"></v-icon>
        </router-link>
      </v-card-text>
    </v-card>
  </div>
</template>

<script lang="ts">
export default {
  data: () => ({
    visible: false,
    loading: false,
    username: '',
    password: ''
  }),
  methods: {
    showMessage(text: string, color: string = 'success') {
      this.$store.dispatch('snackbar/showSnackbar', {
        text,
        color
      });
    },
    login: async function () {
      try {
        this.loading = true;
        const response = await this.$axios.post('/login', {
          username: this.username,
          password: this.password
        });
        const data = response.data;
        const go = data.go;
        if (data.status !== 0) {
          this.showMessage(response.data.message, 'error');
          return;
        } else if (go) {
          this.showMessage(data.message, 'success');
          this.user.status = 0;
          this.$router.push(go);
        }
      } catch (error: any) {
        this.showMessage(error.toString(), 'error');
      } finally {
        this.loading = false;
      }
    },
  }
};
</script>

<style>
#app {
  height: 100%;
  background-image: url('https://t.mwm.moe/ycy');
  background-size: cover;
  background-repeat: no-repeat;
}

::-webkit-scrollbar {
  width: 0;
  /* 适用于Chrome、Safari和新版Edge浏览器 */
}
</style>