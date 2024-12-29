import axios from "./AxiosDefault";

export default {
    getMyTalentList: (payload) =>
        axios.post("/companies/my-talent-list", payload),
    getAllTalentList: (payload) => axios.post("/companies/talent", payload),
    getTalent: (id) => axios.get(`/companies/my-talent/${id}`),
    passPortfolio: (data) => axios.post(`/portfolios/reject`, data),
    matchPortfolio: (data) => axios.post(`/portfolios/match`, data),
    addPosition: (data) => axios.post(`/companies/create-job`, data),
    getPosition: (id) => axios.get(`/companies/get-position/${id}`),

    sendInterviewRequest: (data) =>
        axios.post(`/companies/send-interview-request`, data),
    updatePosition: (data) => axios.post(`/companies/update-position`, data),
    getFullAccess: () => axios.get("/companies/send-premium-request"),
    updateProfileMeta: (data) =>
        axios.post(`/companies/update-profile-meta`, data),
};
