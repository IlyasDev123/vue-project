<template>
    <div class="avatar__upload m__auto">
        <div class="avatar__preview">
            <div
                id="imagePreview"
                :style="{
                    backgroundImage: 'url(' + this.profile + ')',
                }"
            ></div>
        </div>
    </div>
    
    <div class="employee__form d__flex d__flex-h-between gray-label">
        <Form @submit="onSubmit" :validation-schema="schema" v-slot="{ errors }" class="employee__form d__flex d__flex-h-between gray-label">
            <div class="form__group floating-div">
                <Field
                    name="first_name"
                    type="text"
                    id="f_name"
                    class="form__field"
                    alt="First Name"
                    placeholder="First Name"
                    v-model="this.form.first_name"
                />
                <label for="f_name"  class="floating-label">First Name</label>
                <ErrorMessage name="first_name" class="error_message" />
            </div>

            <div class="form__group floating-div">
                <Field
                    type="text"
                    name="last_name"
                    id="l_name"
                    class="form__field"
                    placeholder="Last Name"
                    alt="Last Name"
                    v-model="this.form.last_name"
                />
                <label for="l_name"  class="floating-label">Last Name</label>
                <ErrorMessage name="last_name" class="error_message" />
            </div>

            <div class="form__group floating-div">
                <Field
                    name="email"
                    type="email"
                    id="email"
                    class="form__field"
                    placeholder="youremail@mail.com"
                    alt="Email"
                    v-model="this.form.email"
                />
                <label for="email" class="floating-label">Email</label>
                <ErrorMessage name="email" class="error_message" />
            </div>

            <div class="form__group floating-div">
                <Field
                    name="phone_no"
                    type="tel"
                    id="phone"
                    class="form__field"
                    placeholder="Phone Number"
                    alt="Phone Number"
                    v-model="this.form.phone_no"
                    @keydown="validatePhoneNumber"
                />
                <label for="phone" class="floating-label">Phone Number</label>
                <ErrorMessage name="phone_no" class="error_message" />
            </div>

            <template v-if="this.type == this.$constants.EMPLOYER">
                <div class="form__group full__group floating-div">
                    <Field
                        name="company_name"
                        type="text"
                        id="company"
                        class="form__field"
                        placeholder="Company Name"
                        alt="Company Name"
                        v-model="this.form.company_name"
                    />
                    <label for="company"  class="floating-label">Company Name</label>
                    <ErrorMessage name="company_name" class="error_message" />
                </div>
                <div class="form__btn--back">
                    <button type="submit" class="back__btn">
                        <svg
                            width="10"
                            height="10"
                            viewBox="0 0 10 10"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M2.56642 5.58328L5.69542 8.71228L4.87058 9.53711L0.333416 4.99994L4.87058 0.462776L5.69542 1.28761L2.56642 4.41661L9.66675 4.41661L9.66675 5.58328L2.56642 5.58328Z"
                                fill="#304254"
                            />
                        </svg>
                        <span>Save Changes & Back</span>
                    </button>
                    <router-link :to="{ name: 'EmployersPage' }">
                    </router-link>
                </div>
                <div class="form__btn--create">
                    <router-link
                        :to="{
                            name: 'RefferEmployerPage',
                            params: { id: this.$route.params.id },
                        }"
                    >
                        <button class="create__btn">
                            <span>Refer/ View Talent</span>
                        </button>
                    </router-link>
                </div>
            </template>

            <template v-else-if="this.type == this.$constants.TALENT">
                
                <div class="form__btn--back">
                    <button type="submit" class="back__btn">
                        <svg
                            width="10"
                            height="10"
                            viewBox="0 0 10 10"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M2.56642 5.58328L5.69542 8.71228L4.87058 9.53711L0.333416 4.99994L4.87058 0.462776L5.69542 1.28761L2.56642 4.41661L9.66675 4.41661L9.66675 5.58328L2.56642 5.58328Z"
                                fill="#304254"
                            />
                        </svg>
                        <span>Save Changes & Back</span>
                    </button>
                    <router-link :to="{ name: 'RecruiterTalentPage' }">
                    </router-link>
                </div>
                <div class="form__btn--create">
                    <router-link
                        :to="{
                            name: 'RefferTalentPage',
                            params: { id: this.$route.params.id },
                        }"
                    >
                        <button class="create__btn">
                            <span>Refer to Company</span>
                        </button>
                    </router-link>
                </div>
            </template>

            <template v-else-if="this.type == this.$constants.RECRUITER">
                <div class="form__btn--back">
                    <button type="submit" class="back__btn">
                        <svg
                            width="10"
                            height="10"
                            viewBox="0 0 10 10"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M2.56642 5.58328L5.69542 8.71228L4.87058 9.53711L0.333416 4.99994L4.87058 0.462776L5.69542 1.28761L2.56642 4.41661L9.66675 4.41661L9.66675 5.58328L2.56642 5.58328Z"
                                fill="#304254"
                            />
                        </svg>
                        <span>Save Changes & Back</span>
                    </button>
                    <router-link :to="{ name: 'RecruiterPage' }">
                    </router-link>
                </div>
                <div class="form__btn--create">
                    <router-link
                        :to="{
                            name: 'RefferRecruiterPage',
                            params: { id: this.$route.params.id },
                        }"
                    >
                        <button class="create__btn">
                            <span>View Refers</span>
                        </button>
                    </router-link>
                </div>
            </template>
        </Form>
        <div v-if="this.user.is_blocked" class="form__btn--block">
            <button class="delete__btn">
                <span>Blocked User</span>
            </button>
        </div>
        <div v-else class="form__btn--block">
            <button @click="blockUser" class="delete__btn">
                <span>Block User</span>
            </button>
        </div>
    </div>
</template>

<script>
// import FloatLabel from "vue-float-label/components/FloatLabel";
import userService from "../Services/userService";
import * as yup from "yup";
import { Form, Field, ErrorMessage } from "vee-validate";
export default {
    name: "ViewUserForm",
    // components:{
    //     FloatLabel
    // },
    components: {
        // FloatLabel,
        Form,
        Field,
        ErrorMessage,
    },
    props: {
        userType: Number,
    },
    data() {
        return {
            user: [],
            type: "",
            form: {
                id: "",
                first_name: "",
                last_name: "",
                email: "",
                phone_no: "",
                company_name: "",
                type: "",
            },
        };
    },
    mounted() {
        this.type = this.userType;
        this.getUser();
    },
    computed: {
        profile() {
            return this.user?.avatar ? this.$public + this.user?.avatar : this.$public + this.$dummy;
        },
        schema() {
            return yup.object({
                first_name: yup.string().required("First name is required field"),
                last_name: yup.string().required("Last name is required field"),
                email: yup.string().required('Email is required field').email("Please provide valid email address"),
                // password: yup.string().required().min(8,"The password must be 8 characters."),
                phone_no: yup.string().required("phone number is required field"),
                company_name:
                    this.type == this.$constants.EMPLOYER
                        ? yup.string().required("company name is required field")
                        : null,
            });
        },
    },
    methods: {
        validatePhoneNumber(e) {
            if (
                (e.which >= 65 && e.which <= 90) ||
                (e.which >= 97 && e.which <= 122)
            ) {
                e.preventDefault();
            }
        },
        onSubmit() {

            userService
                .updateUser(this.form)
                .then((data) => {
                    if (this.form.type == this.$constants.EMPLOYER) {
                        this.$toast.success("Employer updated successfully");
                        this.$router.push("/employers");
                    } else if (this.form.type == this.$constants.RECURITER) {
                        this.$toast.success("Recruiter updated successfully");
                        this.$router.push("/recruiters");
                    } else {
                        this.$toast.success("Talent updated successfully");
                        this.$router.push("/talents");
                    }
                })
                .catch((error) => {
                    if (error.response.data.errors) {
                        var errObj = error.response.data.errors;

                        if (errObj.first_name) this.$toast.error(errObj.first_name[0]);
                        if (errObj.last_name) this.$toast.error(errObj.last_name[0]);
                        if (errObj.email) this.$toast.error(errObj.email[0]);
                        // if (errObj.password) this.$toast.error(errObj.password[0]);
                        if (errObj.company_name) this.$toast.error(errObj.company_name[0]);
                        if (errObj.phone_no) this.$toast.error(errObj.phone_no[0]);
                        if (errObj.type) this.$toast.error(errObj.type[0]);
                    }
                    // return this.$toast.error(error.response.data.message);
                });
        },
        getUser() {
            userService
                .getUser(this.$route.params.id)
                .then((data) => {
                    this.user = data.data.data;
                    this.form.id = data.data.data.id;
                    this.form.type = data.data.data.type;
                    this.form.first_name = data.data.data.first_name;
                    this.form.last_name = data.data.data.last_name;
                    this.form.email = data.data.data.email;
                    this.form.phone_no = data.data.data.phone_no;
                    this.form.company_name = data.data.data?.company_meta?.company_name;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        blockUser() {
            userService.blockUser(this.$route.params.id).then((data) => {
                if (data.data.status != true) {
                    this.isLoading = false;
                    console.log("error:", data);
                    this.$toast.error(data.data.message);
                } else {
                    console.log("block user:", data.data);
                    this.$toast.success("User is blocked Successfully");
                    if (this.type == this.$constants.EMPLOYER) {
                        this.$router.push("/employers");
                    } else {
                        this.$router.push("/talent");
                    }
                }
            });
        },
    },
};
</script>

<style lang="scss" scoped></style>
