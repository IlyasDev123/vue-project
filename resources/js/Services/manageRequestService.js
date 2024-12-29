import axios from "./AxiosDefault";

export default {
    getFullAccessRequest: (payload) =>
        axios.post(`manage-requests/premium-request`, payload),
    getInterviewRequests: () => axios.get(`manage-requests/interview-request`),
    updateFullAccessRequest: (payload) =>
        axios.post(`manage-requests/status-update`, payload),
    ScheduleInterviewRequests: (payload) =>
        axios.post(`manage-requests/schedule-interview`, payload),
};
