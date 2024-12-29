<template>
  <EmployersCv />
  <TableViewThree />
</template>

<script>
import EmployersCv from "@/components/EmployersCv.vue";
import TableViewThree from "@/components/TableViewThree.vue";

export default {
  components: {
    EmployersCv,
    TableViewThree,
  },

  data() {
    return {
      positionId: null,
      companyId: null,
    };
  },
};
</script>

<style lang="scss" scoped>
</style>
