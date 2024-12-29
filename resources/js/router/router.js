import { createWebHistory, createRouter } from "vue-router";
import PageNotFound from "../components/NotFound/PageNotFound.vue";
import constants from "../Utlities/constant";
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

const istalentAuthenticated = (next) => {
    if (Auth.authCheck()) {
        if (Auth.getUser().type == constants.TALENT) {
            return true;
        }
        return router.push({
            name: "PageNotFound",
        });
    } else {
        router.push({
            name: "Login",
        });
    }
};

const isEmployerAuthenticated = (next) => {
    if (Auth.authCheck()) {
        console.log(Auth.getUser());
        if (Auth.getUser().type == constants.EMPLOYER) {
            return true;
        }
        return router.push({
            name: "PageNotFound",
        });
    } else {
        router.push({
            name: "Login",
        });
    }
};

const isRecuriterAuthenticated = (next) => {
    if (Auth.authCheck()) {
        if (
            Auth.getUser().type == constants.RECURITER ||
            Auth.getUser().type == constants.ADMIN
        ) {
            return true;
        }

        return router.push({
            name: "PageNotFound",
        });
    } else {
        router.push({
            name: "Login",
        });
    }
};

const isAdminAuthenticated = (next) => {
    if (Auth.authCheck()) {
        if (Auth.getUser().type == constants.ADMIN) {
            return true;
        }
        return router.push({
            name: "PageNotFound",
        });
    } else {
        router.push({
            name: "Login",
        });
    }
};
const routes = [
    {
        path: "/login",
        name: "Login",
        component: () => import("../pages/LoginPage.vue"),
    },
    {
        path: "/forget-password",
        name: "ForgetPassword",
        component: () => import("../pages/ForgetPassword.vue"),
    },

    // Talent Register Dashboard Link
    {
        path: "/talent-detail/:id",
        name: "TalentDetail",
        component: () => import("../pages/talent/cvs/TalentDetail.vue"),
    },

    {
        path: "/register",
        name: "UserRegisterPage",
        component: () =>
            import("../pages/talent/TalentRegister/UserRegisterPage.vue"),
    },
    {
        path: "/select-role",
        name: "SelectRolePage",
        component: () =>
            import("../pages/talent/TalentRegister/SelectRolePage.vue"),
    },
    // TAlent Register Form
    {
        path: "/getin",
        name: "GetIN",
        component: () =>
            import("../pages/talent/TalentRegister/SelectRolePage.vue"),
    },
    {
        path: "/select-industry",
        name: "SelectIndustry",
        component: () =>
            import("../pages/talent/TalentRegister/SelectRolePage.vue"),
    },
    {
        path: "/profession",
        name: "Profession",
        component: () =>
            import("../pages/talent/TalentRegister/SelectRolePage.vue"),
    },
    {
        path: "/profile-crafting",
        name: "ProfileCrafting",
        component: () =>
            import("../pages/talent/TalentRegister/SelectRolePage.vue"),
    },
    {
        path: "/important-things",
        name: "ImportantThings",
        component: () =>
            import("../pages/talent/TalentRegister/SelectRolePage.vue"),
        // beforeEnter: [ifAuthenticated],
    },
    {
        path: "/love-about-work",
        name: "LoveAboutWork",
        component: () =>
            import("../pages/talent/TalentRegister/SelectRolePage.vue"),
        // beforeEnter: [ifAuthenticated],
    },
    {
        path: "/co-workers",
        name: "COWorkers",
        component: () =>
            import("../pages/talent/TalentRegister/SelectRolePage.vue"),
        // beforeEnter: [ifAuthenticated],
    },
    {
        path: "/hobbies",
        name: "Hobbies",
        component: () =>
            import("../pages/talent/TalentRegister/SelectRolePage.vue"),
        // beforeEnter: [ifAuthenticated],
    },
    {
        path: "/last-question",
        name: "LastQuestion",
        component: () =>
            import("../pages/talent/TalentRegister/SelectRolePage.vue"),
        // beforeEnter: [ifAuthenticated],
    },
    {
        path: "/management-style",
        name: "ManagementStyle",
        component: () =>
            import("../pages/talent/TalentRegister/SelectRolePage.vue"),
    },
    {
        path: "/customize-profile",
        name: "CustomizeProfile",
        component: () =>
            import("../pages/talent/TalentRegister/SelectRolePage.vue"),
        // beforeEnter: [ifAuthenticated],
    },
    {
        path: "/hear-about-us",
        name: "HearAboutUs",
        component: () =>
            import("../pages/talent/TalentRegister/SelectRolePage.vue"),
        // beforeEnter: [ifAuthenticated],
    },
    {
        path: "/thanks",
        name: "Thanks",
        component: () =>
            import("../pages/talent/TalentRegister/SelectRolePage.vue"),
        // beforeEnter: [ifAuthenticated],
    },
    // End Talent
    {
        path: "/done",
        name: "AllmostDone",
        component: () =>
            import("../pages/talent/TalentRegister/SelectRolePage.vue"),
        // beforeEnter: [ifAuthenticated],
    },

    // Talent Dashboard Link
    {
        path: "/new-job-match",
        name: "NewJobMatch",
        component: () =>
            import("../pages/talent/talent-dashboard/PageWeWorking.vue"),
        beforeEnter: [istalentAuthenticated],
    },
    {
        path: "/companies",
        name: "CompaniesProfile",
        component: () =>
            import("../pages/talent/talent-dashboard/PageCompaniesProfile.vue"),
    },
    {
        path: "/companies/profile/:id?",
        name: "CompaniesCustomizeProfile",
        component: () =>
            import(
                "../pages/talent/talent-dashboard/PageCompaniesCustomizeProfile.vue"
            ),
        beforeEnter: [istalentAuthenticated],
    },
    {
        path: "/talent/my-talent-detail/:id?",
        name: "MyTalentDetail",
        component: () =>
            import("../pages/employer/employer-dashboard/MyTalentDetail.vue"),
        beforeEnter: [ifAuthenticated],
    },
    {
        path: "/add-new-skill-role",
        name: "AddNewSKillRole",
        component: () =>
            import("../pages/talent/talent-dashboard/PageSelectNewRole.vue"),
        beforeEnter: [istalentAuthenticated],
    },
    {
        path: "/all-set",
        name: "AllSet",
        component: () =>
            import("../pages/talent/talent-dashboard/PageAllSet.vue"),
    },
    {
        path: "/edit-profile/:id?",
        name: "EditProfile",
        component: () =>
            import(
                "../pages/talent/talent-dashboard/PageDashboardEditProfile.vue"
            ),
        beforeEnter: [istalentAuthenticated],
    },
    {
        path: "/add-new-skill",
        name: "AddNewSKill",
        component: () =>
            import("../pages/talent/talent-dashboard/PageAddNewSKill.vue"),

        beforeEnter: [istalentAuthenticated],
    },
    {
        path: "/skills/role-industry",
        name: "RoleIndustry",
        component: () =>
            import("../pages/talent/skill/add/PageRoleIndustry.vue"),
        beforeEnter: [istalentAuthenticated],
    },
    {
        path: "/skills/profession",
        name: "TalentProfession",
        component: () => import("../pages/talent/skill/add/Profession.vue"),
        beforeEnter: [istalentAuthenticated],
    },
    {
        path: "/skills/edit-experience",
        name: "EditExperience",
        component: () => import("../pages/talent/skill/add/ProfileDetail.vue"),
        beforeEnter: [istalentAuthenticated],
    },
    {
        path: "/good-read",
        name: "GoodRead",
        component: () =>
            import("../pages/talent/talent-dashboard/GoodRead.vue"),
        beforeEnter: [ifAuthenticated],
    },

    //Employer and Talent Dashboard Link
    {
        path: "/profile-settings",
        name: "ProfileSettings",
        component: () => import("../pages/profileSettings/ProfileSettings.vue"),
        beforeEnter: [ifAuthenticated],
    },

    {
        path: "/talent-detail/:id",
        name: "TalentDetail",
        component: () => import("../pages/talent/cvs/TalentDetail.vue"),
        beforeEnter: [ifAuthenticated],
    },

    // Empolyer Link
    {
        path: "/employer/update-position/:id?",
        name: "UpdatePosition",
        component: () =>
            import("../pages/employer/positions/UpdatePosition.vue"),
        beforeEnter: [isEmployerAuthenticated],
    },
    {
        path: "/new-talent-match",
        name: "NewTalentMatch",
        component: () =>
            import("../pages/employer/employer-dashboard/TalentMatch.vue"),
        beforeEnter: [isEmployerAuthenticated],
    },
    {
        path: "/talent",
        name: "MyTalent",
        component: () =>
            import("../pages/employer/employer-dashboard/MyTalent.vue"),
        beforeEnter: [isEmployerAuthenticated],
    },
    {
        path: "/position/add/:id?",
        name: "EmployerBack",
        component: () =>
            import("../pages/employer/employer-dashboard/PageWelcomeBack.vue"),
        beforeEnter: [isEmployerAuthenticated],
    },
    {
        path: "/position/add/select-industry",
        name: "EmployerSelectIndustry",
        component: () =>
            import("../pages/employer/employer-dashboard/PageRoleIndustry.vue"),
        beforeEnter: [isEmployerAuthenticated],
    },
    {
        path: "/position/add/select-new-role",
        name: "EmployerSelectNewRole",
        component: () =>
            import(
                "../pages/employer/employer-dashboard/PageSelectNewRole.vue"
            ),
        beforeEnter: [isEmployerAuthenticated],
    },
    {
        path: "/position/add/additional-salary",
        name: "EmployerAdditionalSalary",
        component: () =>
            import("../pages/employer/employer-dashboard/AdditionalSalary.vue"),
        beforeEnter: [isEmployerAuthenticated],
    },
    {
        path: "/position/add/all-set",
        name: "EmployerAllSet",
        component: () =>
            import("../pages/employer/employer-dashboard/PageAllSet.vue"),
        beforeEnter: [isEmployerAuthenticated],
    },
    {
        path: "/position/add/edit-profile",
        name: "EmployerEditProfile",
        component: () =>
            import(
                "../pages/employer/employer-dashboard/PageDashboardEditProfile.vue"
            ),
        beforeEnter: [isEmployerAuthenticated],
    },
    {
        path: "/position/add/almost-done",
        name: "EmployerAlmostDone",
        component: () =>
            import(
                "../pages/employer/employer-dashboard/PageAlmostEditProfile.vue"
            ),
        beforeEnter: [ifAuthenticated],
    },
    {
        path: "/position/add/management-style",
        name: "EmployerManagementStyle",
        component: () =>
            import(
                "../pages/employer/employer-dashboard/PageManagmentSTyle.vue"
            ),
        beforeEnter: [isEmployerAuthenticated],
    },
    {
        path: "/position/add/schedualing",
        name: "EmployerSchedualing",
        component: () =>
            import("../pages/employer/employer-dashboard/PageSchedualing.vue"),
    },
    {
        path: "/employer/companies-profile",
        name: "EmployerCompaniesProfile",
        component: () =>
            import(
                "../pages/employer/employer-dashboard/PageCompaniesProfile.vue"
            ),
        beforeEnter: [ifAuthenticated],
    },
    {
        path: "/employer/companies-profile-cv",
        name: "EmployerCompaniesProfileCV",
        component: () =>
            import("../pages/talent/talent-dashboard/PageEmployerCVBlock.vue"),
        beforeEnter: [ifAuthenticated],
    },
    {
        path: "/get-full-access",
        name: "GetFullAccess",
        component: () =>
            import("../pages/employer/employer-dashboard/GetFullAccess.vue"),
        beforeEnter: [ifAuthenticated],
    },
    {
        path: "/update-profile",
        name: "UpdateProfileMeta",
        component: () =>
            import("../pages/profileSettings/UpdateProfileMeta.vue"),
        beforeEnter: [ifAuthenticated],
    },

    // **********************************************************************************************************\\

    // **************************************// RECURITER ROUTES \\***********************************************

    //************************************************************************************************************ */
    //Recruiter Login

    {
        path: "/recruiter-login",
        name: "RecruiterLogin",
        component: () => import("../pages/recruiter/Login/RecruiterLogin.vue"),
    },

    // Recruiter Employer Links
    {
        path: "/employers",
        name: "EmployersPage",
        component: () =>
            import("../pages/recruiter/recruiter-employers/EmployersPage.vue"),
        beforeEnter: [isRecuriterAuthenticated],
    },
    {
        path: "/employers/add",
        name: "AddEmployerPage",
        component: () =>
            import(
                "../pages/recruiter/recruiter-employers/AddEmployerPage.vue"
            ),
        beforeEnter: [isRecuriterAuthenticated],
    },
    {
        path: "/employers/profile/:id?",
        name: "DetailEmployerPage",
        component: () =>
            import(
                "../pages/recruiter/recruiter-employers/DetailEmployerPage.vue"
            ),
        beforeEnter: [isRecuriterAuthenticated],
    },
    {
        path: "/employers/reffer/:id?",
        name: "RefferEmployerPage",
        component: () =>
            import(
                "../pages/recruiter/recruiter-employers/RefferEmployerPage.vue"
            ),
        beforeEnter: [isRecuriterAuthenticated],
    },

    // Recruiter Talent Links
    {
        path: "/talents",
        name: "RecruiterTalentPage",
        component: () =>
            import("../pages/recruiter/recruiter-talent/TalentPage.vue"),
        beforeEnter: [isRecuriterAuthenticated],
    },
    {
        path: "/talents/profile/:id",
        name: "TalentDetail",
        component: () => import("../pages/talent/cvs/TalentDetail.vue"),
        beforeEnter: [isRecuriterAuthenticated],
    },
    {
        path: "/talents/add",
        name: "AddTalentPage",
        component: () =>
            import("../pages/recruiter/recruiter-talent/AddTalentPage.vue"),
        beforeEnter: [isRecuriterAuthenticated],
    },
    {
        path: "/talents/talent-detail/:id?",
        name: "DetailTalentPage",
        component: () =>
            import("../pages/recruiter/recruiter-talent/DetailTalentPage.vue"),
        beforeEnter: [isRecuriterAuthenticated],
    },
    {
        path: "/talents/reffer/:id?",
        name: "RefferTalentPage",
        component: () =>
            import("../pages/recruiter/recruiter-talent/RefferTalentPage.vue"),
        beforeEnter: [isRecuriterAuthenticated],
    },

    // Recruiter Match Links
    {
        path: "/match",
        name: "MatchPage",
        component: () =>
            import("../pages/recruiter/recruiter-match/MatchPage.vue"),
        beforeEnter: [isRecuriterAuthenticated],
    },
    {
        path: "/match-reffer",
        name: "MatchRefferPage",
        component: () =>
            import("../pages/recruiter/recruiter-match/MatchReffer.vue"),
        beforeEnter: [isRecuriterAuthenticated],
    },

    // Post Page Links
    {
        path: "/posts",
        name: "PostPage",
        component: () => import("../pages/recruiter/add-post/Post.vue"),
        beforeEnter: [isRecuriterAuthenticated],
    },

    // Manage Request Page
    {
        path: "/resume-request",
        name: "ResumeRequests",
        component: () =>
            import("../pages/recruiter/manage-request/ResumeRequests.vue"),
        beforeEnter: [isRecuriterAuthenticated],
    },
    {
        path: "/requests/interview",
        name: "InterviewRequests",
        component: () =>
            import("../pages/recruiter/manage-request/InterviewRequests.vue"),
        beforeEnter: [isRecuriterAuthenticated],
    },
    {
        path: "/requests/full-access",
        name: "FullAccessRequests",
        component: () =>
            import("../pages/recruiter/manage-request/FullAccessRequests.vue"),
        beforeEnter: [isRecuriterAuthenticated],
    },
    {
        path: "/skills/:id?",
        name: "WelcomeBack",
        component: () =>
            import("../pages/talent/talent-dashboard/PageWelcomeBack.vue"),
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
        path: "/talent/edit-culture",
        name: "EditCulture",
        component: () =>
            import("../pages/talent/skill/add/PageEditCulture.vue"),
    },
    {
        path: "/talent/edit-coworker",
        name: "EditCoworker",
        component: () =>
            import("../pages/talent/skill/add/PageEditCoWorker.vue"),
    },
    {
        path: "/talent/edit-hobbies",
        name: "EditHobbies",
        component: () =>
            import("../pages/talent/skill/add/PageEditHobbies.vue"),
    },

    // **********************************************************************************************************\\

    // **************************************// SUPER ADMIN ROUTES \\***********************************************

    //************************************************************************************************************ */
    {
        path: "/admin-login",
        name: "AdminLogin",
        component: () => import("../pages/super-admin/Login/AdminLogin.vue"),
    },
    {
        path: "/recruiters",
        name: "RecruiterPage",
        component: () =>
            import("../pages/super-admin/recruiter/RecruiterPage.vue"),
        beforeEnter: [isAdminAuthenticated],
    },
    {
        path: "/recruiters/add",
        name: "AddRecruiterPage",
        component: () =>
            import("../pages/super-admin/recruiter/AddRecruiter.vue"),
        beforeEnter: [isAdminAuthenticated],
    },
    {
        path: "/recruiters/profile/:id?",
        name: "DetailRecruiterPage",
        component: () =>
            import("../pages/super-admin/recruiter/DetailRecruiterPage.vue"),
        beforeEnter: [isAdminAuthenticated],
    },
    {
        path: "/recruiters/refers/:id?",
        name: "RefferRecruiterPage",
        component: () =>
            import("../pages/super-admin/recruiter/RefferRecruiterPage.vue"),
        beforeEnter: [isAdminAuthenticated],
    },
    // {
    //     path: "/super-admin-recruiters",
    //     name: "Recruiters",
    //     component: () => import("../pages/super-admin/Recruiters.vue"),
    // },
    {
        path: "/talents/:id",
        name: "TalentDetail",
        component: () => import("../pages/talent/cvs/TalentDetail.vue"),
    },

    {
        path: "/employers/job-detail/:id",
        name: "positionDetail",
        component: () => import("../components/Cvs/PaidEmployerCv.vue"),
    },
    { path: "/404", name: "PageNotFound", component: PageNotFound },
    {
        path: "/:catchAll(.*)", // Unrecognized path automatically matches 404
        redirect: "/404",
    },
];

const router = createRouter({
    history: createWebHistory("/new/chirrrp-backend/"),
    // history: createWebHistory("/chirrrp-backend/"),
    routes,
    linkActiveClass: "active",
    scrollBehavior(to, from, savedPosition) {
        if (savedPosition) {
          return savedPosition
        } else {
          return { top: 0 }
        }
    },
});

export default router;
