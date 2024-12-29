import axios from "axios";
import { BASE_URL } from "../ApiUrl/UrlConstants";

axios.defaults.baseURL = BASE_URL;

axios.defaults.headers.common["Authorization"] =
    "Bearer" + window.localStorage.getItem("token");
axios.defaults.headers.post["Content-Type"] = "Application/json";
axios.defaults.headers.post["Content-Type"] = "multipart/form-data";

axios.defaults.headers.common["Accept"] = "Application/json, text/plain, */*";
// axios.interceptors.request.use(
//     function (config) {
//         if (
//             localStorage.getItem("token") === null ||
//             localStorage.getItem("token") === "undefined"
//         ) {
//             config.headers.common["Authorization"] = "";
//         } else {
//             config.headers.common[
//                 "Authorization"
//             ] = `Bearer ${localStorage.getItem("token")}`;
//         }
//         return config;
//     },
//     function (error) {
//         return Promise.reject(error);
//     }
// );

// axios.interceptors.response.use(
//     function (response) {
//         return response;
//     },
//     function (error) {
//         // Do something with response error
//         return Promise.reject(error);
//     }
// );

// axios.interceptors.response.use(
//     function (response) {
//         return response;
//     },
//     function (error) {
//         if (
//             error.response.status === 401 &&
//             error.response.data.transactionId === undefined
//         ) {
//             localStorage.removeItem("token");
//             localStorage.removeItem("user");
//             router.push({
//                 name: "Login",
//             });
//         }
//         return error.response;
//     }
// );

export default axios;
