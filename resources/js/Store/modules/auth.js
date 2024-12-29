import axios from "../../Services/AxiosDefault";
import authService from "../../Services/authService";
import router from "../../router/router";

const state = {
    user: [],
    userMeta: [],
    token: null,
    isLogin: false,
    loader: false,
    errors: [],
    isError: false,
    userSkill: [],
    companyPositions: [],
};

// getters
const getters = {
    userProfileData(state) {
        return state.user;
    },
    isNoLongerInterest(state) {
        return state.user.is_longer_interested;
    },
};

// mutations
const mutations = {
    REGISTER_USER(state, payload) {
        state.user = payload;
    },
    REGISTER_FAILED(state, payload) {
        state.errors = payload;
    },
    LOGIN_SUCCESS(state, payload) {
        state.token = payload.access_token;
        state.user = payload;
        state.isLogin = true;
    },
    LOGIN_FAILED(state, payload) {
        state.token = null;
        state.errors = payload;
        state.isLogin = false;
        state.isError = true;
    },
    LOADER(state, payload) {
        state.loader = payload;
    },
    USER(state, payload) {
        console.log("ssssss: "+payload.first_name);
        state.user = payload;
        state.isLogin = true;
    },
    USER_META(state, payload) {
        state.userMeta = payload;
    },
    TALENT_SKILL(state, payload) {
        state.userSkill = payload;
    },
    COMPANY_POSITION(state, payload) {
        state.companyPositions = payload;
    },
    IS_LOGIN(state, payload) {
        state.isLogin = true;
    },
};
// actions
const actions = {
    async register({ commit }, payload) {
        commit("LOADER", true);
        const response = await axios
            .post("/create-account", payload)
            .then((response) => {
                localStorage.setItem("token", response.data.data.token);
                commit("REGISTER_USER", response.data.data);
                commit("LOADER", false);
            })
            .catch((errors) => {
                commit("LOADER", false);
                commit("REGISTER_FAILED", errors.response.data.errors);
            });
    },

    async login({ commit }, payload) {
        commit("LOADER", true);
        console.log(payload);
        const response = await authService
            .login(payload)
            .then((response) => {
                if (!localStorage.token) {
                    localStorage.setItem("token", response.data.data.token);
                }
                console.log(response);
                commit("LOGIN_SUCCESS", response.data.data);
                commit("LOADER", false);
                router.push("/done");
            })
            .catch((error) => {
                commit("LOADER", false);
                // commit("LOGIN_FAILED", error.response.data.message);
                console.log(error.response.data.data);
                error.response.data.data == null
                    ? commit("LOGIN_FAILED", error.response.data.data.errors)
                    : commit("LOGIN_FAILED", error.response.data.message);
                this.$toast.error("test");
            });
    },

    async getCurrentUser({ commit }) {
        const response = await authService.getProfile().catch((errors) => {
            commit("LOADER", false);
            commit("ERRORS", errors.response.data.message);
        });
        let user = response.data.data;
        commit("IS_LOGIN", true);
        if (response.data.status == true) {
            commit("USER", {
                id: user.id,
                first_name: user.first_name,
                last_name: user.last_name,
                email: user.email,
                type: user.type,
                avatar: user.avatar,
                phone_no: user.phone_no,
                is_longer_interested: user.is_longer_interested,
            });
            commit(
                "USER_META",
                user.company_meta ? user.company_meta : user.talent_meta
            );
            commit("LOADER", false);
        }
    },

    async getSkill({ commit }) {
        const response = await authService.getSkill().catch((errors) => {
            commit("LOADER", false);
            commit("ERRORS", errors.response.data.message);
        });
        if (response.data.status == true) {
            commit("TALENT_SKILL", response.data.data.data);
            commit("LOADER", false);
        }
    },

    async getPositions({ commit }) {
        const response = await authService.getPositions().catch((errors) => {
            commit("LOADER", false);
            commit("ERRORS", errors.response.data.message);
        });
        if (response.data.status == true) {
            commit("COMPANY_POSITION", response.data.data.data);
            commit("LOADER", false);
        }
    },
};
export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
};
