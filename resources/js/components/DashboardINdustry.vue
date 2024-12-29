<template>
  <section class="select__role selct__industry">
    <div class="role__container">
      <h1 class="text__center">Select an Industry!</h1>
      <div class="regsiter_form_holder select__industryFormWrapper">
        <form action="#" class="">
          <div class="indutry__holder">
            <fieldset>
              <input
                type="checkbox"
                name="Technology/Engineering"
                value=""
                id="indutsry__Technology/Engineering"
              />
              <label for="indutsry__Technology/Engineering"
                >Technology/Engineering</label
              >
            </fieldset>
            <fieldset>
              <input
                type="checkbox"
                checked
                name="Marketing/Content"
                value=""
                id="indutsry__Marketing/Content"
              />
              <label for="indutsry__Marketing/Content">Marketing/Content</label>
            </fieldset>
            <fieldset>
              <input
                type="checkbox"
                name="Marketing/Content"
                value=""
                id="indutsry__Businsess/Finance"
              />
              <label for="indutsry__Businsess/Finance">Businsess/Finance</label>
            </fieldset>
            <fieldset>
              <input
                type="checkbox"
                name="Creative/Design"
                value=""
                id="indutsry__Creative/Design"
              />
              <label for="indutsry__Creative/Design">Creative/Design</label>
            </fieldset>
          </div>
        </form>
      </div>
    </div>
  </section>
</template>
<script>
export default {
  name: "DashboardIndustry",
};
</script>
