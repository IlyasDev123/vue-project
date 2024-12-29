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
const recuriter = [
     // Recruiter Employer Links
     {
        path: "/employers",
        name: "EmployersPage",
        component: () =>
            import("../pages/recruiter/recruiter-employers/EmployersPage.vue"),
    },
    {
        path: "/employer-add",
        name: "AddEmployerPage",
        component: () =>
            import(
                "../pages/recruiter/recruiter-employers/AddEmployerPage.vue"
            ),
    },
    {
        path: "/employer-detail",
        name: "DetailEmployerPage",
        component: () =>
            import(
                "../pages/recruiter/recruiter-employers/DetailEmployerPage.vue"
            ),
    },
    {
        path: "/employer-reffer",
        name: "RefferEmployerPage",
        component: () =>
            import(
                "../pages/recruiter/recruiter-employers/RefferEmployerPage.vue"
            ),
    },

    // Recruiter Talent Links
    {
        path: "/talent",
        name: "RecruiterTalentPage",
        component: () =>
            import("../pages/recruiter/recruiter-talent/TalentPage.vue"),
    },
    {
        path: "/talent-add",
        name: "AddTalentPage",
        component: () =>
            import("../pages/recruiter/recruiter-talent/AddTalentPage.vue"),
    },
    {
        path: "/talent-detail",
        name: "DetailTalentPage",
        component: () =>
            import("../pages/recruiter/recruiter-talent/DetailTalentPage.vue"),
    },
    {
        path: "/talent-reffer",
        name: "RefferTalentPage",
        component: () =>
            import("../pages/recruiter/recruiter-talent/RefferTalentPage.vue"),
    },

    // Recruiter Match Links
    {
        path: "/match",
        name: "MatchPage",
        component: () =>
            import("../pages/recruiter/recruiter-match/MatchPage.vue"),
    },
    {
        path: "/match-reffer",
        name: "MatchRefferPage",
        component: () =>
            import("../pages/recruiter/recruiter-match/MatchReffer.vue"),
    },

    // Post Page Links
    {
        path: "/post",
        name: "PostPage",
        component: () => import("../pages/recruiter/add-post/Post.vue"),
    },

    // Manage Request Page
    {
        path: "/resume-request",
        name: "ResumeRequests",
        component: () =>
            import("../pages/recruiter/manage-request/ResumeRequests.vue"),
    },
    {
        path: "/interview-request",
        name: "InterviewRequests",
        component: () =>
            import("../pages/recruiter/manage-request/InterviewRequests.vue"),
    },
    {
        path: "/full-access-request",
        name: "FullAccessRequests",
        component: () =>
            import("../pages/recruiter/manage-request/FullAccessRequests.vue"),
    },
    {
        path: "/welcome-back",
        name: "WelcomeBack",
        component: () =>
            import("../pages/talent/talent-dashboard/PageWelcomeBack.vue"),
    },
    {
        path: "/edit-experience",
        name: "EditExperience",
        component: () =>
            import("../pages/talent/talent-dashboard/PageEditExperience.vue"),
    },
    {
        path: "/edit-experience-almost",
        name: "AlmostExperience",
        component: () =>
            import(
                "../pages/talent/talent-dashboard/PageAlmostEditProfile.vue"
            ),
    },
    {
        path: "/edit-culture",
        name: "EditCulture",
        component: () =>
            import("../pages/talent/talent-dashboard/PageEditCulture.vue"),
    },
    {
        path: "/edit-coworker",
        name: "EditCoworker",
        component: () =>
            import("../pages/talent/talent-dashboard/PageEditCoWorker.vue"),
    },
    {
        path: "/edit-hobbies",
        name: "EditHobbies",
        component: () =>
            import("../pages/talent/talent-dashboard/PageEditHobbies.vue"),
    },

];

export default recuriter;