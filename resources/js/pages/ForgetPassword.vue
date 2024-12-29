<template>
    <section class="main__login login-main">
        <div class="main__login-container">
            <div class="login__logo">
                <a href="/">
                    <img
                        src="@/assets/images/talent-images/login_logo.png"
                        alt="main_logo"
                    />
                </a>
            </div>
            <div class="login__form-container">
                <Form @submit="onsubmit" :validation-schema="schema">
                    <h1>Forgot Password</h1>
                    <fieldset class="login__fields name__field d__flex">
                        <label for="login__name">Email</label>
                        <div class="input__wrapper">
                            <Field
                                type="email"
                                id="login__name"
                                name="email"
                                v-model="data.email"
                                placeholder="youremail@mail.com"
                            />
                        </div>
                        <ErrorMessage name="email" class="error_message" />
                    </fieldset>

                    <button
                        v-show="!isLoader"
                        :disabled="isDisable == true"
                        class="submit__btn"
                        type="submit"
                    >
                        Send Reset Link
                    </button>
                    <div class="loader_btn big__blutBtn" v-show="isLoader">
                        <img
                            src="@/assets/img/loader.gif"
                            width="30"
                        />
                    </div>
                    <div class="forget__password">
                        <router-link :to="{ name: 'Login' }"
                        >Back to Login</router-link
                        >
                    </div>
                </Form>
            </div>
        </div>
    </section>
</template>

<script>
import { Form, Field, ErrorMessage } from "vee-validate";
import authService from "../Services/authService";
export default {
    name: "ForgetPassword",
    components: {
        Form,
        Field,
        ErrorMessage,
    },
    data() {
        return {
            isLoader: false,
            isDisable: false,

            data: {
                email: "",
            },
        };
    },
    methods: {
        onsubmit(event) {
            event.preventDefault;

            if(!this.data.email){
                this.$toast.error('The email field is requied.');
                return false; 
            }

            this.isLoader = true;
            this.isDisable = true;
            authService
                .forgetPassword(this.data)
                .then((data) => {
                    this.isLoader = false;
                    this.isDisable = false;
                    this.$toast.success(data.data.message);
                    this.data.email = null;
                })
                .catch((error) => {
                    this.isLoader = false;
                    this.isDisable = false;
                    this.$toast.error(error.response.data.message);
                });
        },
    },
};
</script>
<style>
.loader_btn {
    /* padding-right: 190px;
    padding-left: 190px; */
    width: 100%;
    text-align: center;
}
.big__blutBtn{
    padding: 10px 78px;
    line-height: 14px;
}
</style>
