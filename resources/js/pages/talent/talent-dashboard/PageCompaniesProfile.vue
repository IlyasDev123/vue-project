<template>

    <div class="we__working__on_it d__flex d__flex-v-center" v-show="companies.length == 0">
        <div class="working__mainWrapper">
            <div class="img__wrapper text__center">
                <img src="../../../assets/images/talent-images/working__Man.png" alt="workingMan">
            </div>
            <h1 class="text__center fw__700">We’re working on it!</h1>
            <p class="text__center">
                Our Chirrrp Matching System is
                analyzing companies that match your search. Don't worry, this typically only takes
                24 hours to update with fresh new
                companies for you to review
            </p>
        </div>
    </div>

    <div v-for="company in companies" :key="company" v-show ="companies">
        <CompaniesProfileCard
            :company="company"
            @passEvent="getAppliedJobList"
        />
    </div>
</template>
<script>
import CompaniesProfileCard from "@/components/CompaniesProfieCard.vue";
import talentService from "../../../Services/talentService";
export default {
    name: "PageCompaniesProfile",
    components: {
        CompaniesProfileCard,
    },
    data() {
        return {
            companies: [],
        };
    },
    created() {
        this.getAppliedJobList();
    },
    methods: {
        getAppliedJobList() {
            talentService.getAppliedJobList().then((data) => {
                if (data.data.status != true) {
                    this.$toast.error(data.message);
                } else {
                    console.log("companies list", data.data.data);
                    this.companies = data.data.data.data;
                    // this.$toast.success("Jobs fetched Successfully");
                }
            });
        },
    },
};
</script>
