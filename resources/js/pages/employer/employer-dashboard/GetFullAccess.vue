<script>
import companyService from "../../../Services/companyService";
import userService from "../../../Services/userService";
// import { mapState } from "vuex";

export default {
    name: "GetFullAccess",
    data() {
        return {
            profile: [],
            status: "",
            isPremiumStatus: false,
            isPendingStatus: false,
        };
    },

    created() {
        this.getUserProfile();
    },
    // computed: {
    //     ...mapState("auth", {
    //         profileData: (state) => state.userMeta,
    //     }),
    // },
    methods: {
        getUserProfile() {
            userService
                .getProfile()
                .then((data) => {
                    this.profile = data.data.data;
                    this.status = this.profile.company_meta.premium_status;

                    if (this.status == 2) {
                        this.isPremiumStatus = true;
                    } else if (this.status == 3) {
                        this.isPendingStatus = true;
                    }
                })
                .catch((error) => {
                    this.$toast.error(error);
                });
        },
        getFullAccess() {
            companyService.getFullAccess().then((data) => {
                if (data.data.status != true) {
                    this.$toast.error(data.data.message);
                } else {
                    console.log("full-access", data.data);
                    this.status = data.data.data.company_meta.premium_status;
                    if (this.status == 2) {
                        this.isPremiumStatus = true;
                    } else if (this.status == 3) {
                        this.isPendingStatus = true;
                    }
                    this.$toast.success(data.data.message);
                }
            });
        },
    },
};
</script>
<template>
     <div class="">
    <div class="we__working__on_it d__flex d__flex-v-center ">
       
        <div
            v-if="!this.isPremiumStatus && !this.isPendingStatus"
            class="working__mainWrapper"
            style="max-width: 779px"
        >
            <div class="img__wrapper text__center">
                <img src="@/assets/img/access-img.png" alt="shaking__hand" />
            </div>
            <h1 class="text__center fw__700" style="font-size: 28px">
                Thanks for signing up for Chirrrp!
            </h1>

            <p class="text__center">
                The most personalized way to find your perfect hire. Get
                comfortable! We built this platform from the ground up to shake
                up the industry in a refreshing way. We pride our platform on
                making everything we have to offer budget friendly, efficient
                and stress-free. With full Chirrrp access you get access to
                hundreds of targeted full resumes of job-seekers
            </p>
            <a @click="getFullAccess" class="full-access big__blue__btn"
                >Get Full Access
            </a>
        </div>
        <div
            v-else-if="this.isPremiumStatus"
            class="working__mainWrapper"
            style="max-width: 717px"
        >
            <div class="img__wrapper text__center">
                <img src="@/assets/img/access-img.png" alt="shaking__hand" />
            </div>
            <h1 class="text__center fw__700" style="font-size: 28px">
                Hurrah! You have full Access
            </h1>

            <p class="text__center">
                Phasellus tempor massa mi, ac tincidunt lacus dictum in. Sed nec
                erat lobortis, condimentum leo nec, condimentum mi. Maecenas ac
                nisl at dolor ornare pulvinar vitae id augue.
            </p>
        </div>
        <div
            v-else-if="this.isPendingStatus"
            class="working__mainWrapper"
            style="max-width: 581px"
        >
            <div class="img__wrapper text__center">
                <img
                    :src=" this.$public + 'request-get-access.png'"
                    alt="shaking__hand"
                />
            </div>
            <h1 class="text__center fw__700" style="font-size: 28px">
                Request Pending
            </h1>

            <p class="text__center">
                Your full access request is received. you will be notified once
                its approved.
            </p>
        </div>
    </div>
</div>
</template>

<style scoped>
.full-access {
    cursor: pointer;
}
/* .we__working__on_it {
    overflow: hidden;
} */
.we__working__on_it{
    
    overflow-y:auto;
    /* position: relative;
    top: 50%;
    transform: translateY(-50%); */
}
.we__working__on_it .working__mainWrapper{
    padding: 40px 107px 50px;
}
.main__content-box.transparent__BG{
    overflow: unset!important;
}
@media (max-width:991px){
    .we__working__on_it{
        top: unset;
    transform: translateY(-0%);
    }
}
@media (max-width: 640px){
    .we__working__on_it .working__mainWrapper {
    padding: 40px 20px;
}
}


</style>
