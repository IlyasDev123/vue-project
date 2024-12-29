<template>
  <h2 style="margin-bottom:50px;font-size:32px">Are you looking to hire or get hired?</h2>
  <div class="regsiter_form_holder">
    <form action="#" class="d__flex d__flex-v-center d__flex-h-between">
      <fieldset class="fieldset__role role__jobseeker">
        <input
          type="radio"
          id="jobseeker"
          name="role"
          v-model="type"
          value="1"
          @click="onChange(1)"
        />
        <div class="check__img--holder check__img--jobseeker">
          <label for="jobseeker">
            <img
              src="@/assets/images/talent-images/job-seeker.png"
              alt="jobseeker"
            />
          </label>
        </div>
      </fieldset>
      <fieldset class="fieldset__role role__employeer">
        <input
          type="radio"
          id="employeer"
          name="role"
          v-model="type"
          value="2"
          @click="onChange(2)"
        />
        <div class="check__img--holder check__img--employeer">
          <label for="employeer">
            <img
              src="@/assets/images/talent-images/employer.png"
              alt="employeer"
            />
          </label>
        </div>
      </fieldset>
    </form>
  </div>
  <div class="role__btn">
    <router-link
      :to="{ name: this.nextRoute }"
      class="arrow__anchor arrow__next"
      v-show="type" v-if="registerRoute"
    >
      <svg
        width="31"
        height="20"
        viewBox="0 0 31 20"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          d="M20.8442 0.000182867C21.0876 0.00727869 21.3188 0.108847 21.4887 0.283386L30.2387 9.03339C30.4144 9.20921 30.5132 9.44763 30.5132 9.69623C30.5132 9.94483 30.4144 10.1832 30.2387 10.3591L21.4887 19.1091C21.4023 19.199 21.2988 19.2709 21.1843 19.3204C21.0698 19.3698 20.9466 19.396 20.8219 19.3973C20.6972 19.3985 20.5735 19.3749 20.458 19.3277C20.3425 19.2806 20.2376 19.2109 20.1494 19.1227C20.0612 19.0345 19.9915 18.9296 19.9443 18.8141C19.8972 18.6986 19.8736 18.5749 19.8748 18.4502C19.8761 18.3255 19.9022 18.2022 19.9517 18.0877C20.0012 17.9732 20.073 17.8698 20.163 17.7834L27.3127 10.6337H8.95085C8.82662 10.6355 8.70328 10.6125 8.588 10.5662C8.47272 10.5199 8.36779 10.4511 8.27932 10.3639C8.19085 10.2766 8.12059 10.1727 8.07264 10.0581C8.02469 9.94347 8 9.82047 8 9.69623C8 9.57199 8.02469 9.44898 8.07264 9.33436C8.12059 9.21975 8.19085 9.11581 8.27932 9.02858C8.36779 8.94135 8.47272 8.87257 8.588 8.82625C8.70328 8.77992 8.82662 8.75697 8.95085 8.75873H27.3127L20.163 1.60907C20.0278 1.47735 19.9354 1.30786 19.8981 1.1228C19.8608 0.937731 19.8802 0.745705 19.9538 0.57185C20.0274 0.397995 20.1517 0.25041 20.3106 0.148411C20.4695 0.0464109 20.6554 -0.00525228 20.8442 0.000182867Z"
          fill="#3D70E0"
        ></path>
        <path
          d="M5 9.74902H1"
          stroke="#7FCEFA"
          stroke-width="1.9"
          stroke-linecap="round"
          stroke-linejoin="round"
        ></path>
      </svg>
    </router-link>
  </div>
</template>
<script>
export default {
  name: "SelectSignUpRole",
  props: {
    nextRouteName: String,
    previosRouteName: String,
  },
 created() {
    let formData = this.$functions.getLocalStorage("mutlistepfm") || [];
  },
  data() {
    return {
      type: "",
      registerRoute: true,
      nextRoute: this.nextRouteName
    };
  },
  methods: {
    onChange(payload) {
      const data = {
        type: payload,
      };
      
      if(localStorage.getItem("hasTriedLogin")){
        
        const newDataUsers = JSON.parse(localStorage.getItem("mutlistepfm"));
        let users = { ...newDataUsers, ...data };
        localStorage.setItem("mutlistepfm", JSON.stringify(users));
        // localStorage.removeItem("hasTriedLogin");

        payload == 2 ? this.nextRoute = "GetIN" : this.nextRoute = this.nextRouteName;
      }
      else{
        localStorage.setItem("mutlistepfm", JSON.stringify(data));
      }
    }
  },
};
</script>
