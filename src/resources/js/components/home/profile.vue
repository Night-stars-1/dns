<template>
    <v-sheet class="main py-md-6 pl-md-12">
        <v-col cols="4">
            <v-card min-width="450px">
                <v-toolbar dark color="primary">
                    <v-toolbar-title>个人资料</v-toolbar-title>
                </v-toolbar>
                <v-card-item>
                    <v-row class="mb-4" align="center" no-gutters>
                        用户名
                        <v-spacer></v-spacer>
                        <v-col cols="10">
                            <v-alert :text="user.username" />
                        </v-col>
                    </v-row>
                    <v-row class="mb-4" align="center" no-gutters>
                        用户组
                        <v-spacer></v-spacer>
                        <v-col cols="10">
                            <v-alert :text="user.group.name" />
                        </v-col>
                    </v-row>
                    <v-row class="mb-4" align="center" no-gutters>
                        积分
                        <v-spacer></v-spacer>
                        <v-col cols="10">
                            <v-alert :text="user.point.toString()" />
                        </v-col>
                    </v-row>
                    <v-row class="mb-4" align="center" no-gutters>
                        状态
                        <v-spacer></v-spacer>
                        <v-col cols="10">
                            <v-row v-if="user.status == 1" align="center" no-gutters>
                                <v-alert>未认证</v-alert>
                                <v-btn class="ml-2" rows="2" :loading="emailLoading" variant="flat"
                                    color="indigo-darken-3" @click="verify">
                                    认证
                                </v-btn>
                            </v-row>
                            <v-alert v-else :text="user.status == 2 ? '已认证' : '异常'" />
                        </v-col>
                    </v-row>
                    <v-row class="mb-4" align="center" no-gutters>
                        邮箱
                        <v-spacer></v-spacer>
                        <v-col cols="10">
                            <v-alert :text="user.email" />
                        </v-col>
                    </v-row>
                    <v-row align="center" no-gutters>
                        <span class="mb-6">旧密码</span>
                        <v-spacer></v-spacer>
                        <v-col cols="10">
                            <v-text-field v-model="oldPassword" label="旧密码"
                                :append-inner-icon="oldPasswordVisible ? 'mdi-eye-off' : 'mdi-eye'"
                                :type="oldPasswordVisible ? 'text' : 'password'"
                                @click:append-inner="oldPasswordVisible = !oldPasswordVisible"></v-text-field>
                        </v-col>
                    </v-row>
                    <v-row align="center" no-gutters>
                        <span class="mb-6">新密码</span>
                        <v-spacer></v-spacer>
                        <v-col cols="10">
                            <v-text-field v-model="newPassword" label="新密码"
                                :append-inner-icon="newPasswordVisible ? 'mdi-eye-off' : 'mdi-eye'"
                                :type="newPasswordVisible ? 'text' : 'password'"
                                @click:append-inner="newPasswordVisible = !newPasswordVisible"></v-text-field>
                        </v-col>
                    </v-row>
                </v-card-item>
                <v-card-actions class="mb-3 mr-3">
                    <v-spacer></v-spacer>
                    <v-btn :loading="loading" :disabled="oldPassword === '' || newPassword === ''" variant="flat"
                        color="indigo-darken-3" @click="modifyPassword">
                        修改密码
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-col>

    </v-sheet>
</template>

<script lang="ts">
export default {
    data: () => ({
        oldPassword: '',
        oldPasswordVisible: false,
        newPassword: '',
        newPasswordVisible: false,
        loading: false,
        emailLoading: false,
    }),
    methods: {
        showMessage(text: string, color: string = 'success') {
            this.$store.dispatch('snackbar/showSnackbar', {
                text,
                color
            });
        },
        async modifyPassword() {
            this.loading = true;
            this.$axios.post('/home', {
                action: "profile",
                old_password: this.oldPassword,
                new_password: this.newPassword,
            }).then((response) => {
                this.oldPassword = '';
                this.newPassword = '';
                this.loading = false;
                const data = response.data;
                const message = data.message;
                this.showMessage(message);
                if (data.status === 0) {
                    this.user.status = -1002;
                    this.$router.push('/login');
                }
            });
        },
        async verify() {
            this.emailLoading = true;
            this.$axios.post('/home', {
                action: "verify",
            }).then((response) => {
                this.emailLoading = false;
                const data = response.data;
                const message = data.message;
                this.showMessage(message);
                if (data.status === 0) {
                    this.user.status = 1;
                }
            });
        }
    },
}
</script>

<style>
.main {
    height: 100%;
}
</style>