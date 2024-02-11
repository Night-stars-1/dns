<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>会员登录 - {{ config('sys.web.name','二级域名分发') }}</title>
    <meta name="keywords" content="{{ config('sys.web.keywords') }}"/>
    <meta name="description" content="{{ config('sys.web.description') }}"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.1/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/vuetify@3.5.2/dist/vuetify.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/style.min.css" rel="stylesheet">
</head>
<body>

<main id="app">
    <div class="d-flex align-center" style="width: 100%; height: 100%;">
        <v-card
          class="mx-auto pa-12 pb-8"
          elevation="8"
          max-width="448"
          rounded="lg"
        >
          <div class="text-subtitle-1 text-medium-emphasis">账号</div>
    
          <v-text-field
            density="compact"
            placeholder="Email或Uid"
            prepend-inner-icon="mdi-email-outline"
            variant="outlined"
          ></v-text-field>
    
          <div class="text-subtitle-1 text-medium-emphasis d-flex align-center justify-space-between" style="min-width: 350px;">
            密码
          </div>
          <v-text-field
            :append-inner-icon="visible ? 'mdi-eye' : 'mdi-eye-off'"
            :type="visible ? 'password' : 'text'"
            density="compact"
            placeholder="输入你的密码"
            prepend-inner-icon="mdi-lock-outline"
            variant="outlined"
            @click:append-inner="visible = !visible"
          ></v-text-field>
    
          <v-card
            class="mb-12"
            color="surface-variant"
            variant="tonal"
          >
            <v-card-text class="text-medium-emphasis text-caption text-center">
              登录提示
            </v-card-text>
          </v-card>
    
          <v-btn
            block
            class="mb-8"
            color="blue"
            size="large"
            variant="tonal"
          >
            登录
          </v-btn>
    
          <v-card-text class="text-center">
            <a
              class="text-blue text-decoration-none"
              href="#"
              rel="noopener noreferrer"
              target="_blank"
            >
              注册 <v-icon icon="mdi-chevron-right"></v-icon>
            </a>
          </v-card-text>
        </v-card>
    </div>
</main>

<script>
if({{ config('sys.html_yh') }}==0){

}else{
function loadJs(path,callback){var header=document.getElementsByTagName("head")[0];var script=document.createElement('script');script.setAttribute('src',path);header.appendChild(script);if(!/*@cc_on!@*/false){script.onload=function(){callback();}}else{script.onreadystatechange=function(){if(script.readystate=="loaded" ||script.readState=='complate'){callback();}}}}
        loadJs("/js/yinghua.min.js",function(){yinghua(50,1.5)});
}
</script>

</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/3.4.15/vue.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vuetify@3.5.2/dist/vuetify.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/layer/2.3/layer.js"></script>
<script src="/js/main.js"></script>
<script>
    const { createApp, ref } = Vue
    const { createVuetify } = Vuetify

    const vuetify = createVuetify()
    const app = createApp({
        data() {
            return {
                act: 'login',
                visible: false,
                email: '',
                password: '',
                emailRules: [
                    v => !!v || '邮箱是必填项',
                    v => /.+@.+\..+/.test(v) || '邮箱格式不正确'
                ],
                passwordRules: [
                    v => !!v || '密码是必填项',
                    v => v.length >= 8 || '密码长度至少为 8 个字符'
                ]
            };
        },
        methods: {
            login() {
                if (this.$refs.form.validate()) {
                    // 执行登录逻辑
                    console.log('登录成功', this.email, this.password);
                }
            }
        }
    });
    app.use(vuetify)
    app.mount('#app')
</script>
<style>
    #app {
        width: 100%;
        height: 100%;
        background-image: url('https://t.mwm.moe/ycy');
        background-size: cover;
        background-repeat: no-repeat;
    }
    ::-webkit-scrollbar {
        width: 0;  /* 适用于Chrome、Safari和新版Edge浏览器 */
    }
    body {
        overflow: hidden;
    }
</style>
</html>