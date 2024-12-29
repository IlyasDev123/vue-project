<template>
  <div class="filter__box">
    <div class="filter__btn" @click="filterShow">
      <svg
        width="40"
        height="42"
        viewBox="0 0 40 42"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
      >
        <rect
          x="0.5"
          y="0.5"
          width="39"
          height="41"
          rx="7.5"
          stroke="#C0C9DB"
        />
        <path
          d="M17.8601 21.2941V21.0958L17.7242 20.9514L10.8201 13.6163V12.3799H29.1801V13.6163L22.276 20.9514L22.1401 21.0958V21.2941V31.5738L17.8601 29.0058V21.2941Z"
          fill="#4294FF"
          stroke="#4294FF"
        />
      </svg>
    </div>

    <div class="filter__dropdown visible" v-show="isShowFilter">
      <ul class="filter__dropdown-items">
        <li
          class="filter__dropdown-item"
          v-for="filter in filters"
          :key="filter.id"
        >
          <div class="filter__dropdown-item-radio">
            <input
              type="radio"
              id="employeeStstus.id"
              name="radio-group"
              @input="onChange(filter.id)"
            />
            <label for="t1">{{ filter.name }}</label>
          </div>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
  name: "Filter",
  props: {
    filters: Object,
  },
  created() {
    window.addEventListener("click", (e) => {
      if (!this.$el.contains(e.target)) {
        this.isShowFilter = false;
      }
    });
  },
  data() {
    return {
      statusToSend: null,
      isShowFilter: false,
    };
  },
  methods: {
    filterShow() {
      this.isShowFilter = this.isShowFilter == false ? true : false;
    },
    onChange(value) {
      this.statusToSend = value;
      this.$emitter.emit("fullAccessFilter", this.statusToSend);
    },
  },
};
</script>

<style lang="scss" scoped></style>
