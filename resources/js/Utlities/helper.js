const setLocalStorage = (key, payload) => {
    let data = getLocalStorage(key);
    if (data.lenght != 0) {
        let users = { ...data, ...payload };
        return localStorage.setItem(key, JSON.stringify(users));
    } else {
        return localStorage.setItem(key, JSON.stringify(users));
    }
};

const getLocalStorage = (key) => {
    return JSON.parse(localStorage.getItem(key)) || [];
};

const removeItemLocalStorage = (key) => {
    return localStorage.removeItem(key);
};

export default {
    setLocalStorage,
    getLocalStorage,
    removeItemLocalStorage,
};
