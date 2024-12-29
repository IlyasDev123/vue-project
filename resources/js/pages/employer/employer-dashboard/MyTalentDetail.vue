<template>
    <div v-if="authUserStatus == 2">
        <ComapnyCustomizeProfile :data="this.talent" />
    </div>
    <div v-else="authUserStatus">
        <UnpaidTalentCv :talent="this.talent" />
    </div>
    <div class="two__btns_wrapper">
        <button
            @click="sendInterviewRequest"
            class="blue__bg-btn under__buttons"
        >
            Request an Interview
        </button>
        <button @click="passPortfolio" class="red__btnOutline under__buttons">
            No Longer Interested
        </button>
    </div>
</template>
<script>
import ComapnyCustomizeProfile from "@/components/CompanyCustomizeProfile.vue";
import UnpaidTalentCv from "../../../components/Cvs/UnpaidTalentCv.vue";
import companyService from "../../../Services/companyService";
import userService from "../../../Services/userService";
export default {
    name: "MyTalentDetail",
    components: {
        ComapnyCustomizeProfile,
        UnpaidTalentCv,
    },
    data() {
        return {
            authUserStatus: "",
            talent: [],
            data: {
                position_id: "",
                talent_id: "",
                matchId: ""
            },
            id: "",
            interviewData: {
                // interview_start_date_time: null,
                // interview_end_date_time: null,
                company_user_match_id: "",
                talent_name: "",
                recruiter_id: "",
            },
        };
    },
    created() {
        this.getProfile();
        this.getTalentDetails();
    },
    methods: {
        getProfile() {
            userService
                .getProfile()
                .then((data) => {
                    if (data.data.status == true) {
                        this.authUserStatus =
                            data.data.data.company_meta.premium_status;
                    }
                })
                .catch((error) => {
                    this.$toast.error(error);
                });
        },
        getTalentDetails() {
            let data = this.$route.params.id;
            companyService.getTalent(data).then((data) => {
                if (data.data.status != true) {
                    this.$toast.error(data.message);
                } else {
                    this.talent = data.data.data;
                    this.interviewData.talent_name = this.talent.first_name;
                    this.interviewData.company_user_match_id =
                        this.talent.matches.id;
                    this.interviewData.recruiter_id = this.talent.recruiter_id;
                    this.id = this.talent.matches.id;
                    this.data.talent_id = this.talent.id;
                    this.data.matchId = this.talent.matches.id;
                    this.data.position_id = this.talent.matches.position_id;
                    console.log("my-talent-data", this.talent);
                }
            });
        },
        passPortfolio() {
            companyService.passPortfolio(this.data).then((data) => {
                if (data.data.status != true) {
                    this.$toast.error(data.message);
                } else {
                    this.$toast.success("Profile Passed");
                    this.$router.push({
                        name : 'MyTalent'
                    });
                }
            });
        },
        sendInterviewRequest() {
            companyService
                .sendInterviewRequest(this.interviewData)
                .then((data) => {
                    if (data.data.status != true) {
                        this.$toast.error(data.message);
                    } else {
                        this.$toast.success("Interview Request Sent");
                        this.$router.push({
                            name : 'MyTalent'
                        });
                    }
                });
        },
    },
};
</script>
<style scoped>
.under__buttons {
    padding: 12px 42px;
    border-radius: 5px;
    font-family: roboto;
    font-size: 16px;
    line-height: 20px;
    text-align: center;
    display: inline-block;
    background: none;
    border: none;
    transition: all 0.4s ease;
}
.red__btnOutline {
    border: 1px solid #e75c2a;
    color: #e75c2a;
}
.red__btnOutline:hover {
    background: #e75c2a;
    color: #fff;
}
.blue__bg-btn {
    color: #fff;
    border: 1px solid #4294ff;
    background: #4294ff;
}
.blue__bg-btn:hover {
    background-color: transparent;
    color: #4294ff;
}
.two__btns_wrapper {
    text-align: center;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
    margin-top: 20px;
}
</style>
