import { createStore } from "vuex";
import snackbarModule from "./modules/snackbar";

const store = createStore({
    modules: {
        snackbar: snackbarModule,
    },
});

export default store;
