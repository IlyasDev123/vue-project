<template>
    <div class="add__member max__526 height__auto profile-bg">
        <div class="avatar__upload">
            <div class="avatar__edit" @change="onFileChange">
                <input type="file" id="imageUpload" accept="image/*"/>
                <label for="imageUpload"></label>
            </div>
            <div class="avatar__preview">
                <div
                    id="profileImagePreview"
                    v-if="this.avatar"
                    :style="{
                        backgroundImage: `url('${this.$public + this.avatar}')`,
                    }"
                ></div>
                <div
                    id="profileImagePreview"
                    v-else
                    :style="{
                        backgroundImage: 'url(' + this.$public + 'person-placeholder.jpg' + ')',
                    }"
                ></div>
                <!-- <img v-if="url" :src="url" /> -->
            </div>
        </div>

        <section class="main__login main__register--form">
            <div
                class="main__login-container register__small--container d__flex d__flex-v-center d__flex-h-between"
            >
                <div class="login__form-container">
                    <Form @submit="updateProfile" :validation-schema="schema">
                        <div class="full__nameHolder">
                            <fieldset
                                class="w__50 login__fields name__field--first d__flex"
                            >
                                <label for="login__name--first"
                                    >First name<span>*</span></label
                                >
                                <div class="input__wrapper">
                                    <Field
                                        v-model="this.first_name"
                                        name="first_name"
                                        type="text"
                                        id="login__name--first"
                                        placeholder="e.g. Deavid"
                                        @keypress="isLetter($event)"
                                    />
                                </div>
                                <ErrorMessage
                                    name="first_name"
                                    class="error_message"
                                />
                            </fieldset>
                            <fieldset
                                class="w__50 login__fields name__field--last d__flex"
                            >
                                <label for="name__field--last"
                                    >Last name<span>*</span></label
                                >
                                <div class="input__wrapper">
                                    <Field
                                        v-model="this.last_name"
                                        type="text"
                                        name="last_name"
                                        id="name__field--last"
                                        placeholder="e.g. Michael"
                                        @keypress="isLetter($event)"
                                    />
                                </div>
                                <ErrorMessage
                                    name="last_name"
                                    class="error_message"
                                />
                            </fieldset>
                        </div>
                        <fieldset class="login__fields email__field d__flex">
                            <label for="login__email">Email<span>*</span></label>
                            <div class="input__wrapper">
                                <Field
                                    v-model="this.email"
                                    name="email"
                                    type="email"
                                    id="login__email"
                                    placeholder="youremail@mail.com"
                                />
                            </div>
                            <ErrorMessage
                                name="email"
                                class="error_message"
                            />
                        </fieldset>
                        <fieldset class="login__fields phone__field d__flex">
                            <label for="login__phonr">Phone<span>*</span></label>
                            <div class="input__wrapper">
                                <Field
                                    v-model="this.phone"
                                    type="tel"
                                    id="login__phonr"
                                    placeholder="phone number"
                                    name="phone_no"
                                    @keydown="validatePhoneNumber"
                                />
                            </div>
                            <ErrorMessage
                                name="phone_no"
                                class="error_message"
                            />
                        </fieldset>
                        <fieldset
                            v-if="this.userType == this.$constants.EMPLOYER"
                            class="login__fields company__field d__flex"
                        >
                            <label for="login__company">Company<span>*</span></label>
                            <div class="input__wrapper">
                                <Field
                                    v-model="this.company_name"
                                    type="text"
                                    id="login__company"
                                    placeholder="Company name"
                                    name="company_name"
                                />
                            </div>
                            <ErrorMessage
                                name="company_name"
                                class="error_message"
                            />
                        </fieldset>
                        <fieldset class="login__fields company__field d__flex">
                            <label for="login__password">Update Password <small>(Optional)</small></label>
                            <div class="input__wrapper">
                                <Field
                                    v-model="this.password"
                                    :type="passwordFieldType"
                                    id="login__password"
                                    placeholder="at least 8 characters"
                                    name="password"
                                />
                                <button type="button" class="button" @click="toggleShow('password')">
                                    <img :src="eyeIcon" />
                                </button>
                            </div>
                            <ErrorMessage
                                name="password"
                                class="error_message"
                            />
                        </fieldset>
                        <fieldset class="login__fields company__field d__flex">
                            <label for="login__password_confirmation">Confirm Password</label>
                            <div class="input__wrapper">
                                <Field
                                    v-model="this.password_confirmation"
                                    :type="passwordConfirmFieldType"
                                    id="login__password_confirmation"
                                    placeholder="at least 8 characters"
                                    name="password_confirmation"
                                />
                                <button type="button" class="button" @click="toggleShow('confirm')">
                                    <img :src="eyeIconConfirm" />
                                </button>
                            </div>
                            <ErrorMessage
                                name="password"
                                class="error_message"
                            />
                        </fieldset>
                        <button
                            class="submit__btn blue__border-btn"
                            type="submit"
                        >
                            Save Changes
                        </button>
                    </Form>

                    <div class="deactivate-btn">
                        <button v-if="this.userType != this.$constants.ADMIN"
                            @click.prevent="showDeleteModal"
                            class="point"
                            style="font-size: 16px"
                        >
                            <span>Deactivate Account</span>
                        </button>
                    </div>

                    <!-- <button
                        @click.prevent="showDeleteModal"
                        class="submit__btn red__border-btn"
                    >
                        Deactivate Account
                    </button> -->
                </div>
            </div>
        </section>
    </div>
    <Modal :show="isDeleteModalVisible" v-slot:modal-content class="modal">
        <template v-if="showDeleteModalContent">
            <div class="popup__icon" style="text-align: center">
                <img
                    src="@/assets/images/talent-images/delete-first.png"
                    alt="delete-first"
                />
            </div>

            <h2 class="text__center fw__700" style="font-size: 22px">
                Are you Sure you want <br />to Delete Account ?
            </h2>
            <div class="two__btnHolders">
                <a
                    class="cursor delete__buttons red__border"
                    @click="showExperience"
                    >Yes, Delete</a
                >
                <a
                    class="cursor delete__buttons submit__btn"
                    @click.prevent="hideDeleteModal"
                    >No, Keep</a
                >
            </div>
        </template>
        <template class="review" v-if="showDeleteExpirence">
            <h3 class="review fw__700">
                How Would you Rate your Experience with Us? <span class="star-req">*</span>
            </h3>
            <div class="review__Points">
                <form action="">
                    <div class="points__wrapper d__flex">
                        <fieldset>
                            <input
                                type="radio"
                                id="point__1"
                                v-model="userReview.rating"
                                :value="1"
                            /><label for="point__1">1 </label>
                        </fieldset>
                        <fieldset>
                            <input
                                type="radio"
                                id="point__2"
                                v-model="userReview.rating"
                                :value="2"
                            />
                            <label for="point__2">2 </label>
                        </fieldset>
                        <fieldset>
                            <input
                                type="radio"
                                id="point__3"
                                :value="3"
                                v-model="userReview.rating"
                            />
                            <label for="point__3">3</label>
                        </fieldset>
                        <fieldset>
                            <input
                                type="radio"
                                id="point__4"
                                :value="4"
                                v-model="userReview.rating"
                            />
                            <label for="point__4">4</label>
                        </fieldset>
                        <fieldset>
                            <input
                                type="radio"
                                id="point__5"
                                v-model="userReview.rating"
                                :value="5"
                            />
                            <label for="point__5">5</label>
                        </fieldset>
                        <fieldset>
                            <input
                                v-model="userReview.rating"
                                type="radio"
                                id="point__6"
                                :value="6"
                            />
                            <label for="point__6">6</label>
                        </fieldset>
                        <fieldset>
                            <input
                                type="radio"
                                id="point__7"
                                v-model="userReview.rating"
                                :value="7"
                            />
                            <label for="point__7">7</label>
                        </fieldset>
                        <fieldset>
                            <input
                                type="radio"
                                id="point__8"
                                v-model="userReview.rating"
                                :value="8"
                            />
                            <label for="point__8">8</label>
                        </fieldset>
                        <fieldset>
                            <input
                                type="radio"
                                id="point__9"
                                v-model="userReview.rating"
                                :value="9"
                            />
                            <label for="point__9">9</label>
                        </fieldset>
                        <fieldset>
                            <input
                                type="radio"
                                id="point__10"
                                v-model="userReview.rating"
                                :value="10"
                            />
                            <label for="point__10">10</label>
                        </fieldset>
                    </div>
                    <h3 class="review"
                    v-if="this.userType == this.$constants.RECURITER">
                        Do you like to give feedback?
                    </h3>
                    <h3 class="review" v-else>
                        We’re sorry to see you go, please tell us why you’re
                        leaving.
                    </h3>
                    <fieldset>
                        <textarea v-model="userReview.review"></textarea>
                    </fieldset>
                </form>
            </div>
            <div class="two__btnHolders">
                <!-- submit__btn -->
                <a
                    class="delete__buttons blue_submit_btn"
                    @click.prevent="addUserReviews"
                    >Submit</a
                >
                <!-- red__border -->
                <a
                    class="delete__buttons red_cancel_btn"
                    @click.prevent="hideDeleteModal"
                    >Cancel</a
                >
            </div>
        </template>
        <template v-if="showDeleteComplete">
            <div class="popup__icon" style="text-align: center">
                <img
                    src="@/assets/images/talent-images/delete-first.png"
                    alt="delete-first"
                />
            </div>
            <h3
                class="text__center review fw__700 text__center"
                style="margin: 20px 0"
            >
                Sorry to see you go! <br />We hope you enjoyed Chirrrp
            </h3>
            <div class="two__btnHolders">
                <a
                    class="delete__buttons red__border max__100"
                    href="#"
                    style="font-size: 18px"
                    @click="deactivateAccount"
                    >Deactivate account</a
                >
            </div>
        </template>
    </Modal>
</template>

<script>
import Modal from "@/components/Modal.vue";
import * as yup from "yup";
import Auth from "../../auth";
import userService from "../../Services/userService";
import { Form, Field, ErrorMessage } from "vee-validate";
import auth from "../../auth";
import { mapMutations } from 'vuex'
// import { mapState } from "vuex";
export default {
    name: "PageProfileSettings",
    components: {
        Modal,
        Form,
        Field,
        ErrorMessage,
    },
    data() {
        return {
            user_id: Auth.user.id,
            first_name: "",
            last_name: "",
            phone: null,
            email: "",
            userType: "",
            avatar: null,
            password: "",
            password_confirmation: "",
            passwordFieldType: "password",
            passwordConfirmFieldType: "password",
            company_name: "",
            isDeleteModalVisible: false,
            showDeleteExpirence: false,
            showDeleteComplete: false,
            showDeleteModalContent: true,

            data: {
                avatar: null,
            },

            userReview: {
                user_id: Auth.user.id,
                review: "",
                rating: "",
            },
        };
    },
    computed: {
        schema() {
            return yup.object({
                first_name: yup
                    .string()
                    .required("First name field is required"),
                last_name: yup.string().required("Last name field is required"),
                email: yup.string().email("Please provide valid email address").required("Email is required."),
                phone_no: yup.string().required("Phone no field is required"),
                company_name:
                    Auth.user.type == 2
                        ? yup
                              .string()
                              .required("Company name field is required")
                        : null,
                password: yup.string(),
                password_confirmation: yup.string(),
            });
        },
        eyeIcon(){
            return this.passwordFieldType == 'password' ? this.$public + 'eye-slash-icon.svg' : this.$public + 'eye-icon.svg';
        },
        eyeIconConfirm(){
            return this.passwordConfirmFieldType == 'password' ? this.$public + 'eye-slash-icon.svg' : this.$public + 'eye-icon.svg';
        },
        validatePassword(){
            if(this.password.length > 0 && this.password.length < 8){
                return false;
            }
            return true;
        },
        confirmPassword(){
            if(this.password.length > 0 && this.password != this.password_confirmation){
                return false;
            }
            return true;
        }
    },
    created() {
        this.getUser(this.user_id);
    },
    // computed: {
    //     ...mapState("auth", {
    //         companyName: (state) => state.userMeta?.company_name,
    //         first_name: (state) => state.user?.first_name,
    //         last_name: (state) => state.user?.last_name,
    //         phone: (state) => state.user?.phone_no,
    //         email: (state) => state.user?.email,
    //         userType: (state) => state.user?.type,
    //     }),
    // },
    methods: {
        ...mapMutations("auth", {
            user : "USER"
        }),
        getUser(id) {
            userService
                .getUser(id)
                .then((data) => {
                    this.user(data.data.data);
                    this.first_name = data.data.data.first_name;
                    this.last_name = data.data.data.last_name;
                    this.email = data.data.data.email;
                    this.phone = data.data.data.phone_no;
                    this.userType = data.data.data.type;
                    this.avatar = data.data.data.avatar;
                    this.company_name =
                        data.data.data.company_meta?.company_name;
                    
                    let tokenn = {
                        'token': window.localStorage.getItem("token")
                    };
                    let user = { ...data.data.data, ...tokenn };
                    window.localStorage.setItem("user", JSON.stringify(user));
                })
                .catch((error) => {
                    this.$toast.error(error);
                });
        },
        updateProfile(event) {
            
            event && event.preventDefault;
            let formData = new FormData();

            formData.append("first_name", this.first_name);
            formData.append("last_name", this.last_name);
            formData.append("email", this.email);
            formData.append("phone_no", this.phone);
            formData.append("company_name", this.company_name);
            
            if (!this.validatePassword) {
                this.$toast.error('Password must be atleast 8 characters.');
                return false;
            }
            else if(!this.confirmPassword){
                this.$toast.error('Password and confirm password does not match.');
                return false;
            }

            formData.append("password", this.password);
            formData.append("password_confirmation", this.password_confirmation);
            userService
            .editProfile(formData)
            .then((data) => {
                this.getUser(this.user_id);
                this.$toast.success(data.data.message);
                this.$router.go()
            })
            .catch((error) => {
                let errrors = error.response.data.errors;
                if(errrors.first_name) {this.$toast.error(errrors.first_name[0]);}
                else if(errrors.last_name) {this.$toast.error(errrors.last_name[0]);}
                else if(errrors.email) {this.$toast.error(errrors.email[0]);}
                else{this.$toast.error(error.response.data.message);}
                
            });
        },
        addUserReviews() {
            userService
                .addUserReviews(this.userReview)
                .then((data) => {
                    if (data.data.status != true) {
                        this.$toast.error(data.data.message);
                    } else {
                        this.$toast.success(data.data.message);
                        this.showComplete();
                    }
                })
                .catch((error) => {
                    this.$toast.error(error.response.data.message);
                });
        },
        deactivateAccount() {
            userService
                .deactivateAccount()
                .then((data) => {
                    if (data.data.status != true) {
                        this.$toast.error(data.data.message);
                    } else {
                        console.log("Account deactivated", data);
                        this.$toast.success(data.data.message);
                        Auth.logout();
                        this.$router.push({ name: "Login" }).then(() => {
                            this.$router.go();
                        });
                    }
                })
                .catch((error) => {
                    this.$toast.error(error.response.data.message);
                });
        },
        toggleShow(type) {
            if(type == 'password'){
                this.passwordFieldType = this.passwordFieldType == 'password' ? 'text' : 'password';
            }
            else if(type == 'confirm'){
                this.passwordConfirmFieldType = this.passwordConfirmFieldType == 'password' ? 'text' : 'password';
            }
        },
        showDeleteModal() {
            this.isDeleteModalVisible = true;
        },
        hideDeleteModal() {
            this.isDeleteModalVisible = false;
            this.showDeleteExpirence = false;
            this.showDeleteModalContent = true;
        },
        showExperience() {
            this.showDeleteExpirence = true;
            this.showDeleteModalContent = false;
        },
        showComplete() {
            this.showDeleteExpirence = false;
            this.showDeleteModalContent = false;
            this.showDeleteComplete = true;
        },
        onFileChange(e) {
            this.data.avatar = e.target.files[0];

            var preview = document.querySelector('#profileImagePreview');
            
            userService
            .uploadProfileImage(this.data)
            .then((data) => {
                if (data.data.status != true) {
                    this.$toast.error(data.data.message);
                } else {
                    this.$toast.success(
                        "Profile image updated successfully."
                    );
                    this.getUser(Auth.user.id);
                    preview.style.backgroundImage = `url('${this.$public + data.data.data.avatar}')`;
                }
            })
            .catch((error) => {
                this.$toast.error(error.response.data.message);
            });
        },
        validatePhoneNumber(e) {
            console.log(e.which);
            if (
                (e.which >= 65 && e.which <= 90) ||
                (e.which >= 97 && e.which <= 122)
            ) {
                e.preventDefault();
            }
        },
        isLetter(e) {
            let char = String.fromCharCode(e.keyCode); // Get the character
            if (/^[A-Za-z]+$/.test(char)) return true;
            // Match with regex
            else e.preventDefault(); // If not match, don't add to input text
        },
    },
};
</script>


<style scoped>
.review {
    color: #132a51;
    font-size: 22px;
}
.profile-bg{
    background: #fff;
    padding:36px 45px;
    box-shadow: 0px 2px 12px -4px rgba(58, 53, 65, 0.1), 0px 2px 12px -4px rgba(58, 53, 65, 0.08), 0px 6px 16px -4px rgba(58, 53, 65, 0.1);
border-radius: 6px;
}
.error_message {
    color: rgba(255, 0, 0, 0.903);
    margin: 8px;
}
.login__fields span{
    color:#FF4C51;
}
textarea {
    max-width: 100%;
    width: 100%;
    resize: none;
    border: 1px solid #c7c7c7;
    border-radius: 10px;
    font-family: "Roboto";
    font-weight: 400;
    font-size: 16px;
    line-height: 20px;
    color: var(--black-color);
    min-height: 276px;
    margin: 22px 0;
    padding: 15px;
}
* {
    text-align: left;
}
h3.text__center {
    text-align: center !important;
}
.cursor {
    cursor: pointer;
}
.point {
    cursor: pointer;
    color: #e73d00 !important;
    border: none;
    background: none;
    font-weight: bold;
}
.deactivate-btn {
    text-align: center;
    /* color: #f34a35 !important; */
}
.modal {
    margin-left: 95px;
}
.red_cancel_btn {
    width: 45%;
    text-align: center;
    cursor: pointer;
    border: 1px solid #ff5757;
    color: #ff5757;
    background: none;
    /* text-transform: uppercase; */
    transition: all 0.4s ease;
}
.red_cancel_btn:hover {
    background: #ff5757;
    color: #ffffff;
}
.blue_submit_btn:hover {
    background: #4294ff;
    color: #ffffff;
}
.blue_submit_btn {
    width: 45%;
    cursor: pointer;
    text-align: center;
    border: 1px solid #4294ff;
    color: #4294ff;
    background: none;
    transition: all 0.4s ease;
    border-radius: 13px;
}
section.delete__popup .popup__MainWrapper .two__btnHolders .delete__buttons.submit__btn {
    text-transform:capitalize;
}
</style>
