import axios from "./AxiosDefault";

export default {
    getJobList: (payload) => axios.post("/talents/job-list", payload),
    getAppliedJobList: () => axios.get("/talents/apply-job-list"),
    addSkill: (data) => axios.post(`/talents/add-skill`, data),
    getSkillById: (id) => axios.get(`/talents/get-skill/${id}`),
    updateSkill: (data) => axios.post(`/talents/update-skill`, data),
    updateProfile: (data) => axios.post(`/talents/update-profile`, data),
    getAppliedJobDetail: (id) => axios.get(`talents/applied-job-detail/${id}`),
    getTalentById: (id) => axios.get(`talents/talent/${id}`),
};
