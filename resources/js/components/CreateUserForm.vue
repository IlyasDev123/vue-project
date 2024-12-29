<template>
    <div class="avatar__upload">
        <div class="avatar__edit" @change="onFileChange">
            <input type="file" id="imageUpload" accept="image/*"/>
            <label for="imageUpload"></label>
        </div>
        <div class="avatar__preview">
            <div
                id="profilePreview"
                v-if="url"
                :style="{ backgroundImage: `url('${url}')` }"
            ></div>
            <div
                id="profilePreview"
                v-else
                :style="{
                    backgroundImage:
                        'url(' + this.$public + 'person-placeholder.jpg' + ')',
                }"
            ></div>
        </div>
    </div>
    <Form @submit="addUser" :validation-schema="schema" v-slot="{ errors }">
        <div class="employee__form d__flex d__flex-h-between">
            <div class="form__group full__group">
                <h4>ADD DETAILS</h4>
            </div>

            <div class="form__group floating-div">
                
                <Field
                    name="first_name"
                    type="text"
                    id="f_name"
                    class="form__field"
                    alt="First Name"
                    placeholder="First Name"
                    v-model="form.first_name"
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
                    v-model="form.last_name"
                />
                <label for="f_name"  class="floating-label">Last Name</label>
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
                    v-model="form.email"
                />
                <label for="f_name"  class="floating-label">Email</label>
                <ErrorMessage name="email" class="error_message" />
            </div>

            <!-- <div class="form__group floating-div">
                <Field
                    name="password"
                    type="password"
                    class="form__field"
                    id="password"
                    placeholder="Password"
                    alt="Password"
                    v-model="form.password"
                />
                <label for="f_name"  class="floating-label">Password</label>
                <ErrorMessage name="password" class="error_message" />
            </div> -->

            <div class="form__group">
                <div class="floating-div">
                    <Field
                        name="phone_no"
                        type="tel"
                        id="phone"
                        class="form__field"
                        placeholder="Phone Number"
                        alt="Phone Number"
                        v-model="form.phone_no"
                        @keydown="validatePhoneNumber"
                    />
                    <label for="f_name"  class="floating-label">Phone Number</label>
                    <ErrorMessage name="phone_no" class="error_message" />
                </div>
            </div>

            <div
                v-if="form.type == this.$constants.EMPLOYER"
                class="form__group floating-div"
            >
                <Field
                    name="current_role"
                    type="text"
                    id="role"
                    class="form__field"
                    placeholder="Current Role"
                    alt="Current Role"
                    v-model="form.current_role"
                />
                <label for="f_name"  class="floating-label">Current Role</label>
                <ErrorMessage name="current_role" class="error_message" />
            </div>

            <div
                v-if="form.type == this.$constants.EMPLOYER"
                class="form__group floating-div"
            >
                <Field
                    name="company_name"
                    type="text"
                    id="company"
                    class="form__field"
                    placeholder="Company Name"
                    alt="Company Name"
                    v-model="form.company_name"
                />
                <label for="f_name"  class="floating-label">Company Name</label>
                <ErrorMessage name="company_name" class="error_message" />
            </div>

            <div class="form__btn--back">
                <router-link :to="{ name: 'EmployersPage' }">
                    <button class="back__btn">
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
                        <span>Go Back</span>
                    </button>
                </router-link>
            </div>
            <div class="form__btn--create">
                <button type="submit" class="create__btn">
                    <span>{{this.createBtn}}</span>
                </button>
            </div>
        </div>
    </Form>
</template>

<script>
// import FloatLabel from "vue-float-label/components/FloatLabel";
import * as yup from "yup";
import userService from "../Services/userService";
import { Form, Field, ErrorMessage } from "vee-validate";
export default {
    name: "CrateUserForm",
    components: {
        // FloatLabel,
        Form,
        Field,
        ErrorMessage,
    },
    props: {
        backBtn: Array,
        createBtn: String,
        userType: Number,
    },
    data() {
        return {
            url: null,

            isLoading: "",
            form: {
                first_name: "",
                last_name: "",
                email: "",
                // password: "",
                phone_no: "",
                company_name: "",
                current_role: "",
                avatar: null,
                type: this.userType,
            },
        };
    },
    computed: {
        schema() {
            return yup.object({
                first_name: yup.string().required("First name is required field"),
                last_name: yup.string().required("Last name is required field"),
                email: yup.string().required(),
                // password: yup.string().required().min(8,"The password must be 8 characters."),
                phone_no: yup.string().required("Phone number is required field"),
                company_name:
                    this.form.type == this.$constants.EMPLOYER
                        ? yup.string().required("Company name is required field")
                        : null,
                current_role:
                    this.form.type == this.$constants.EMPLOYER
                        ? yup.string().required("Current role is required field")
                        : null,
            });
        },
    },

    methods: {
        onFileChange(e) {
            this.form.avatar = e.target.files[0];

            var preview = document.querySelector('#profilePreview');
            
            var reader  = new FileReader();
            reader.addEventListener("load", function () {
                preview.style.backgroundImage = "url('"+reader.result+"')";
            }, false);

            if (this.form.avatar) {
                reader.readAsDataURL(this.form.avatar);
            }
            else{
                preview.style.backgroundImage = `url(${this.$public + 'person-placeholder.jpg'})`;
            }
        },
        addUser() {
            
            this.isLoading = true;

            userService
                .createUser(this.form)
                .then((data) => {

                    this.isLoading = false;
                    if (this.form.type == this.$constants.EMPLOYER) {
                        console.log("add employer", data);
                        this.$toast.success("Employer created successfully");
                        this.$router.push("/employers");
                    } else if (this.form.type == this.$constants.RECURITER) {
                        this.$toast.success("Recruiter created successfully");
                        this.$router.push("/recruiters");
                    } else {
                        console.log("add talent", data);
                        this.$toast.success("Talent created successfully");
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
                        if (errObj.current_role) this.$toast.error(errObj.current_role[0]);
                        if (errObj.type) this.$toast.error(errObj.type[0]);
                    }
                    // return this.$toast.error(error.response.data.message);
                });
        },
        validatePhoneNumber(e) {
            if (
                (e.which >= 65 && e.which <= 90) ||
                (e.which >= 97 && e.which <= 122)
            ) {
                e.preventDefault();
            }
        },
        addTalent() {},
    },
};

</script>

<style lang="scss" scoped>
</style>
