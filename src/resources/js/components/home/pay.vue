<template>
    <v-sheet class="main py-md-6 pl-md-12">
        <v-col sm="8" md="6" lg="5" xl="4">
            <v-card>
                <v-toolbar dark color="primary">
                    <v-toolbar-title>积分充值</v-toolbar-title>
                </v-toolbar>
                <v-card-item>
                    <v-col>
                        <v-alert type="warning">当前UID: {{ user.uid }}，请检查UID是否正确</v-alert>
                    </v-col>
                    <v-radio-group v-model="payType" label="支付方式:" inline>
                        <v-radio v-for="payItem in payData" :label="payItem.name" :value="payItem.key"></v-radio>
                    </v-radio-group>
                    <v-item-group mandatory v-model="payItem" @click="pay">
                        <v-container>
                            <v-row>
                                <v-col v-for="payItem in payList" :key="payItem" cols="12" md="4">
                                    <v-item v-slot="{ isSelected, toggle }">
                                        <v-card :color="isSelected ? 'primary' : ''" class="d-flex align-center" dark
                                            height="200" @click="toggle">
                                            <v-scroll-y-transition>
                                                <div class="text-h3 flex-grow-1 text-center">
                                                    {{ payItem }}积分
                                                </div>
                                            </v-scroll-y-transition>
                                        </v-card>
                                    </v-item>
                                </v-col>
                            </v-row>
                        </v-container>
                    </v-item-group>
                </v-card-item>
            </v-card>
        </v-col>

    </v-sheet>
</template>

<script lang="ts">

export default {
    data: () => ({
        payItem: -1,
        payList: [100, 500, 1000],
        payType: "alipay",
        payData: [
            {
                name: "支付宝",
                key: "alipay"
            },
            {
                name: "微信支付",
                key: "wxpay"
            },
        ]
    }),
    methods: {
        showMessage(text: string, color: string = 'success') {
            this.$store.dispatch('snackbar/showSnackbar', {
                text,
                color
            });
        },
        async pay() {
            const date = new Date();
            const timestamp = date.getTime();
            let params: payParams = {
                pid: '', // 商户ID
                type: this.payType, // 支付方式 	alipay:支付宝,tenpay:财付通,qqpay:QQ钱包,wxpay:微信支付
                out_trade_no: timestamp, // 商户订单号
                notify_url: `${location.origin}/payNotify/${this.user.uid}`, // 异步通知地址
                return_url: `${location.origin}/payReturn/${this.user.uid}`, // 跳转通知地址
                name: `${this.payList[this.payItem]}积分`, // 商品名称
                money: '', // 商品金额
                sitename: window.webName, // 网站名称
                sign: '',
                sign_type: 'MD5',
                point: this.payList[this.payItem]
            }
            const signResponse = await this.$axios.get('/getPaySign', {
                params: params
            });
            const data = signResponse.data;
            const paramString = data.paramString;
            window.open(`https://pay.ococn.cn/submit.php?${paramString}`, '_blank');
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