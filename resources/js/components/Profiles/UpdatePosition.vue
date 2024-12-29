<template>
  <form action="#">
    <fieldset class="role__fieldset fieldset__name">
      <input type="text" placeholder="First name" />
    </fieldset>
    <fieldset class="role__fieldset fieldset__experienceYear">
      <input type="number" placeholder="Years of Experience" />
    </fieldset>
    <fieldset class="role__fieldset fieldset__currentRole">
      <input type="text" placeholder="Your Current Role" />
    </fieldset>
    <fieldset
      class="role__fieldset fieldset__state filedStyle__BUttons"
      data-behaviour="toggle"
    >
      <div class="hieen__fieldsLabel">select Your State</div>
      <div class="hidden__fieldsWrapper" style="">
        <div class="hidden_flex_holder">
          <div class="fild__checkbox_area">
            <input type="radio" name="state" id="state_USA" />
            <label for="state_USA">USA</label>
          </div>
          <div class="fild__checkbox_area">
            <input type="radio" name="state" id="state_UK" />
            <label for="state_UK">UK</label>
          </div>
          <div class="fild__checkbox_area">
            <input type="radio" name="state" id="state_au" />
            <label for="state_au">Aurstalia</label>
          </div>
          <div class="fild__checkbox_area">
            <input type="radio" name="state" id="state_ca" />
            <label for="state_ca">Canada</label>
          </div>
        </div>
      </div>
    </fieldset>
    <fieldset
      class="role__fieldset fieldset__WorkLocation filedStyle__dropDown"
      data-behaviour="toggle"
    >
      <div class="hieen__fieldsLabel">Work Location Preference</div>
      <div class="hidden__fieldsWrapper" style="">
        <div class="hidden_flex_holder">
          <div class="fild__checkbox_area">
            <input type="radio" name="workLocation" id="location__Hybrid" />
            <label for="location__Hybrid">Hybrid</label>
          </div>
          <div class="fild__checkbox_area">
            <input type="radio" name="workLocation" id="location__In-Office" />
            <label for="location__In-Office">In-Office</label>
          </div>
          <div class="fild__checkbox_area">
            <input type="radio" name="workLocation" id="location__remote" />
            <label for="location__remote">Remote</label>
          </div>
          <div class="fild__checkbox_area">
            <input type="radio" name="workLocation" id="location__Any" />
            <label for="location__Any">Any</label>
          </div>
        </div>
      </div>
    </fieldset>
    <fieldset
      class="role__fieldset fieldset__WorkLocation filedStyle__dropDown"
      data-behaviour="toggle"
    >
      <div class="hieen__fieldsLabel">Any Experience Level Preferences?</div>
      <div class="hidden__fieldsWrapper" style="">
        <div class="hidden_flex_holder">
          <div class="fild__checkbox_area">
            <input
              type="radio"
              name="experienceLevel"
              id="experience_beigner"
            />
            <label for="experience_beigner">Beigner Level</label>
          </div>
          <div class="fild__checkbox_area">
            <input type="radio" name="experienceLevel" id="experience_mid" />
            <label for="experience_mid">Mid Level</label>
          </div>
          <div class="fild__checkbox_area">
            <input
              type="radio"
              name="experienceLevel"
              id="experience_advance"
            />
            <label for="experience_advance">Experience Level</label>
          </div>
        </div>
      </div>
    </fieldset>
    <fieldset
      class="role__fieldset fieldset__WorkLocation filedStyle__dropDown"
      data-behaviour="toggle"
    >
      <div class="hieen__fieldsLabel">
        What's the most important thing to you when selecting <br />a new
        employer?
      </div>
      <div class="hidden__fieldsWrapper" style="">
        <div class="hidden_flex_holder">
          <div class="fild__checkbox_area">
            <input type="radio" name="hiring" id="hiring-CompanyCulture" />
            <label for="hiring-CompanyCulture">Company Culture</label>
          </div>
          <div class="fild__checkbox_area">
            <input type="radio" name="hiring" id="hiring-Work-LifeBalance" />
            <label for="hiring-Work-LifeBalance">Work-Life Balance</label>
          </div>
          <div class="fild__checkbox_area">
            <input type="radio" name="hiring" id="hiring-GrowthOpportunities" />
            <label for="hiring-GrowthOpportunities">Growth Opportunities</label>
          </div>
          <div class="fild__checkbox_area">
            <input type="radio" name="hiring" id="hiring-PayBenefits" />
            <label for="hiring-PayBenefits">Pay/Benefits</label>
          </div>
        </div>
      </div>
    </fieldset>
    <fieldset
      class="role__fieldset fieldset__WorkLocation filedStyle__dropDown"
      data-behaviour="toggle"
    >
      <div class="hieen__fieldsLabel">
        How would your coworkers describe you?
      </div>
      <div class="hidden__fieldsWrapper" style="">
        <div class="hidden_flex_holder">
          <div class="fild__checkbox_area">
            <input type="radio" name="coworkers" id="coworkers-Trusting" />
            <label for="coworking-Trusting">Trusting</label>
          </div>
          <div class="fild__checkbox_area">
            <input type="radio" name="coworkers" id="coworkers-Knowledgable" />
            <label for="coworking-Knowledgable">Knowledgable</label>
          </div>
          <div class="fild__checkbox_area">
            <input type="radio" name="coworkers" id="coworkers-Dependable" />
            <label for="coworking-Dependable">Dependable</label>
          </div>
          <div class="fild__checkbox_area">
            <input type="radio" name="coworkers" id="coworkers-Easy-Going" />
            <label for="coworking-Easy-Going">Easy-Going</label>
          </div>
          <div class="fild__checkbox_area">
            <input type="radio" name="coworkers" id="coworkers-Ambitious" />
            <label for="coworking-Ambitious">Ambitious</label>
          </div>
          <div class="fild__checkbox_area">
            <input type="radio" name="coworkers" id="coworkers-Energetic" />
            <label for="coworking-Energetic">Energetic</label>
          </div>
        </div>
      </div>
    </fieldset>
    <fieldset
      class="role__fieldset fieldset__WorkLocation filedStyle__dropDown"
      data-behaviour="toggle"
    >
      <div class="hieen__fieldsLabel">
        What do you enjoy doing in your free time?
      </div>
      <div class="hidden__fieldsWrapper" style="">
        <div class="fild__checkbox_area">
          <input type="radio" name="enjoy" id="enjoy-Cooking" />
          <label for="enjoy-Cooking">Cooking</label>
        </div>
        <div class="fild__checkbox_area">
          <input type="radio" name="enjoy" id="enjoy-MakingMusic" />
          <label for="enjoy-MakingMusic">Making Music</label>
        </div>
        <div class="fild__checkbox_area">
          <input type="radio" name="enjoy" id="enjoy-HomeImprovements" />
          <label for="enjoy-HomeImprovements">Home Improvements</label>
        </div>
        <div class="fild__checkbox_area">
          <input type="radio" name="enjoy" id="enjoy-family" />
          <label for="enjoy-family"
            >Spending time with friends &amp; family</label
          >
        </div>
        <div class="fild__checkbox_area">
          <input type="radio" name="enjoy" id="enjoy-gaming" />
          <label for="enjoy-gaming">Playing Video Games</label>
        </div>
        <div class="fild__checkbox_area">
          <input type="radio" name="enjoy" id="enjoy-gaming" />
          <label for="enjoy-gaming">Playing Video Games</label>
        </div>
        <div class="fild__checkbox_area">
          <input type="radio" name="enjoy" id="enjoy-movies" />
          <label for="enjoy-movies">Watching Movies</label>
        </div>
        <div class="fild__checkbox_area">
          <input type="radio" name="enjoy" id="enjoy-reading" />
          <label for="enjoy-reading">Watching Reading</label>
        </div>
      </div>
    </fieldset>
    <div class="big__blutBtnHolder text__center max__100">
      <a href="#" class="big__blutBtn">Save Changes</a>
    </div>
  </form>
</template>
