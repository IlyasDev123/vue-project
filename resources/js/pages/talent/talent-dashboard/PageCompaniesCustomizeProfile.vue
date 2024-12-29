<template>
    <ComapnyCustomizeProfile :jobDetail="jobDetail" />
</template>
<script>
import talentService from "../../../Services/talentService";
import ComapnyCustomizeProfile from "@/components/CompanyCustomizeProfile.vue";
export default {
    name: "PageCompaniesProfile",
    components: {
        ComapnyCustomizeProfile,
    },
    data() {
        return {
            id: "",
            jobDetail: {},
        };
    },
    created() {
        this.id = this.$route.params.id;
        this.getJobDetail();
    },
    methods: {
        getJobDetail() {
            talentService
                .getAppliedJobDetail(this.$route.params.id)
                .then((data) => {
                    if (data.data.status != true) {
                        this.$toast.error(data.data.message);
                    } else {
                        console.log("applied job detail:", data.data.data);
                        this.jobDetail = data.data.data;
                    }
                });
        },
    },
};
</script>
