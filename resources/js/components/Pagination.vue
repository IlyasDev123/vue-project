<template>
    <div class="pagination">
      <button class="btn" :disabled="!previousPage" @click="previous">Previous</button>&nbsp;
      <button class="btn" :disabled="!nextPage" @click="next">Next</button>
    </div>
    <div class="records" v-if="fromPage">
        <p>{{ fromPage + ' - ' + toPage + ' / ' + totalPage }}</p>
    </div>
</template>

<script>

export default {
    name : "Pagination",
    data() {
        return {
        }
    },
    props : {
        previousPage: Number,
        nextPage: Number,
        totalPage: Number,
        fromPage: Number,
        toPage: Number,
    },
    methods: {
        previous() {
            this.$emit("getPage", this.previousPage);
        },
        next() {
            this.$emit("getPage", this.nextPage);
        }
    }
}

</script>

<style scoped>
.pagination {
    text-align: center;
    justify-content: center;
    margin-top: 10px;
}
.records{
    text-align: center;
    margin-top: 10px;
}

.records p{
    font-size: 15px;
    font-family: 'Roboto';
    font-weight: 500;
    color: var(--storm-blue-color);
}
</style>