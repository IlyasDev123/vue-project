<template>
    <div v-if="this.type == 2" class="cv__block">
        <div class="cv__block-container">
            <div class="cv__block-content">
                <div class="cv__block-header">
                    <h2>
                        {{ data?.first_name }} <br />
                        {{ data?.last_name }}
                    </h2>
                    <template v-for="skill in data.skills" :key="skill">
                        <p>{{ skill?.profession?.name }}</p>
                    </template>
                </div>
                <div class="cv__block-body">
                    <div class="cv__block-item">
                        <h3 class="cv__block-heading">Education</h3>
                        <div class="cv__block-info">
                            <h4 class="cv__block-sub-heading">Lorem Ipsum</h4>
                            <p>
                                <b>School Name.</b> Lorem ipsum dolor sit amet
                                consectetur adipisicing elit. Placeat vero qui
                                cupiditate perspiciatis exercitationem?
                                Molestias minus expedita
                            </p>
                        </div>
                        <div class="cv__block-info">
                            <h4 class="cv__block-sub-heading">Lorem Ipsum</h4>
                            <p>
                                <b>School Name.</b> Lorem ipsum dolor sit amet
                                consectetur adipisicing elit. Placeat vero qui
                                cupiditate perspiciatis exercitationem?
                                Molestias minus expedita
                            </p>
                        </div>
                    </div>
                    <div class="cv__block-item">
                        <h3 class="cv__block-heading">Work Experience</h3>
                        <div class="cv__block-info">
                            <h4 class="cv__block-sub-heading">Lorem Ipsum</h4>
                            <p>
                                <b>School Name.</b> Lorem ipsum dolor sit amet
                                consectetur adipisicing elit. Placeat vero qui
                                cupiditate perspiciatis exercitationem?
                                Molestias minus expedita
                            </p>
                        </div>
                        <div class="cv__block-info">
                            <h4 class="cv__block-sub-heading">Lorem Ipsum</h4>
                            <p>
                                <b>School Name.</b> Lorem ipsum dolor sit amet
                                consectetur adipisicing elit. Placeat vero qui
                                cupiditate perspiciatis exercitationem?
                                Molestias minus expedita
                            </p>
                        </div>
                    </div>
                    <div class="cv__block-item">
                        <h3 class="cv__block-heading">Contact</h3>
                        <ul class="cv__block-list">
                            <li>Year, Month/Day</li>
                            <li>Your City,Country</li>
                            <li>{{ data.phone_no }}</li>
                            <li>{{ data.email }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div
        v-else-if="this.type == 1"
        class="customizedProfile__main customized__InDashboard"
    >
        <div class="profile__img">
            <img :src="this.$public + 'clip__board.png'" alt="" />
        </div>
        <div class="image__Para">
            <p class="text__center mb__25">
                <b>
                    {{ jobDetail?.company_name }}{{ ", "
                    }}{{ jobDetail?.position_name }}
                </b>
            </p>
            <p>
                Chirrrp! My name is
                <b>{{ jobDetail?.first_name + " " + jobDetail?.last_name }}</b>
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
                    {{ jobDetail?.first_name + " " + jobDetail?.last_name }}</b
                >
            </p>
        </div>
    </div>
</template>
<script>
import Auth from "../auth";
export default {
    name: "ComapnyCustomizeProfile",
    props: {
        data: Object,
        jobDetail: Object,
    },
    data() {
        return {
            type: "",
        };
    },
    created() {
        this.type = Auth.user.type;
    },
};
</script>
