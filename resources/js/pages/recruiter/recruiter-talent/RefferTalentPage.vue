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
                            referedCompany?.talent?.avatar +
                            ')',
                    }"
                ></div>
            </div>
        </div>
        <h3>
            {{ referedCompany?.talent?.first_name }}{{ " "
            }}{{ referedCompany?.talent?.last_name }}
        </h3>
        <span>{{ referedCompany?.talent?.skills?.profession?.name }}</span>

        <SearchBox :user="this.user" @searchValue="getReferedCompany" />
    </div>
    <!-- {{ this.referedCompany.position }} -->
    <div class="refer__post">
        <template v-for="company in referedCompany.position" :key="company.id">
            <!-- {{ company }} -->
            <CardList
                :company="company"
                :cvType="this.$constants.EMPLOYER"
                routeName="positionDetail"
                routeTitle="Position"
                :routeId="company.id"
            />
        </template>

        <div class="refer__post-btn">
            <router-link
                :to="{
                    name: 'DetailTalentPage',
                    params: { id: this.$route.params.id },
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
import userService from "../../../Services/userService";
import SearchBox from "@/components/SearchBox.vue";

export default {
    components: {
        CardList,
        SearchBox,
    },
    data() {
        return {
            isSearched: false,
            searchedCompany: [],
            referedCompany: [],
            companies: [],
        };
    },

    mounted() {
        this.getReferedCompany();
    },
    methods: {
        async getReferedCompany(value) {
            let name = value == undefined ? null : value;
            let data = {
                searchItem: name,
                id: this.$route.params.id,
            };
            let response = await userService
                .getReferedCompany(data)
                .catch((error) => {
                    return this.$toast.error(error.response.data.message);
                });
            this.referedCompany = response.data.data;
        },

        // searchReferedCompany(value) {
        //     let data = {
        //         name: value,
        //         id: this.$route.params.id,
        //     };
        //     userService
        //         .searchReferedCompany(data)
        //         .then((data) => {
        //             this.searchedCompany = data;
        //             this.referedCompany = data.data.data;
        //             this.isSearched = true;
        //             console.log("searchedCompany", this.referedCompany);
        //         })
        //         .catch((error) => {
        //             console.log(error);
        //             return this.$toast.error(error);
        //         });
        // },
    },
};
</script>

<style lang="scss" scoped></style>
