<template>
    <div class="reffer__members-box">
        <div class="avatar__upload m__auto">
            <div class="avatar__preview">
                <div
                    id="imagePreview"
                    :style="{
                        backgroundImage:
                            'url(' +
                            $public +
                            '' +
                            referedTalents?.employer?.avatar +
                            ')',
                    }"
                ></div>
            </div>
        </div>
        <h3>
            {{ referedTalents?.employer?.first_name }}{{ " "
            }}{{ referedTalents?.employer?.last_name }}
        </h3>

        <span>{{ referedTalents?.employer?.company_meta?.company_name }}</span>
        <SearchBox :user="this.user" @searchValue="getReferedTalents" />
    </div>

    <div class="refer__post">
        <template
            v-for="referedTalent in referedTalents?.user"
            :key="referedTalent"
        >
            <CardList
                :referedTalent="referedTalent"
                :cvType="this.$constants.TALENT"
                routeName="TalentDetail"
                routeTitle="View Profile"
                :routeId="referedTalent.id"
            />
        </template>
        <div class="refer__post-btn">
            <router-link
                :to="{
                    name: 'DetailEmployerPage',
                    params: { id: referedTalents?.employer?.id },
                }"
                class="refer__post-btn-back"
            >
                <svg
                    width="10"
                    height="10"
                    viewBox="0 0 10 10"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M2.56635 5.58328L5.69535 8.71228L4.87052 9.53711L0.333355 4.99994L4.87052 0.462776L5.69536 1.28761L2.56635 4.41661L9.66669 4.41661L9.66669 5.58328L2.56635 5.58328Z"
                        fill="#304254"
                    />
                </svg>
                <span>Go Back</span>
            </router-link>
        </div>
    </div>
</template>

<script>
import CardList from "../../../components/Cards/Listing.vue";
import SearchBox from "@/components/SearchBox.vue";
import userService from "../../../Services/userService";

export default {
    components: {
        CardList,
        SearchBox,
    },
    data() {
        return {
            isSearched: false,
            searchedTalent: [],
            referedTalents: [],
            user: {
                userType: "",
            },
        };
    },
    mounted() {
        this.getReferedTalents();
    },
    methods: {
        async getReferedTalents(value) {
            let name = value == undefined ? null : value;
            let data = {
                searchItem: name,
                id: this.$route.params.id,
            };
            const response = await userService
                .getReferedTalents(data)
                .catch((error) => {
                    console.log(error);
                    // return this.$toast.error('Something went wrong, please try again later.');
                });
            this.referedTalents = response.data.data;
            console.log("refered", this.referedTalents);
        },
    },
};
</script>

<style lang="scss" scoped></style>
