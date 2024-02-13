<template>
    <v-layout class="rounded rounded-md">
        <v-app-bar :elevation="2">
            <template v-slot:prepend>
                <v-app-bar-nav-icon @click.stop="windowWidth > 1300 ? rail = !rail : drawer = !drawer"></v-app-bar-nav-icon>
            </template>

            <v-app-bar-title>
                <router-link class="router-link" to="/home">{{ webName }}</router-link>
            </v-app-bar-title>

            <v-menu open-on-hover open-on-click>
                <template v-slot:activator="{ props }">
                    <v-btn icon color="primary" v-bind="props">
                        <v-icon>mdi-account-circle-outline</v-icon>
                    </v-btn>
                </template>
                <v-list>
                    <v-list-item :title="user ? `用户名: ${user.username} UID: ${user.uid}` : ''" />
                    <v-list-item class="text-center" @click="sign" title="签到" />
                    <v-list-item class="text-center" to="/home/profile" title="个人信息" />
                    <v-list-item class="text-center" :href="htmlKefu" title="联系客服" />
                    <v-list-item class="text-center" href="/logout" title="退出登录" />
                </v-list>
            </v-menu>

        </v-app-bar>

        <v-navigation-drawer v-if="windowWidth > 1300" :rail="rail" expand-on-hover>
            <v-divider></v-divider>

            <v-list density="compact" nav>
                <v-list-item prepend-icon="mdi-broadcast" title="解析记录" value="解析记录" to="/home" exact></v-list-item>
                <v-list-item prepend-icon="mdi-web" title="免费防红" value="免费防红" to="/home/red" exact></v-list-item>
                <v-list-item prepend-icon="mdi-list-box-outline" title="积分明细" value="积分明细" to="/home/point" exact></v-list-item>
                <v-list-item prepend-icon="mdi-cash-sync" title="积分充值" value="积分充值" to="/home/pay" exact></v-list-item>
            </v-list>
        </v-navigation-drawer>

        <v-navigation-drawer v-else v-model="drawer" location="bottom" temporary>
            <v-divider></v-divider>

            <v-list density="compact" nav>
                <v-list-item prepend-icon="mdi-broadcast" title="解析记录" value="解析记录" to="/home" exact></v-list-item>
                <v-list-item prepend-icon="mdi-web" title="免费防红" value="免费防红" to="/home/red" exact></v-list-item>
                <v-list-item prepend-icon="mdi-list-box-outline" title="积分明细" value="积分明细" to="/home/point" exact></v-list-item>
                <v-list-item prepend-icon="mdi-cash-sync" title="积分充值" value="积分充值" to="/home/pay" exact></v-list-item>
            </v-list>
        </v-navigation-drawer>

        <v-main class="align-center justify-center">
            <router-view></router-view>
        </v-main>
        
    </v-layout>
</template>

<script lang="ts">
export default {
    data: () => ({
        rail: true,
        visible: false,
        drawer: false,
        webName: window.webName,
        windowWidth: window.innerWidth,
        htmlKefu: window.htmlKefu,
    }),
    mounted() {
        window.addEventListener('resize', this.onResize);
    },
    beforeDestroy() {
        window.removeEventListener('resize', this.onResize);
    },
    methods: {
        showMessage(text: string, color: string = 'success') {
            this.$store.dispatch('snackbar/showSnackbar', {
                text,
                color
            });
        },
        onResize() {
            this.windowWidth = window.innerWidth;
        },
        async sign() {
            this.showMessage(`签到中...`);
            const { data } = await this.$axios.post('/home', {
                action: "sign",
            });
            if (data.status==0) {
                this.showMessage(`签到成功，积分+${data.point}！`);
            } else {
                this.showMessage(data.message, 'error');
            }
        },
    },
};
</script>

<style>
#app {
    height: 100%;
    background-image: url('https://t.mwm.moe/ycy');
    background-size: cover;
    background-repeat: no-repeat;
}

.rounded {
    height: 100%;
}

.router-link {
  text-decoration: none; /* 去掉下划线 */
  color: inherit; /* 继承父元素的文本颜色 */
}

::-webkit-scrollbar {
    width: 0;
    /* 适用于Chrome、Safari和新版Edge浏览器 */
}
</style>