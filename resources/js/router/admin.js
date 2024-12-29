import Auth from "../auth";
const ifAuthenticated = (next) => {
    if (Auth.authCheck()) {
        return true;
    } else {
        router.push({
            name: "Login",
        });
    }
};


const admin = [
    {
        path: "/super-admin/recruiter",
        name: "RecruiterPage",
        component: () =>
            import("../pages/recruiter/recruiter-talent/TalentPage.vue"),
    },
    {
        path: "/super-admin/recruiter-add",
        name: "AddRecruiterPagePage",
        component: () =>
            import("../pages/recruiter/recruiter-talent/AddTalentPage.vue"),
    },
    {
        path: "/super-admin/recruiter-detail",
        name: "DetailRecruiterPage",
        component: () =>
            import("../pages/recruiter/recruiter-talent/DetailTalentPage.vue"),
    },
    {
        path: "/super-admin/recruiter-reffer",
        name: "RefferRecruiterPage",
        component: () =>
            import("../pages/recruiter/recruiter-talent/RefferTalentPage.vue"),
    },
    // {
    //     path: "/super-admin-recruiters",
    //     name: "Recruiters",
    //     component: () => import("../pages/super-admin/Recruiters.vue"),
    // },
];

export default admin;