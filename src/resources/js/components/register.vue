<template>
  <div class="d-flex align-center" style="width: 100%; height: 100%;">
    <v-card class="mx-auto pa-12 pb-8" elevation="8" max-width="448" rounded="lg">

      <div class="text-subtitle-1 text-medium-emphasis">账号</div>
      <v-text-field density="compact" placeholder="用户名" prepend-inner-icon="mdi-email-outline" v-model="username"
        variant="outlined"></v-text-field>

      <div class="text-subtitle-1 text-medium-emphasis d-flex align-center justify-space-between"
        style="min-width: 350px;">
        密码
      </div>
      <v-text-field :append-inner-icon="visible ? 'mdi-eye-off' : 'mdi-eye'" :type="visible ? 'text' : 'password'"
        density="compact" placeholder="输入你的密码" prepend-inner-icon="mdi-lock-outline" variant="outlined" v-model="password"
        @click:append-inner="visible = !visible"></v-text-field>

      <div class="text-subtitle-1 text-medium-emphasis">邮箱</div>
      <v-text-field density="compact" placeholder="Email" prepend-inner-icon="mdi-email-outline" v-model="email"
        variant="outlined"></v-text-field>

      <v-container>
        <v-row style="margin: -16px;">
          <v-text-field cols="8" density="compact" placeholder="验证码" prepend-inner-icon="mdi-lock-outline" v-model="code"
            variant="outlined"></v-text-field>
          <v-img cols="4" class="mb-7" :src="imageUrl" @click="refreshCaptcha">
            <template v-slot:placeholder>
              <div class="d-flex align-center justify-center fill-height">
                <v-progress-circular color="grey-lighten-4" indeterminate></v-progress-circular>
              </div>
            </template>
          </v-img>
        </v-row>
      </v-container>
      <v-card class="mb-12" color="surface-variant" variant="tonal">
        <v-card-text class="text-medium-emphasis text-caption text-center">
          注册提示
        </v-card-text>
      </v-card>

      <v-btn :loading="loading" block class="mb-8" color="blue" size="large" variant="tonal" @click="register">
        注册
      </v-btn>

      <v-card-text class="text-center">
        <router-link class="text-blue text-decoration-none" to="/login" rel="noopener noreferrer">
          登录 <v-icon icon="mdi-chevron-right"></v-icon>
        </router-link>
      </v-card-text>
    </v-card>
    <v-snackbar v-model="snackbarDate.value" location="right top" :color="snackbarDate.color">
      <span v-html="snackbarDate.text"></span>
    </v-snackbar>
  </div>
</template>

<script lang="ts">
export default {
  data: () => ({
    visible: false,
    loading: false,
    username: '',
    password: '',
    email: '',
    imageUrl: '/captcha',
    code: '',
    snackbarDate: {
      value: false,
      text: '',
      color: '',
    },
  }),
  methods: {
    refreshCaptcha() {
      this.imageUrl = '/captcha?' + Math.random();
    },
    showMessage(text: string, color: string = 'success') {
      this.$store.dispatch('snackbar/showSnackbar', {
        text,
        color
      });
    },
    register: async function () {
      try {
        this.loading = true;
        const response = await this.$axios.post('/reg', {
          username: this.username,
          password: this.password,
          email: this.email,
          code: this.code
        });
        const data = response.data;
        if (data.status !== 0) {
          this.showMessage(response.data.message, 'error');
          this.refreshCaptcha();
        } else {
          this.showMessage(data.message, 'success');
          this.$router.push('/login')
        }
      } catch (error: any) {
        this.showMessage(error.toString(), 'error');
        this.refreshCaptcha();
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