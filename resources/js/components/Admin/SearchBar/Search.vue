<template>
  <svg
    class="open_search"
    width="18"
    height="18"
    viewBox="0 0 18 18"
    fill="none"
    xmlns="http://www.w3.org/2000/svg"
    @click="searchShow"
  >
    <path
      d="M12.5 11H11.71L11.43 10.73C12.41 9.59 13 8.11 13 6.5C13 2.91 10.09 0 6.5 0C2.91 0 0 2.91 0 6.5C0 10.09 2.91 13 6.5 13C8.11 13 9.59 12.41 10.73 11.43L11 11.71V12.5L16 17.49L17.49 16L12.5 11ZM6.5 11C4.01 11 2 8.99 2 6.5C2 4.01 4.01 2 6.5 2C8.99 2 11 4.01 11 6.5C11 8.99 8.99 11 6.5 11Z"
      fill="#3A3541"
      fill-opacity="0.87"
    />
  </svg>
  <!-- Search Popup -->
  <div class="search_block visible" v-show="isShowSearch">
    <div class="search_box">
      <div class="inner">
        <input
          type="text"
          name="search"
          id="search"
          class="search_input"
          placeholder="Search here..."
          v-model="searchItem"
          @keypress.enter="onkeyPress"
        />
        <svg
          width="18"
          height="18"
          viewBox="0 0 18 18"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M12.5 11H11.71L11.43 10.73C12.41 9.59 13 8.11 13 6.5C13 2.91 10.09 0 6.5 0C2.91 0 0 2.91 0 6.5C0 10.09 2.91 13 6.5 13C8.11 13 9.59 12.41 10.73 11.43L11 11.71V12.5L16 17.49L17.49 16L12.5 11ZM6.5 11C4.01 11 2 8.99 2 6.5C2 4.01 4.01 2 6.5 2C8.99 2 11 4.01 11 6.5C11 8.99 8.99 11 6.5 11Z"
            fill="#3A3541"
            fill-opacity="0.87"
          />
        </svg>
      </div>
    </div>
    <div class="overlayer" @click="searchHide"></div>
  </div>
</template>

<script>
export default {
  name: "Search",

  data() {
    return {
      isShowSearch: false,
      searchValue: null,
      searchData: null,
      searchItem: null,
    };
  },

  methods: {
    searchShow() {
      this.isShowSearch = true;
    },
    searchHide() {
      this.isShowSearch = false;
    },

    onkeyPress() {
      this.$emitter.emit("globalSearch", this.searchItem);
      this.isShowSearch = false;
      this.searchItem = null;
    },
  },
};
</script>

<style lang="scss" scoped></style>
