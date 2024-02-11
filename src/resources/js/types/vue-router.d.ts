// vue-router.d.ts

import { RouteLocationNormalized } from 'vue-router';

declare module 'vue-router' {
  interface RouteMeta {
    title?: string;
  }

  interface RouteLocationNormalized {
    meta: RouteMeta;
  }
}
