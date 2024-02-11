<template>
    <v-sheet class="col-12 col-md-9 col-xl-10 py-md-3 pl-md-5 pr-md-5" style="height: 100%; width: 100%;">
        <v-data-table :loading="loading" :headers="dataHeaders" :items="data" item-value="name" loading-text="解析域名加载中..."
            no-data-text="暂未解析域名" itemsPerPageText="每页条目数:">
            <template v-slot:top>
                <v-toolbar flat>
                    <v-toolbar-title>记录列表</v-toolbar-title>
                    <v-btn color="indigo-darken-3" variant="flat" @click="domainDialog = true">
                        添加记录
                    </v-btn>
                </v-toolbar>
                <v-row class="mt-2">
                    <v-col cols="10">
                        <v-row no-gutters>
                            <v-select label="域名" v-model="searchData.did"
                                :items="[{ did: 0, domain: '所有', point: 0, desc: '', line: { Name: '', Id: 0, } }, ...domainList]"
                                item-title="domain" item-value="did" variant="solo-filled"></v-select>
                            <v-select class="ml-4" v-model="searchData.type" label="记录类型"
                                :items="[{ index: 0, name: '所有' }, ...domainTypeData]" item-title="name" item-value="index"
                                variant="solo-filled"></v-select>
                        </v-row>
                        <v-row no-gutters>
                            <v-text-field v-model="searchData.name" label="主机记录" variant="solo-filled"></v-text-field>
                            <v-text-field v-model="searchData.value" class="ml-4" label="记录值"
                                variant="solo-filled"></v-text-field>
                        </v-row>
                    </v-col>
                    <v-col align-self="center">
                        <v-btn @click="getList(1)">搜索</v-btn>
                    </v-col>
                </v-row>
            </template>
            <template v-slot:item.link="{ item }">
                <a :href="`http://${item.name}.${item.domain.domain}`" target="_blank">{{ item.name + '.' + item.domain.domain }}</a>
            </template>
            <template v-slot:item.actions="{ item }">
                <v-btn icon="mdi-pencil" size="small" variant="text" class="me-2" @click="editItem(item)"></v-btn>

                <v-tooltip text="双击删除">
                    <template v-slot:activator="{ props }">
                        <v-btn icon="mdi-delete" size="small" variant="text" class="me-2" v-bind="props"
                            :loading="item.deleteing" @dblclick="deleteDomain(item)"></v-btn>
                    </template>
                </v-tooltip>
            </template>
        </v-data-table>
    </v-sheet>

    <v-dialog v-model="domainDialog" @update:modelValue="editeding=false" width="auto" min-width="500px">
        <v-card>
            <v-toolbar dark color="primary">
                <v-toolbar-title>记录添加/修改</v-toolbar-title>
                <v-spacer></v-spacer>
                <v-btn icon dark @click="domainDialog = false">
                    <v-icon>mdi-close</v-icon>
                </v-btn>
            </v-toolbar>
            <v-card-item>
                <v-row align="center" no-gutters>
                    <v-col cols="8">
                        <v-text-field v-model="domainData.name" label="邮箱前缀" placeholder="键入邮箱前缀" outlined dense>
                        </v-text-field>
                    </v-col>
                    <v-col cols="4">
                        <v-select v-model="domainData.domain" :items="domainList" :disabled="editeding" item-title="domain"
                            item-value="desc" label="邮箱后缀" outlined dense return-object></v-select>
                    </v-col>
                    <v-alert border="start" border-color="deep-purple accent-4" class="mb-5" v-if="domainData.domain"
                        :text="domainData.domain.desc" no-gutters></v-alert>
                </v-row>
                <v-select v-model="domainData.type" :items="domainTypeData" label="记录类型" outlined dense>
                </v-select>
                <v-text-field v-model="domainData.value" label="记录值" placeholder="键入记录值" outlined dense></v-text-field>
                <v-select v-model="domainData.line_id" :items="domainData.domain?.line" item-title="Name" item-value="Id"
                    label="线路" outlined dense>
                </v-select>
                <v-alert :text="`${domainData.domain?.point.toString()} 积分/条`" no-gutters>
                    <template v-slot:prepend>
                        <span class="mr-2">积分</span>
                    </template>
                </v-alert>
            </v-card-item>
            <v-card-actions class="py-3 mr-3">
                <v-spacer></v-spacer>
                <v-btn :loading="saveing" variant="flat" color="indigo-darken-3" @click="saveDomain"
                    :disabled="!domainData.domain?.did || !domainData.name || !domainData.type || !domainData.value">
                    保存
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>


<script lang="ts">
export default {
    data: () => ({
        domainDialog: false,
        editeding: false,
        loading: false,
        saveing: false,
        deleteing: false,
        dataHeaders: [
            {
                title: 'ID',
                key: 'id',
            },
            { title: '域名', key: 'link' },
            { title: '记录类型', key: 'type' },
            { title: '线路', key: 'line' },
            { title: '记录值', key: 'value' },
            { title: '添加时间', key: 'created_at' },
            { title: '操作', key: 'actions' },
        ],
        data: [] as RecordList,
        domainList: [] as DomainList,
        domainData: {
            id: 0,
            domain: null as DomainItem | null,
            type: 'A',
            name: '',
            point: '',
            value: '',
            line_id: '0',
        },
        domainTypeData: [{
            index: 'A',
            name: 'A',
        }, {
            index: 'AAAA',
            name: 'AAAA',
        }, {
            index: 'CNAME',
            name: 'CNAME',
        }],
        searchData: {
            did: 0,
            name: '',
            type: 0 as string | number,
            value: '',
        }
    }),
    mounted() {
        this.getList(1);
        this.getDomainList(1);
    },
    methods: {
        showMessage(text: string, color: string = 'success') {
            this.$store.dispatch('snackbar/showSnackbar', {
                text,
                color
            });
        },
        editItem(item: RecordItem) {
            const domain = this.domainList.find((domain) => domain.domain === item.domain.domain) as DomainItem;
            this.editeding = true;
            this.domainData.id = item.id;
            this.domainData.domain = domain;
            this.domainData.type = item.type;
            this.domainData.name = item.name;
            this.domainData.value = item.value;
            this.domainData.line_id = item.line_id;
            this.domainDialog = true;
        },
        async getList(page: number) {
            this.loading = true;
            const response = await this.$axios.post('/home', {
                page: page,
                action: 'recordList',
                ...this.searchData
            });
            this.loading = false;
            this.data = response.data.data.data;
        },
        async getDomainList(page: number) {
            const response = await this.$axios.post('/home', {
                page: page,
                did: 0,
                name: '',
                type: 0,
                value: '',
                action: 'domainList',
            });
            this.domainList = response.data.data;
            this.domainData.domain = this.domainList[0];
        },
        async saveDomain() {
            this.saveing = true;
            const data: { action: string; name: string; did: number | undefined; type: string; value: string; line_id: string; id?: any; } = {
                action: "recordStore",
                name: this.domainData.name,
                did: this.domainData.domain?.did,
                type: this.domainData.type,
                value: this.domainData.value,
                line_id: this.domainData.line_id,
            }
            if (this.editeding) data.id = this.domainData.id;
            this.$axios.post('/home', data)
                .then((response) => {
                    this.saveing = false;
                    const data = response.data;
                    const message = data.message;
                    this.showMessage(message);
                    if (data.status === 0) {
                        this.getList(1);
                    }
                    this.editeding = false;
                    this.domainDialog = false;
                    this.domainData = {
                        id: 0,
                        domain: this.domainList[0],
                        type: 'A',
                        name: '',
                        point: '',
                        value: '',
                        line_id: '0',
                    };
                });
        },
        async deleteDomain(item: RecordItem) {
            item.deleteing = true;
            this.$axios.post('/home', {
                action: "recordDelete",
                id: item.id,
            })
                .then((response) => {
                    item.deleteing = false;
                    const data = response.data;
                    const message = data.message;
                    this.showMessage(message);
                    if (data.status === 0) {
                        this.getList(1);
                    }
                });
        }
    },
};
</script>
