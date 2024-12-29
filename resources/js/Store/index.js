import { createStore } from "vuex";
// import createPersistedState from "vuex-persistedstate";
import auth from "./modules/auth";
import chirrrpMeta from "./modules/chirrrpMeta";

const store = createStore({
    modules: {
        auth,
        chirrrpMeta,
    },

    // plugins: [createPersistedState()],
});

export default store;
