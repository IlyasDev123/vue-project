import axios from "./AxiosDefault";

export default {
    store: (data) => axios.post(`create-account`, data),
    login: (data) => axios.post(`/login`, data),
    logout: (data) => axios.post(`/logout`, data),
    getProfile: () => axios.get(`/users/get-profile`),
    getSkill: () => axios.get(`/talents/get-skill`),
    socialLogin: (data) => axios.post(`/social-login`, data),
    checkEmail: (data) => axios.post(`/check-email`, data),
    getPositions: () => axios.get(`/companies/get-positions`),
    uploadResume: (data) => axios.post(`/upload-cv`, data),
    forgetPassword: (data) => axios.post(`/forget-password`, data)
};
