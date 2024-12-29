<template>
    <div class="customizedProfile__main customized__InDashboard">
        <div class="profile__img">
            <img :src="this.$public + 'clip__board.png'" alt="" />
        </div>
        <div class="image__Para">
            <p class="text__center mb__25">
                <b>
                    {{ jobDetail.company?.company_meta?.company_name }}{{ ", "
                    }}{{ jobDetail.company?.company_meta?.current_role }}
                </b>
            </p>
            <p>
                Chirrrp! My name is
                <b>{{
                    jobDetail.company?.first_name +
                    " " +
                    jobDetail.company?.last_name
                }}</b>
                and I'd love to be considered for your open
                <b>ROLE</b> position. I have <b>YRS</b> of relevant experience
                as a Role and I think I could be a good match for your team!
            </p>
            <p>
                Choosing a new employer is a big step for me, so I'd like to
                make sure you know a little more about me before we match!
            </p>
            <p>
                In my current role, I'm often described by my colleagues as
                <b>Colleagues &amp; Colleagues</b>. I'm looking for the next
                step in my career and an important deciding factor for me is
                Important. In my free time I enjoy <b>Hobbies</b> as well as
                <b>Hobbies!</b>
            </p>
            <p class="mb__25">
                I'm currently located in <b>State</b> and myy ideal salary range
                is Salary
            </p>
            <p class="text__center">
                <b>Let's see if we're a Chirrrp match!</b>
            </p>
            <p class="text__center">
                <b
                    >Thanks,
                    {{
                        jobDetail.company?.first_name +
                        " " +
                        jobDetail.company?.last_name
                    }}
                </b>
            </p>
        </div>
    </div>
</template>
<script>
import TalentService from "@/Services/talentService";
export default {
    name: "UnpaidEmployerCv",
    props: {
        positionId: Number,
        jobDetail: Object,
    },
    // mounted() {
    //     if (this.$route.params.id !== undefined) {
    //         this.getJobDetail(this.$route.params.id);
    //     }
    // },
    // data() {
    //     return {
    //         jobDetail: this.$route.params.id == undefined ? this.jobDetail : {},
    //     };
    // },

    // methods: {
    //     async getJobDetail(id) {
    //         let response = await TalentService.getAppliedJobDetail(id).catch(
    //             (error) => {
    //                 return this.$toast.error(error.response.data.message);
    //             }
    //         );

    //         this.jobDetail = response.data.data;
    //     },
    // },
};
</script>
<style lang="scss" scoped></style>
