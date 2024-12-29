<script>
import { Form, Field, ErrorMessage } from "vee-validate";
import * as yup from "yup";
import Auth from "../../auth";
import authService from "../../Services/authService";
import { googleTokenLogin } from "vue3-google-login";

export default {
  name: "Login",
  components: {
    Form,
    Field,
    ErrorMessage,
  },
  props: {
    isRecruiter: Boolean,
    isAdmin: Boolean,
  },
  data() {
    return {
      isLoading: false,
      data: {
        email: "",
        password: "",
      },
      passwordFieldType: "password"
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
  computed: {
    schema() {
      return yup.object({
        email: yup.string().required('Email is required.')
        .email('Please provide valid email.'),
        password: yup.string().required('Password is required.'),
      });
    },
    eyeIcon(){
        return this.passwordFieldType == 'password' ? this.$public + 'eye-slash-icon.svg' : this.$public + 'eye-icon.svg';
    },
  },
  methods: {
    forget() {
      this.$router.push("/forget-password");
    },
    onsubmit(event) {
      this.isLoading = true;
      event && event.preventDefault;
      authService
        .login(this.data)
        .then((data) => {
          if (data.data.status != true) {
            this.isLoading = false;
            this.$toast.error(data.message);
          } else {
            this.isLoading = false;
            Auth.login(data.data.data.token, data.data.data);
            this.$toast.success("Login Successfully");
            if (data.data.data.type == this.$constants.TALENT) {
              this.$router
                .push({
                  name: "NewJobMatch",
                })
                .then(() => {
                  this.$router.go();
                });
            } else if (data.data.data.type == this.$constants.EMPLOYER) {
              this.$router
                .push({
                  name: "NewTalentMatch",
                })
                .then(() => {
                  this.$router.go();
                });
            } else {
              this.$router
                .push({
                  name: "EmployersPage",
                })
                .then(() => {
                  this.$router.go();
                });
            }
          }
        })
        .catch((error) => {
          this.isLoading = false;
          console.log("error", error);
          this.$toast.error(error.response.data.message);
        });
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
                } else if (response.data.data.type == this.$constants.EMPLOYER) {
                  this.$router
                    .push({
                      name: "NewTalentMatch",
                    })
                    .then(() => {
                      this.$router.go();
                    });
                } else {
                  this.$router
                    .push({
                      name: "EmployersPage",
                    })
                    .then(() => {
                      this.$router.go();
                    });
                }
              })
              .catch((error) => {

                this.setLocalStorage(data);
                console.log("here it comes before redirect");
                this.$router
                  .push({
                    name: "SelectRolePage",
                  });
              });
          });
      });
    },
    toggleShow() {
        this.passwordFieldType = this.passwordFieldType == 'password' ? 'text' : 'password';
    },
    setLocalStorage(data) {
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
      localStorage.setItem("hasTriedLogin", true);
      // this.$router.push("/getIn");
    },
  },
};
</script>
<template>
  <section class="main__login login-main">
    <div class="main__login-container">
      <div class="login__logo">
        <router-link :to="{ name: 'Login' }">
          <img
            src="../../assets/images/talent-images/login_logo.png"
            alt="main_logo"
          />
        </router-link>
        
      </div>
      <div class="login__form-container">
        <Form @submit="onsubmit" :validation-schema="schema">
          <h1>Hi, Welcome Back</h1>
          <fieldset class="login__fields name__field d__flex">
            <label for="login__name">Email <span>*</span></label>
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
          <fieldset class="login__fields name__field d__flex">
            <label for="login__password">Password <span>*</span></label>
            <div class="input__wrapper">
              <Field
                id="login__password"
                v-model="data.password"
                :type="passwordFieldType"
                name="password"
                placeholder="Enter the password"
              />
              <button type="button" class="button" @click="toggleShow">
                <img :src="eyeIcon" />
              </button>
            </div>
            <ErrorMessage name="password" class="error_message" />
          </fieldset>
          <div class="forget__password">
            <router-link :to="{ name: 'ForgetPassword' }"
              >Forgot password?</router-link
            >
          </div>
          <button class="submit__btn" type="submit">Log In</button>
          <div
            v-if="isRecruiter != true && isAdmin != true"
            class="g-login google__login"
          >
            <a @click="socialSignUp">
              <img
                src="../../assets/images/talent-images/Button.png"
                alt="googleloginbutton"
              />
            </a>
          </div>
          <div
            v-if="isRecruiter != true && isAdmin != true"
            class="register__now"
          >
            <p style="font-weight:500">
              Not registered yet?
              <router-link :to="{ name: 'SelectRolePage' }"
                > Sign Up Free Today!
</router-link
              >
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
          <p>Copyright © 2023, chirrrp.</p>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
.error_message {
  color: rgb(255, 0, 0);
  padding: auto;
  margin: 10px;
}
.g-login {
  cursor: pointer;
}
label > span {
  color:red;
}
</style>
