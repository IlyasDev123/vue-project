import axios from "axios";
// ======================Axios configuration===============================
import router from "./router/router.js";

axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

axios.defaults.headers.common["Accept"] = "Application/json, text/plain, */*";
axios.interceptors.request.use(
    function (config) {
        if (
            localStorage.getItem("token") === null ||
            localStorage.getItem("token") === "undefined"
        ) {
            config.headers.common["Authorization"] = "";
        } else {
            config.headers.common[
                "Authorization"
            ] = `Bearer ${localStorage.getItem("token")}`;
        }
        return config;
    },
    function (error) {
        return Promise.reject(error);
    }
);

axios.interceptors.response.use(
    function (response) {
        return response;
    },
    function (error) {
        // Do something with response error
        return Promise.reject(error);
    }
);

axios.interceptors.response.use(
    function (response) {
        return response;
    },
    function (error) {
        if (
            error.response.status === 401 &&
            error.response.data.transactionId === undefined
        ) {
            localStorage.removeItem("token");
            localStorage.removeItem("user");
            router.push({
                name: "Login",
            });
        }
        return error.response;
    }
);
// ======================Axios configuration===============================
