<template>
  <section class="main__login main__register--form">
    <div
      class="
        main__login-container
        register__small--container
        d__flex d__flex-v-center d__flex-h-between
      "
    >
      <div class="login__logo margin-top-100">
        <a href="/">
          <img
            src="@/assets/images/talent-images/left_logo.svg"
            alt="main_logo"
          />
        </a>
      </div>
      <div class="login__form-container">
        <Form
          @submit="onSubmit"
          :validation-schema="!socialAccess ? schema : null"
        >
          <h1>{{ !socialAccess ? `Get Started` : `Upload CV` }}</h1>

          <fieldset v-show="!socialAccess">
            <fieldset class="p">
              <fieldset class="w__50 login__fields name__field--first d__flex">
                <label for="login__name--first">First name<span>*</span></label>
                <div class="input__wrapper">
                  <Field
                    type="text"
                    id="login__name--first"
                    name="firstname"
                    v-model="data.first_name"
                    placeholder="e.g. Deavid"
                    @keypress="isLetter($event)"
                  />
                </div>
                <ErrorMessage name="firstname" class="error_message" />
              </fieldset>
              <fieldset class="w__50 login__fields name__field--last d__flex">
                <label for="name__field--last">Last name<span>*</span></label>
                <div class="input__wrapper">
                  <Field
                    type="text"
                    id="name__field--last"
                    name="lastname"
                    v-model="data.last_name"
                    placeholder="e.g. Michael"
                    @keypress="isLetter($event)"
                  />
                </div>
                <ErrorMessage name="lastname" class="error_message" />
              </fieldset>
            </fieldset>
            <fieldset class="login__fields email__field d__flex">
              <label for="login__email">Email<span>*</span></label>
              <div class="input__wrapper">
                <Field
                  type="email"
                  id="login__email"
                  name="email"
                  v-model="data.email"
                  placeholder="youremail@mail.com"
                />
              </div>
              <ErrorMessage name="email" class="error_message" />
            </fieldset>
            <fieldset class="login__fields phone__field d__flex">
              <label for="login__phonr">Phone<span>*</span></label>
              <div class="input__wrapper">
                <Field
                  type="tel"
                  id="login__phonr"
                  placeholder="phone number"
                  name="phoneno"
                  v-model="data.phone_no"
                  @keydown="validatePhoneNumber"
                />
              </div>
              <ErrorMessage name="phoneno" class="error_message" />
            </fieldset>
            <fieldset class="login__fields name__field d__flex">
              <label for="login__password">Password<span>*</span></label>
              <div class="input__wrapper">
                <Field
                  id="login__password"
                  v-model="data.password"
                  name="password"
                  :type="passwordFieldType"
                  placeholder="at least 8 characters"
                />
                <button type="button" class="button" @click="toggleShow">
                  <img :src="eyeIcon" />
                </button>
                <button id="hide_password" class="eye_icon hide__this" style="">
                  <i class="fa-regular fa-eye-slash"></i>
                </button>
              </div>
              <ErrorMessage name="password" class="error_message" />
            </fieldset>
          </fieldset>
          <fieldset
            class="login__fields file__field"
            v-show="data.userType == this.$constants.TALENT"
          >
            <label class="filelabel">
              <svg
                width="15"
                height="17"
                viewBox="0 0 15 17"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
                v-show="!previewCv"
              >
                <path
                  d="M1.6875 0.5C0.7575 0.5 0 1.2575 0 2.1875V13.8125C0 14.7425 0.7575 15.5 1.6875 15.5H6.61157C6.28907 15.17 6.01901 14.7913 5.80151 14.375H1.6875C1.37625 14.375 1.125 14.1237 1.125 13.8125V2.1875C1.125 1.87625 1.37625 1.625 1.6875 1.625H6V4.8125C6 5.7425 6.7575 6.5 7.6875 6.5H10.875V7.3064C11.265 7.37015 11.6438 7.475 12 7.625V5.9375C12 5.78188 11.9369 5.64151 11.8352 5.53979L6.96021 0.664795C6.85849 0.563076 6.71812 0.5 6.5625 0.5H1.6875ZM7.125 2.42041L10.0796 5.375H7.6875C7.37625 5.375 7.125 5.12375 7.125 4.8125V2.42041ZM10.125 8C7.84688 8 6 9.84688 6 12.125C6 14.4031 7.84688 16.25 10.125 16.25C12.4031 16.25 14.25 14.4031 14.25 12.125C14.25 9.84688 12.4031 8 10.125 8ZM3.5625 8.375C3.25125 8.375 3 8.62625 3 8.9375C3 9.24875 3.25125 9.5 3.5625 9.5H6.01904C6.28904 9.07625 6.62596 8.69375 7.01221 8.375H3.5625ZM10.125 9.125C10.332 9.125 10.5 9.293 10.5 9.5V11.75H12.75C12.957 11.75 13.125 11.918 13.125 12.125C13.125 12.332 12.957 12.5 12.75 12.5H10.5V14.75C10.5 14.957 10.332 15.125 10.125 15.125C9.918 15.125 9.75 14.957 9.75 14.75V12.5H7.5C7.293 12.5 7.125 12.332 7.125 12.125C7.125 11.918 7.293 11.75 7.5 11.75H9.75V9.5C9.75 9.293 9.918 9.125 10.125 9.125ZM3.5625 11C3.25125 11 3 11.2513 3 11.5625C3 11.8737 3.25125 12.125 3.5625 12.125H5.25C5.25 11.7388 5.29485 11.36 5.3811 11H3.5625Z"
                  fill="#578BFF"
                ></path>
              </svg>
              <span class="title" v-show="!previewCv">
                Resume or Cover letter (only pdf file format is allowed)
              </span>
              <span class="sub_title" v-show="!previewCv">
                Upload Your Resume
              </span>
              <vue-pdf-embed
                :source="previewCv"
                class="pdf"
                v-show="previewCv"
              />
              <input
                class="FileUpload1"
                id="FileInput"
                name="cv"
                type="file"
                accept="application/pdf"
                @change="onChange"
                style=""
              />
            </label>
            <p class="red__small" v-show="!previewCv">
              You cannot sign up without providing the resume*
            </p>
            <div class="error_message" v-show="!data.is_cv_attached">
              {{ data.cv_error }}
            </div>
            <div class="error_message" v-show="!isFileTpe">
              {{ data.cv_error }}
            </div>
          </fieldset>
          <fieldset class="login__fields privacyCheck__field">
            <div class="check__holder">
              <input
                type="checkbox"
                id="agree__termsconditions"
                name="is_agree_with_terms_condition"
                v-model="data.is_agree_with_terms_condition"
              />
              <label for="agree__termsconditions">
                <p>
                  I confirm that i have read and agree to the
                  <a href="#">Terms and conditions</a> and
                  <a href="#">Privay Poilicy</a>.
                </p>
              </label>
            </div>
            <div
              class="error_message"
              v-show="!data.is_agree_with_terms_condition"
            >
              {{ data.error }}
            </div>
          </fieldset>
          <button class="submit__btn" type="submit">
            {{ !socialAccess ? "Sign up" : "Sign up" }}
          </button>
          <div v-show="!socialAccess" class="google__login">
            <button @click="socialSignUp" type="button">
              <img
                src="@/assets/images/talent-images/google_signup.png"
                alt="googleSignup"
              />
            </button>
          </div>
          <div class="register__now">
            <p>
              Already have an account?
              <router-link :to="{ name: 'Login' }">Login</router-link>
            </p>
          </div>
        </Form>
      </div>
    </div>
    <div class="login__footer">
      <div class="main__login-container">
        <div class="footer__links">
          <ul class="d__flex d__flex-h-between d__flex-v-center">
            <li>
              <a href="#">Conditions of Use </a>
            </li>
            <li>
              <a href="#">Privacy Notice</a>
            </li>
            <li>
              <a href="#">Help</a>
            </li>
          </ul>
        </div>
        <div class="copy__text">
          <p>Copyright © 2022, chirrrp.</p>
        </div>
      </div>
    </div>
  </section>
</template>
<script>
import { Form, Field, ErrorMessage } from "vee-validate";
import { mapActions, mapState } from "vuex";
import * as yup from "yup";
import { googleTokenLogin } from "vue3-google-login";
import VuePdfEmbed from "vue-pdf-embed";
import authService from "../../Services/authService";
import Auth from "../../auth";

export default {
  name: "UserRegister",
  components: {
    Form,
    Field,
    ErrorMessage,
    VuePdfEmbed,
  },

  computed: {
    schema() {
      return yup.object({
        email: yup.string().required().email("Email is a required field"),
        firstname: yup.string().required("First Name is a required field"),
        lastname: yup.string().required("Last Name is a required field"),
        password: yup.string().required().min(8),
        phoneno: yup.string().required("Phone Number is a required field"),
      });
    },
    eyeIcon(){
      return this.passwordFieldType == 'password' ? this.$public + 'eye-slash-icon.svg' : this.$public + 'eye-icon.svg';
    },
  },
  created() {
    let formData = this.$functions.getLocalStorage("mutlistepfm") || [];
    this.data.userType = formData ? formData.type : null;
    if (formData.length == 0) {
      this.$router.push("/select-role");
    }
    else if (!formData.type) {
      this.$router.push("/select-role");
    }
    else if(formData.social_login_id != null){
      this.data.first_name = formData?.first_name;
      this.data.last_name = formData?.last_name;
      this.data.email = formData?.email;
      this.data.phone_no = formData?.phone_no;
      this.socialAccess = true;
      this.social_login_id = formData.social_login_id;
    }
  },
  data() {
    return {
      previewCv: null,
      data: {
        first_name: "",
        last_name: "",
        email: "",
        password: "",
        phone_no: "",
        isValidPhoneNumber: true,
        is_agree_with_terms_condition: false,
        is_cv_attached: false,
        userType: null,
        error: null,
        cv: "",
        cv_error: null,
        social_login_id: null
      },
      passwordFieldType: "password",
      socialAccess: false,
      isFileTpe : true,
    };
  },
  beforeCreate() {
    if (Auth.user) {
      if(Auth.user.type == this.$constants.TALENT){
        this.$router.push("/new-job-match");
      }
      else if(Auth.user.type == this.$constants.EMPLOYER){
        this.$router.push("/new-talent-match");
      }
      else{
        this.$router.push("/employers");
      }
    }
  },
  methods: {
    async onChange(e) {
      this.data.cv = e.target.files[0];
      if (  this.data.cv && this.data.cv.type !== "application/pdf") {
        e.target.value = null;
        this.data.fileTpe = false;
        return  this.data.cv_error = "Only pdf file format is allowed";
      }
      this.previewCv = URL.createObjectURL(e.target.files[0]);
      this.data.is_cv_attached = true;
      if (e.target.files.length) {
        let formData = new FormData();
        formData.append("file", this.data.cv);
        formData.append("previous_url", localStorage.getItem("cv"));

        let response = await authService
          .uploadResume(formData)
          .catch((error) => {
            this.$toast.error(error.response.data.message);
          });

        if (response.data.status == true) {
          this.data.is_cv_attached = true;
          localStorage.setItem("cv", response.data.data);
        }
      }
    },
    async onSubmit(event) {
      event && event.preventDefault;
      if (
        this.data.is_cv_attached == false &&
        this.data.userType == this.$constants.TALENT
      ) {
        this.data.cv_error = "Please upload your cv.";
      } else if (this.data.is_agree_with_terms_condition == false) {
        this.data.error = "Please agree to terms and conditions";
      } else {
        let response = await authService
          .checkEmail({
            email: this.data.email,
          })
          .catch((error) => {
            this.$toast.error(error.response.data.message);
          });

        if (response.data.status == true) {
          const newDataUsers = JSON.parse(localStorage.getItem("mutlistepfm"));
          let users = { ...newDataUsers, ...this.data };
          let user = localStorage.setItem("mutlistepfm", JSON.stringify(users));
          this.$router.push("/getIn");
        }
      }
    },
    async socialSignUp() {
      googleTokenLogin().then((response) => {
        axios
          .get(
            `https://www.googleapis.com/oauth2/v2/userinfo?access_token=${response.access_token}`
          )
          .then(({ data }) => {
            authService
              .socialLogin({ social_login_id: data.id })
              .then((response) => {
                let token = response.data.data.access_token;
                Auth.login(token, response.data.data);
                if (response.data.data.type == this.$constants.TALENT) {
                  this.$router
                    .push({
                      name: "NewJobMatch",
                    })
                    .then(() => {
                      this.$router.go();
                    });
                  localStorage.removeItem("mutlistepfm");
                } else if (response.data.data.type == this.$constants.EMPLOYER) {
                  this.$router
                    .push({
                      name: "NewTalentMatch",
                    })
                    .then(() => {
                      this.$router.go();
                    });
                  localStorage.removeItem("mutlistepfm");
                } else {
                  this.$router
                    .push({
                      name: "EmployersPage",
                    })
                    .then(() => {
                      this.$router.go();
                    });
                  localStorage.removeItem("mutlistepfm");
                }
              })
              .catch((error) => {
                authService
                  .checkEmail({
                    email: data.email,
                  })
                  .then((response) => {
                    if (response.data.status == true) {

                      this.data.first_name = data.given_name;
                      this.data.last_name = data.family_name;
                      this.data.email = data.email;
                      this.data.is_agree_with_terms_condition = true;
                      this.data.social_login_id = data.id;
                      this.setLocalStorage(data);
                    }
                  })
                  .catch((error) => {
                    this.$toast.error(error.response.data.message);
                  });
              });
          });
      });
    },
    setLocalStorage(data) {
      this.socialAccess = true;
      let payload = {
        email: data.email,
        social_login_id: data.id,
        first_name: data.given_name,
        last_name: data.family_name,
        is_agree_with_terms_condition: 1,
      };
      const newDataUsers = JSON.parse(localStorage.getItem("mutlistepfm"));
      let users = { ...newDataUsers, ...payload };
      localStorage.setItem("mutlistepfm", JSON.stringify(users));

      // hasTriedLogin
      if(this.data.userType != this.$constants.TALENT){
        this.$router.push("/getIn");
      }
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
    toggleShow() {
        this.passwordFieldType = this.passwordFieldType == 'password' ? 'text' : 'password';
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
.login__fields span{
    color:#FF4C51;
}
.error_message {
  color: rgba(255, 0, 0, 0.903);
  margin: 8px;
}
.pdf {
  overflow-y: scroll;
  height: 20vh;
}
</style>
