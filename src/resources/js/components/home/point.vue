<template>
    <v-sheet class="col-12 col-md-9 col-xl-10 py-md-3 pl-md-5 pr-md-5" style="height: 100%; width: 100%;">
        <v-data-table :loading="loading" :headers="dataHeaders" :items="data" item-value="name" loading-text="积分明细加载中..."
            no-data-text="暂未积分明细" itemsPerPageText="每页条目数:">
            <template v-slot:top>
                <v-toolbar flat>
                    <v-toolbar-title>积分明细 -- 当前积分【{{ user.point }}】</v-toolbar-title>
                    <v-btn color="indigo-darken-3" variant="flat"
                        :href="`/epay/index.php?WIDuser=${user.uid}&WIDtotal_fee=10&WIDsubject=积分充值`">
                        积分充值
                    </v-btn>
                </v-toolbar>
                <v-row class="mt-3" no-gutters>
                    <v-select v-model="searchAct" label="检索" :items="searchData" item-title="text"
                        item-value="value" variant="solo-filled" @update:model-value="getList(1)"></v-select>
                </v-row>
            </template>
        </v-data-table>
    </v-sheet>
</template>

<script lang="ts">
export default {
    data: () => ({
        loading: false,
        dataHeaders: [
            {
                title: 'ID',
                key: 'id',
            },
            { title: '操作', key: 'action' },
            { title: '积分', key: 'point' },
            { title: '剩余', key: 'rest' },
            { title: '详情', key: 'remark' },
            { title: '时间', key: 'created_at' },
        ],
        data: [] as RecordList,
        searchData: [
            {
                text: '所有',
                value: 'all',
            },
            {
                text: '增加',
                value: 'increase',
            },
            {
                text: '减少',
                value: 'reduce',
            },
            {
                text: '消费',
                value: '消费',
            },
            {
                text: '充值',
                value: '充值',
            },
        ],
        searchAct: 'all',
    }),
    mounted() {
        this.getList(1);
    },
    methods: {
        async getList(page: number) {
            this.loading = true;
            const response = await this.$axios.post('/home', {
                page: page,
                uid: '',
                act: this.searchAct,
                action: 'pointRecord',
            });
            this.loading = false;
            this.data = response.data.data.data;
        },
    },
};
</script>
