import axios from "./AxiosDefault";
const config = { headers: { 'Content-Type': 'multipart/form-data' } };
export default {
    
    getProfile: () => axios.get("/users/get-profile"),
    search: (data) => axios.get(`/users/search/${data}`),
    updateProfile: (data) => axios.post(`/users/update-profile`,data),
    editProfile: (data) => axios.post(`/users/edit-profile`,data),
    getNotification: () => axios.get("/users/get-notification"),
    deletePortfolio: (id) => axios.delete(`/portfolios/delete-match-request/${id}`),
    deactivateAccount: () => axios.get("/users/deactivate-account"),
    getUser: (id) => axios.get(`/users/get-user/${id}`),
    markAllRead: () => axios.get(`/users/mark-all-read`),
    markAsRead: (data) => axios.post(`/users/mark-as-read`,data), 
    blockUser: (id) => axios.get(`/users/block-user/${id}`), 
    addUserReviews: (data) => axios.post(`/reviews/create`, data),
    createUser: (data) => axios.post(`users/create`, data),
    updateUser: (data) => axios.post(`users/update`, data),
    updateProfileStatus: (data) => axios.post(`/users/update-status`, data),
    getReferedTalents: (data) => axios.post(`/users/get-refered-talents`,data),
    getReferedCompany: (data) => axios.post(`/users/get-refered-company`,data),
    searchReferedTalents: (data) => axios.post(`/users/search-refered-talents`,data),
    searchReferedCompany: (data) => axios.post(`/users/search-refered-company`,data),
    uploadProfileImage:(data) => axios.post(`/users/upload-profile-image`, data, config),
    deleteUser: (id) => axios.delete(`/users/delete-user/${id}`),
    getTalentReffered: (id) => axios.get(`/users/get-recruiter-talent-reffers/${id}`),
    getEmployersReffered: (id) => axios.get(`/users/get-recruiter-employer-reffers/${id}`),
    updateUserBlockStatus: (data) => axios.post(`/users/update-user-block-status`, data), 
};
