<template>
    <v-sheet class="main py-md-6 pl-md-12">
        <v-col cols="4">
            <v-card min-width="450px">
                <v-toolbar dark color="primary">
                    <v-toolbar-title>公益防红</v-toolbar-title>
                </v-toolbar>
                <v-card-item>
                    <v-col>
                        <v-alert type="info">在线生成防红短链接，支持跳转浏览器<br>说明：接口来源于网络，如有任何问题与我们无关。<br>注：生成的链接只会显示一次，请保存好</v-alert>
                    </v-col>
                    <v-radio-group v-model="redType" inline>
                        <template v-slot:label>
                            <div>短链类型</div>
                        </template>
                        <v-radio label="4xl.cn-QQ微信可用" value="1"></v-radio>
                        <v-radio label="i7q.cn-QQ微信可用" value="2"></v-radio>
                        <v-radio label="sinaurl.cn-QQ/微信" value="3"></v-radio>
                        <v-radio label="0o3.cn-QQ/微信" value="4"></v-radio>
                        <v-radio label="t0k.cn-QQ/微信" value="5"></v-radio>
                    </v-radio-group>
                    <v-radio-group class="left-right-align" v-model="redPattern" inline>
                        <template v-slot:label>
                            <div>跳转类型</div>
                        </template>
                        <v-radio label="微信/QQ内跳浏览器" value="1"></v-radio>
                        <v-radio label="微信/QQ不跳浏览器" value="2"></v-radio>
                        <v-radio label="无需防红 - 直接缩短" value="3"></v-radio>
                    </v-radio-group>
                    <v-col>
                        <v-text-field v-model="redUrl" label="缩短网址" placeholder="输入网址" type="text"></v-text-field>
                    </v-col>
                </v-card-item>
                <v-card-actions class="mb-3 mr-3">
                    <v-spacer></v-spacer>
                    <v-tooltip text="点击复制" location="start" v-if="dwz_url">
                        <template v-slot:activator="{ props }">
                            <v-btn class="ml-5" variant="tonal" v-bind="props" @click="copy(dwz_url)" style="text-transform: none;">
                                {{ dwz_url }}
                            </v-btn>
                        </template>
                    </v-tooltip>
                    <v-btn class="mr-2" variant="flat" color="indigo-darken-3" @click="red" :loading="reding">
                        一键生成
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-col>

    </v-sheet>
</template>

<script lang="ts">
import useClipboard from 'vue-clipboard3';
const { toClipboard } = useClipboard();

export default {
    data: () => ({
        redType: '1',
        redPattern: '1',
        redUrl: '',
        reding: false,
        dwz_url: ''
    }),
    methods: {
        showMessage(text: string, color: string = 'success') {
            this.$store.dispatch('snackbar/showSnackbar', {
                text,
                color
            });
        },
        async red() {
            this.reding = true;
            const response = await this.$axios.get('https://www.lzfh.com/api/dwz.php', {
                params: {
                    cb: this.redType,
                    sturl: this.redPattern,
                    longurl: this.redUrl
                }
            })
            const data = response.data;
            if (response.status == 200) {
                this.dwz_url = data.dwz_url;
                this.showMessage("生成成功", 'success');
            } else {
                this.showMessage(data.message, 'error');
            }
            this.reding = false;
        },
        async copy(text: string) {
            try {
                await toClipboard(text)
                this.showMessage("复制成功");
            } catch (e) {
                this.showMessage(`复制失败${e}`, 'error');
            }
        }
    },
}
</script>

<style>
.my-radio-group {
    display: flex;
    justify-content: space-between;
    /* 使子项左右对齐 */
}
</style>