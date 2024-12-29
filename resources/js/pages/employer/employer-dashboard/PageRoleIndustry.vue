<template>
  <section class="select__role selct__industry">
    <div class="role__container">
      <h1 class="text__center">Select an Industry!</h1>

      <div class="regsiter_form_holder select__industryFormWrapper">
        <form action="#" class="">
          <div class="indutry__holder">
            <fieldset v-for="industry in industries" :key="industry.id">
              <input
                type="radio"
                name="id"
                :value="industry.id"
                v-model="id"
                :id="`indutsry__${industry.name}`"
                :checked="industry.id == id"
                @change="onChange"
              />
              <label :for="`indutsry__${industry.name}`">
                {{ industry.name }}</label
              >
            </fieldset>
          </div>
        </form>
      </div>
      <!-- ============ next Prev Buttons ====== -->
      <!-- ============ next Prev Buttons ====== -->
      <NextPreviousButton
        previousRouteName="EmployerBack"
        nextRouteName="EmployerSelectNewRole"
        :hasRouteAccess="hasRouteAccess"
      />
    </div>
  </section>
</template>
<script>
import NextPreviousButton from "../../../components/Buttons/NextPreviousButton.vue";
import { mapMutations, mapState, mapActions } from "vuex";
export default {
  name: "PageRoleIndustry",
  components: {
    NextPreviousButton,
  },
  computed: {
    ...mapState("chirrrpMeta", {
      industryID: (state) => state.chirrrpMeta.industries[0].id,
      industries: (state) => state.chirrrpMeta.industries,
    }),
  },
  created() {
    let formData = this.$functions.getLocalStorage("mutlistepfm") || [];
    this.id = formData
      ? formData.industryId
      : this.$store.state.chirrrpMeta.industryID;
  },

  data() {
    return {
      isChecked: false,
      id: this.$store.state.chirrrpMeta.industryID,
      hasRouteAccess:true
    };
  },
  methods: {
    onChange() {
      this.INDUSTRY_ID({
        id: this.id,
      });
      let payload = {
        industryId: this.id,
      };
      this.$functions.setLocalStorage("mutlistepfm", payload);
    },

    ...mapMutations("chirrrpMeta", ["INDUSTRY_ID"]),
  },
};
</script>


