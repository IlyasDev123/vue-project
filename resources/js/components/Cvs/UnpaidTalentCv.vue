<template>
    <div class="customizedProfile__main customized__InDashboard">
        <div class="profile__img">
            <img :src="this.$public + 'clip__board.png'" alt="" />
        </div>
        <div class="image__Para">
            <p class="text__center mb__25">
                <b
                    >{{
                        talent?.first_name +
                        " " +
                        talent?.last_name +
                        ", " +
                        talent?.skills?.profession?.name +
                        " - " +
                        talent?.talent_meta?.state.name
                    }}
                </b>
            </p>
            <p>
                Chirrrp! My name is
                <b>{{ talent?.first_name + " " + talent?.last_name }}</b>
                and I'd love to be considered for your open
                <b>{{ talent?.skills?.profession?.name }}</b> position. I have
                <b>{{ talent?.skills?.experience?.start_range + " " }}YRS</b>
                of relevant experience as a Role and I think I could be a good
                match for your team!
            </p>
            <p>
                Choosing a new employer is a big step for me, so I'd like to
                make sure you know a little more about me before we match!
            </p>
            <p>
                In my current role, I'm often described by my colleagues as
                <b>Colleagues &amp; Colleagues</b>. I'm looking for the next
                step in my career and an important deciding factor for me is
                Important. In my free time I enjoy
                <b>{{ talent?.talent_meta?.hobbies?.name }}</b> as well as
                <b>Hobbies!</b>
            </p>
            <p class="mb__25">
                I'm currently located in
                <b>{{ talent?.talent_meta?.state?.name }}</b> and my ideal
                salary range is {{ talent?.talent_meta?.salary?.start_range }}
            </p>
            <p class="text__center">
                <b>Let's see if we're a Chirrrp match!</b>
            </p>
            <p class="text__center">
                <b
                    >Thanks,
                    {{ talent?.first_name + " " + talent?.last_name }}</b
                >
            </p>
        </div>
    </div>
</template>
<script>
export default {
    name: "UnpaidTalentCv",
    props: {
        talent: Object,
    },
};
</script>
<style lang="scss" scoped></style>
