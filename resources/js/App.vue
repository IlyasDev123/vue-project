<template>
    <div
        v-if="
            ['Login'].includes($route.name) ||
            ['RecruiterLogin'].includes($route.name) ||
            ['AdminLogin'].includes($route.name) ||
            ['ForgetPassword'].includes($route.name)
        "
    >
        <router-view></router-view>
    </div>
    <div
        v-else-if="
            ['UserRegisterPage'].includes($route.name) ||
            ['SelectRolePage'].includes($route.name) ||
            ['GetIN'].includes($route.name) ||
            ['SelectIndustry'].includes($route.name) ||
            ['Profession'].includes($route.name) ||
            ['ProfileCrafting'].includes($route.name) ||
            ['AllmostDone'].includes($route.name) ||
            ['ImportantThings'].includes($route.name) ||
            ['HearAboutUs'].includes($route.name) ||
            ['CustomizeProfile'].includes($route.name) ||
            ['Thanks'].includes($route.name) ||
            ['COWorkers'].includes($route.name) ||
            ['Hobbies'].includes($route.name) ||
            ['LastQuestion'].includes($route.name) ||
            ['ManagementStyle', 'LoveAboutWork'].includes($route.name)
        "
    >
        <router-view></router-view>
    </div>

    <div class="main__screen" v-if="isUser == true">
        <div class="site__container">
            <div class="d__flex full__height">
                <SideBar
                    :recruiterMenuItems="recruiterMenuItems"
                    :talentMenuItems="talentMenuItems"
                    :employerMenuItems="employerMenuItems"
                    :superAdminMenuItems="superAdminMenuItems"
                />
                <div class="main__content">
                    <TopBar :isStatus="isLongerInterested" />

                    <div
                        v-if="
                            [
                                'DetailEmployerPage',
                                'DetailTalentPage',
                                'DetailRecruiterPage',
                            ].includes($route.name)
                        "
                        class="main__content-box d__flex d__flex-h-center"
                    >
                        <router-view></router-view>
                    </div>
                    <div
                        v-else-if="
                            [
                                'RefferEmployerPage',
                                'RefferTalentPage',
                                'RefferRecruiterPage',
                                'Recruiters',
                                'MatchRefferPage',
                            ].includes($route.name)
                        "
                        class="main__content-box reffer__member"
                    >
                        <router-view></router-view>
                    </div>
                    <div
                        v-else-if="['MatchPage'].includes($route.name)"
                        class="matches__content"
                    >
                        <router-view></router-view>
                    </div>
                    <div
                        v-else-if="
                            ['PostPage', 'GoodRead'].includes($route.name)
                        "
                        class="main__content-box post__section"
                    >
                        <router-view></router-view>
                    </div>
                    <!-- ============= reffer talent section ========= -->
                    <!-- CompaniesProfile -->
                    <div
                        v-else-if="
                            ['CompaniesProfile', 'MyTalent'].includes(
                                $route.name
                            )
                        "
                        class="main__content-box reffer__member reffer__MemberNOBG"
                    >
                        <router-view></router-view>
                    </div>
                    <!-- ========= edn reffer talent secc ======== -->
                    <!-- ======== add new skill ===== -->
                    <div
                        v-else-if="
                            [
                                'AddNewSKill',
                                'AddNewSKillRole',
                                'AllSet',
                            ].includes($route.name)
                        "
                    >
                        <router-view></router-view>
                    </div>
                    <div
                        v-else-if="['ProfileSettings'].includes($route.name)"
                        class="main__content-box reffer__member"
                    >
                        <router-view></router-view>
                    </div>
                    <!-- ============= reffer talent section ========= -->
                    <div
                        v-else-if="
                            ['CompaniesCustomizeProfile'].includes($route.name)
                        "
                        class="main__content-box transparent__BG DAB__CLIPWrapper"
                    >
                        <router-view></router-view>
                    </div>
                    <!-- ========= edn reffer talent secc ======== -->
                    <template
                        v-else-if="
                            [
                                'ResumeRequests',
                                'InterviewRequests',
                                'FullAccessRequests',
                            ].includes($route.name)
                        "
                    >
                        <RequestTab />
                        <div class="main__content-box manage__post">
                            <router-view></router-view>
                        </div>
                    </template>
                    <template
                        v-else-if="['AlmostExperience'].includes($route.name)"
                    >
                        <div
                            class="main__content-box transparent__BG min__100vh"
                        >
                            <router-view></router-view>
                        </div>
                    </template>
                    <template
                        v-else-if="
                            [
                                'NewJobMatch',
                                'WelcomeBack',
                                'NewTalentMatch',
                                'GetFullAccess',
                            ].includes($route.name)
                        "
                    >
                        <div class="main__content-box transparent__BG get-full-access">
                            <router-view></router-view>
                        </div>
                    </template>
                    <template
                        v-else-if="
                            [
                                'NewJobMatch',
                                'EmployerBack',
                                'EmployerSelectIndustry',
                                'EmployerSelectNewRole',
                                'EmployerAdditionalSalary',
                                'EmployerAllSet',
                                'EmployerEditProfile',
                                'EmployerAlmostDone',
                                'EmployerSchedualing',
                                'EmployerCompaniesProfile',
                                'EmployerCompaniesProfileCV',
                                'EmployerManagementStyle',
                            ].includes($route.name)
                        "
                    >
                        <div class="main__content-box update-bg-color">
                            <router-view></router-view>
                        </div>
                    </template>
                    <template
                        v-else-if="['RoleIndustry'].includes($route.name)"
                    >
                        <div class="main__content-box transparent__BG">
                            <router-view></router-view>
                        </div>
                    </template>
                    <template
                        v-else-if="
                            [
                                'EditExperience',
                                'EditCulture',
                                'EditCoworker',
                                'EditHobbies',
                                'EditProfile',
                                'UpdateProfileMeta'
                            ].includes($route.name)
                        "
                    >
                        <div class="main__content-box transparent__BG experience">
                            <router-view></router-view>
                        </div>
                    </template>

                    <div v-else class="main__content-box">
                        <router-view></router-view>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import SideBar from "./components/Layouts/SideBar.vue";
import TopBar from "./components/Layouts/TopBar.vue";
import RequestTab from "./components/RequestTab.vue";
import Auth from "./auth";
import { mapMutations, mapState, mapActions } from "vuex";

export default {
    name: "App",
    components: {
        SideBar,
        TopBar,
        RequestTab,
    },
    created() {
        this.isUser = Auth.user != null ? true : false;
        if (this.isUser == true) {
            this.getMetaData();
        }
    },
    data() {
        return {
            isUser: false,

            talentMenuItems: [
                // Talent RounteLinks
                {
                    title: "New Job Matches",
                    src: "1talent.svg",
                    routeName: "NewJobMatch",
                    path: "/new-job-match",
                },
                {
                    title: "My Companies",
                    src: "2talent.svg",
                    routeName: "CompaniesProfile",
                    path: "/companies",
                },
                {
                    title: "Add New Skill",
                    src: "3talent.svg",
                    routeName: "WelcomeBack",
                    path: "/skills",
                },
                {
                    title: "Edit Profile",
                    src: "4talent.svg",
                    routeName: "EditProfile",
                    path: "/edit-profile",
                },
                {
                    title: "Good Reads",
                    src: "5talent.svg",
                    routeName: "GoodRead",
                    path: "/good-read",
                },
            ],
            employerMenuItems: [
                // Talent RounteLinks
                {
                    title: "New Matches",
                    src: "1talent.svg",
                    routeName: "NewTalentMatch",
                    path: "/newMatch",
                },
                {
                    title: "My Talent",
                    src: "2talent.svg",
                    routeName: "MyTalent",
                    path: "/talent",
                },
                {
                    title: "Add New Position",
                    src: "3talent.svg",
                    routeName: "EmployerBack",
                    path: "/position/add",
                },
                {
                    title: "Edit Profile",
                    src: "4talent.svg",
                    routeName: "UpdateProfileMeta",
                    path: "/update-profile",
                },

                {
                    title: "Good Reads",
                    src: "5talent.svg",
                    routeName: "GoodRead",
                    path: "/good-reading",
                },
                {
                    title: "Get Full Access",
                    src: "6talent.svg",
                    routeName: "GetFullAccess",
                    path: "/get-full-access",
                },
            ],

            recruiterMenuItems: [
                {
                    title: "Employers",
                    src: "1.employers.svg",
                    routeName: "EmployersPage",
                    path: "/employers",
                },
                {
                    title: "Talent",
                    src: "2.talent.svg",
                    routeName: "RecruiterTalentPage",
                    path: "/talents",
                },
                {
                    title: "Match",
                    src: "4.matches.svg",
                    routeName: "MatchPage",
                    path: "/match",
                },
                {
                    title: "Add Post",
                    src: "5.add-post.svg",
                    routeName: "PostPage",
                    path: "/post",
                },
                {
                    title: "Manage Requests",
                    src: "6.manage-request.svg",
                    routeName: "InterviewRequests",
                    path: "/requests",
                },
            ],

            superAdminMenuItems: [
                {
                    title: "Employers",
                    src: "1.employers.svg",
                    routeName: "EmployersPage",
                    path: "/employers",
                },
                {
                    title: "Talent",
                    src: "2.talent.svg",
                    routeName: "RecruiterTalentPage",
                    path: "/talents",
                },
                {
                    title: "Recruiters",
                    src: "3.recruiters.svg",
                    routeName: "RecruiterPage",
                    path: "/recruiters",
                },
                {
                    title: "Match",
                    src: "4.matches.svg",
                    routeName: "MatchPage",
                    path: "/match",
                },
                {
                    title: "Add Post",
                    src: "5.add-post.svg",
                    routeName: "PostPage",
                    path: "/post",
                },
                {
                    title: "Manage Requests",
                    src: "6.manage-request.svg",
                    routeName: "InterviewRequests",
                    path: "/requests",
                },
            ],
        };
    },
    computed: {
        isLongerInterested() {
            return (this.status =
                this.$store.state.auth.user.is_longer_interested);
        },
    },
    methods: {
        ...mapActions("chirrrpMeta", {
            getMetaData: "getMetaData",
        }),
    },
};
</script>
<style>
.main__content-box.transparent__BG {
    background: none !important;
    overflow: hidden;
    /* margin-top: 5px; */
}
.experience,.get-full-access{
 overflow-y:auto!important;
}

.big__blue__btn {
    max-width: 230px;
    width: 100%;
    padding: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    color: #fff;
    /* background-color: #578bff; */
    background-color: #4294ff;
    border-radius: 5px;
    border: 2px solid #4294ff;
    transition: all 0.4s ease;
    font-family: roboto;
    margin: 20px auto 0;
}
.big__blue__btn:hover {
    background: none;
    color: #4294ff;
}
.error_message {
    color: rgba(255, 0, 0, 0.903);
    margin: 3px;
}

.crafting__form form fieldset[data-behaviour="toggle"] {
    border-bottom: 0px solid rgba(0, 0, 0, 0.4);
    cursor: pointer;
}
 .fieldset__Salary {
  border-bottom:none!important;
}
</style>
