import axios from "axios";
import Toaster from "@meforma/vue-toaster";
import authService from "./Services/authService";
import constants from "./Utlities/constant";

class Auth {
    constructor() {
        this.token = window.localStorage.getItem("token");
        let userData = window.localStorage.getItem("user");
        this.user = userData ? JSON.parse(userData) : null;

        if (this.token) {
            axios.defaults.headers.common["Authorization"] =
                "Bearer " + this.token;
        }
    }

    login(token, user) {
        window.localStorage.setItem("token", token);
        window.localStorage.setItem("user", JSON.stringify(user));
        axios.defaults.headers.common["Authorization"] = "Bearer " + token;

        this.token = token;
        this.user = user;
    }

    logout() {
        // window.localStorage.clear();
        window.localStorage.removeItem("token");
        window.localStorage.removeItem("user");
        this.user = null;

        return true;
    }

    authCheck() {
        if (
            window.localStorage.getItem("token") === null ||
            window.localStorage.getItem("token") === "undefined"
        ) {
            return false;
        }
        return true;
    }

    isTalent() {
        const user = window.localStorage.getItem("user") || [];
        return user.type == constants.TALENT ? true : false;
    }
    isEmployer() {
        const user = window.localStorage.getItem("user") || [];
        return user.type == constants.EMPLOYER ? true : false;
    }
    isRecuriter() {
        const user = window.localStorage.getItem("user") || [];
        return user.type == constants.RECURITER ? true : false;
    }
    isAdmin() {
        const user = window.localStorage.getItem("user") || [];
        return user.type == constants.ADMIN ? true : false;
    }

    check() {
        if (
            window.localStorage.getItem("token") === null ||
            window.localStorage.getItem("token") === "undefined"
        ) {
            if (this.user != null && this.user.email_verified_at == null) {
                this.logout();
                Toaster.error("Please verify your email");
                return false;
            }

            this.logout();
            return false;
        }

        return true;
    }

    userRefresh() {
        authService.getUser().then(({ data }) => {
            window.localStorage.setItem("user", JSON.stringify(data.data));
        });
    }

    checkProfileCompletion() {
        if (window.localStorage.getItem("user")) {
            let user = JSON.parse(window.localStorage.getItem("user"));
            return user.profile_completion;
        }

        return false;
    }

    getToken() {
        return this.token;
    }

    getUser() {
        return this.user;
    }
}

export default new Auth();
