<template>
    <div class="cv__block">
        <div class="cv__block-container">
            <div class="cv__block-content">
                <div class="cv__block-header">
                    <h2>
                        {{ company?.company?.company_meta?.company_name }}
                        <br />
                    </h2>

                    <p>{{ company?.profession?.name }}</p>
                </div>
                <div class="cv__block-body">
                    <div class="cv__block-item">
                        <h3 class="cv__block-heading">
                            {{ company?.profession?.name }}
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: "EmployerCvBlock",
    props: {
        company: Object,
    },
    data() {
        return {
            type: "",
        };
    },
    methods: {
        async getPositionById(id) {
            const response = await TalentService.getTalentById(id).catch(
                (error) => {
                    return this.$toast.error(error.response.data.message);
                }
            );
            this.talent = response.data.data;
        },
    },
};
</script>
<style lang="scss" scoped></style>
