import axios from "./AxiosDefault";
const config = { headers: { 'Content-Type': 'multipart/form-data' } };
export default {
    getEmployeesList: (filter, urlParams) => axios.post(`/recruiters/get-all-employees`+urlParams,filter),
    getTalentList: (filter, urlParams) => axios.post(`/recruiters/get-all-talent`+urlParams, filter),
    getRecruiterList: (filter, urlParams) => axios.post(`/recruiters/get-all-recruiter`+urlParams,filter),
};