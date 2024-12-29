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


const talents =[
  
 // Talent Register Dashboard Link
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
    beforeEnter: [ifAuthenticated],
},
{
    path: "/companies-profile",
    name: "CompaniesProfile",
    component: () =>
        import("../pages/talent/talent-dashboard/PageCompaniesProfile.vue"),
},
{
    path: "/companies-customize-profile",
    name: "CompaniesCustomizeProfile",
    component: () =>
        import(
            "../pages/talent/talent-dashboard/PageCompaniesCustomizeProfile.vue"
        ),
},
{
    path: "/add-new-skill-role",
    name: "AddNewSKillRole",
    component: () =>
        import("../pages/talent/talent-dashboard/PageSelectNewRole.vue"),
},
{
    path: "/all-set",
    name: "AllSet",
    component: () =>
        import("../pages/talent/talent-dashboard/PageAllSet.vue"),
},
{
    path: "/edit-profile",
    name: "EditProfile",
    component: () =>
        import(
            "../pages/talent/talent-dashboard/PageDashboardEditProfile.vue"
        ),
},
{
    path: "/profile-settings",
    name: "ProfileSettings",
    component: () =>
        import("../pages/talent/talent-dashboard/PageProfileSettings.vue"),
},
{
    path: "/add-new-skill",
    name: "AddNewSKill",
    component: () =>
        import("../pages/talent/talent-dashboard/PageAddNewSKill.vue"),
},
{
    path: "/role-industry",
    name: "RoleIndustry",
    component: () =>
        import("../pages/talent/talent-dashboard/PageRoleIndustry.vue"),
},
{
    path: "/good-read",
    name: "GoodRead",
    component: () =>
        import("../pages/talent/talent-dashboard/GoodRead.vue"),
},
]

export default talents;