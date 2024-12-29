import axios from "./AxiosDefault";
// const config = { headers: { 'Content-Type': 'multipart/form-data' } };
export default {
    getNotification: () => axios.get("/notifications/get-notification"),
    markAllAsRead: () => axios.get(`/notifications/mark-all-as-read`),
    markAsRead: (data) => axios.post(`/notifications/mark-as-read`,data), 
};
