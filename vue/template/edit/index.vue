<template>
  <div class="app-container">
    <DataForm
      v-if="show_form"
      :row="detail"
      @on-success="handleSuccess"
    ></DataForm>
  </div>
</template>

<script>
// created at 2022-02-18
import DataForm from './DataForm.vue';

export default {
  name: 'index',

  props: {},

  components: {
    DataForm,
  },

  data() {
    return {
      id: null,
      detail: null,
      show_form: false,
    };
  },

  computed: {},

  methods: {
    async getData() {
      const res = await this.$http.post(
        '{{thinkphp.api.getById}}', {
        id: this.id,
      });

      if (res.code == 0) {
        this.detail = res.data;
        this.show_form = true;
      } else {
        this.$msg.error(res.msg);
      }
    },

    handleSuccess() {},
  },

  created() {
    this.id = this.$route.query.id;
    if (this.id) {
      this.getData();
    } else {
      this.show_form = true;
    }
  },
};
</script>

<style lang="less">
</style>

<style lang="less" scoped>
</style>
