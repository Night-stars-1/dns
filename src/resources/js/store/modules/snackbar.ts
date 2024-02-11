export default {
    namespaced: true,
    state: {
        snackbar: {
            value: false,
            text: "",
            color: "",
        },
    },
    mutations: {
        setSnackbar(
            state: { snackbar: { value: boolean; text: string; color: string } },
            payload: { value: boolean; text: string; color: string }
        ) {
            state.snackbar.value = payload.value;
            state.snackbar.text = payload.text;
            state.snackbar.color = payload.color;
        },
    },
    actions: {
        showSnackbar({ commit }: any, payload: { text: string; color: string }) {
            commit("setSnackbar", {
                value: true,
                text: payload.text,
                color: payload.color,
            });
        },
        hideSnackbar({ commit }: any) {
            commit("setSnackbar", {
                value: false,
                text: "",
                color: "",
            });
        },
    },
};
