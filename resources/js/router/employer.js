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

const employer =[
      // Employers Dashboard Link
      {
        path: "/employer/getin",
        name: "EmployerGetIN",
        component: () =>
            import("../pages/employer/employerRegister"),
    },
    {
        path: "/employer/select-industry",
        name: "EmployerSelectIndustry",
        component: () =>
            import("../pages/employer/employerRegister/SelectRolePage.vue"),
    },
    {
        path: "/employer/profession",
        name: "EmployerProfession",
        component: () =>
            import("../pages/employer/employerRegister/SelectRolePage.vue"),
    },
    {
        path: "/employer/profile-crafting",
        name: "EmployerProfileCrafting",
        component: () =>
            import("../pages/employer/employerRegister/SelectRolePage.vue"),
    },

    {
        path: "/employer/management-style",
        name: "EmployerManagementStyle",
        component: () =>
            import("../pages/employer/employerRegister/SelectRolePage.vue"),
    },
    {
        path: "/employer/important-things",
        name: "ImportantThings",
        component: () =>
            import("../pages/employer/employerRegister/SelectRolePage.vue"),
        // beforeEnter: [ifAuthenticated],
    },
    {
        path: "/employer/co-workers",
        name: "COWorkers",
        component: () =>
            import("../pages/employer/employerRegister/SelectRolePage.vue"),
        // beforeEnter: [ifAuthenticated],
    },
    {
        path: "/employer/last-question",
        name: "EmployerLastQuestion",
        component: () =>
            import("../pages/employer/employerRegister/SelectRolePage.vue"),
        // beforeEnter: [ifAuthenticated],
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

    {
        path: "/employer/new-talent-match",
        name: "NewTalentMatch",
        component: () =>
            import("../pages/employer/employer-dashboard/TalentMatch.vue"),
        beforeEnter: [ifAuthenticated],
    },
    {
        path: "/employer/my-talent",
        name: "MyTalent",
        component: () =>
            import("../pages/employer/employer-dashboard/MyTalent.vue"),
    },
    {
        path: "/employer/welcome-back",
        name: "EmployerBack",
        component: () =>
            import("../pages/employer/employer-dashboard/PageWelcomeBack.vue"),
    },
    {
        path: "/employer/select-industry",
        name: "EmployerSelectIndustry",
        component: () =>
            import("../pages/employer/employer-dashboard/PageRoleIndustry.vue"),
    },
    {
        path: "/employer/select-new-role",
        name: "EmployerSelectNewRole",
        component: () =>
            import(
                "../pages/employer/employer-dashboard/PageSelectNewRole.vue"
            ),
    },
    {
        path: "/employer/additional-salary",
        name: "EmployerAdditionalSalary",
        component: () =>
            import("../pages/employer/employer-dashboard/AdditionalSalary.vue"),
    },
    {
        path: "/employer/all-set",
        name: "EmployerAllSet",
        component: () =>
            import("../pages/employer/employer-dashboard/PageAllSet.vue"),
    },
    {
        path: "/employer/edit-profile",
        name: "EmployerEditProfile",
        component: () =>
            import(
                "../pages/employer/employer-dashboard/PageDashboardEditProfile.vue"
            ),
    },
    {
        path: "/employer/almost-done",
        name: "EmployerAlmostDone",
        component: () =>
            import(
                "../pages/employer/employer-dashboard/PageAlmostEditProfile.vue"
            ),
    },
    {
        path: "/employer/management-style",
        name: "EmployerManagementStyle",
        component: () =>
            import(
                "../pages/employer/employer-dashboard/PageManagmentSTyle.vue"
            ),
    },
    {
        path: "/employer/schedualing",
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
    },
    {
        path: "/employer/companies-profile-cv",
        name: "EmployerCompaniesProfileCV",
        component: () =>
            import("../pages/talent/talent-dashboard/PageEmployerCVBlock.vue"),
    },
    {
        path: "/get-full-access",
        name: "GetFullAccess",
        component: () =>
            import("../pages/employer/employer-dashboard/GetFullAccess.vue"),
    },
]

export default employer;