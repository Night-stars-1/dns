// shims-vue.d.ts

import { AxiosInstance } from 'axios';
import { Store } from 'vuex';
import { App } from 'vue';
import { ComponentCustomProperties } from 'vue';

type StoreItem = {
  snackbar: {
    snackbar: {
      value: boolean;
      text: string;
      color: string;
    }
  }
}
declare module '@vue/runtime-core' {
  interface ComponentCustomProperties {
    $axios: AxiosInstance;
    user: User;
    $store: Store<StoreItem>; // 这里的 any 可以替换为你实际的根状态类型
  }
}
