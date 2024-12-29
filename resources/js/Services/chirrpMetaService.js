import axios from "./AxiosDefault";

export default {
    getMetaData: () => axios.get("/chirrrp-meta"),
    getProfessions: (id) => axios.get(`/profession/${id}`),
    getRecruiters: () => axios.get(`/recruiters`),
    addSalary: (payload) => axios.post(`/add-salary`, payload),
};
