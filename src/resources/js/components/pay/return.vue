<template>
    <v-row class="d-flex align-center justify-center main">
        <v-col sm="8" md="6" lg="5" xl="4">
            <v-card>
                <template v-slot:loader="{ isActive }">
                    <v-progress-linear :active="isActive" color="deep-purple" height="4" indeterminate></v-progress-linear>
                </template>

                <v-card-item>
                    <v-card-title class="text-center">支付成功</v-card-title>
                    <v-spacer></v-spacer>
                    <v-card-text>
                            <v-col cols="12">
                                <v-text-field label="UID" v-model="$route.params.uid" readonly></v-text-field>
                            </v-col>
                            <v-col cols="12">
                                <v-text-field label="商品名称" v-model="name" readonly></v-text-field>
                            </v-col>
                            <v-col cols="12">
                                <v-text-field label="支付方式" v-model="type" readonly></v-text-field>
                            </v-col>
                            <v-col cols="12">
                                <v-text-field label="支付金额" v-model="money" readonly></v-text-field>
                            </v-col>
                            <v-col cols="12">
                                <v-text-field label="订单号" v-model="out_trade_no" readonly></v-text-field>
                            </v-col>
                    </v-card-text>
                </v-card-item>
            </v-card>
        </v-col>
    </v-row>
</template>


<script lang="ts">

export default {
    data: () => ({
        name: '',
        type: '',
        money: '',
        out_trade_no: ''
    }),
    mounted() {
        // 获取查询参数
        this.name = this.$route.query.name?.toString() || '';
        this.type = this.$route.query.type?.toString() || '';
        this.money = this.$route.query.money?.toString() || '';
        this.out_trade_no = this.$route.query.out_trade_no?.toString() || '';
    },
    methods: {
        showMessage(text: string, color: string = 'success') {
            this.$store.dispatch('snackbar/showSnackbar', {
                text,
                color
            });
        },
    }
}
</script>

<style>
.main {
    height: 100%;
}

.payCard {
    height: calc(70%);
}
</style>