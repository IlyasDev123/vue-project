import axios from "./AxiosDefault";

export default {
    getAllPost: () => axios.get(`posts/all`),
    getPublicPosts: (payload) => axios.get(`posts/public`, payload),
    likePost: (data) => axios.post(`posts/like-post`, data),
    createPost: (data) => axios.post(`posts/create`, data),
    privacyChange: (data) => axios.post(`posts/privacy-change`, data),
    deletePost: (data) => axios.post(`posts/delete/`+data),
    updatePost: (data, id) => axios.post(`posts/update/`+id, data),
};
