import axios from "./AxiosDefault";

export default {
    getTalentsList: (data) => axios.post(`/refer/talents-list`, data),
    getEmployersList: (data) => axios.post(`/refer/employers-list`, data),
    referTalents: (payload) => axios.post(`/refer/talents`, payload),
};
