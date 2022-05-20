<template>
  <div class="app-container">
    <!-- 工具栏 -->
    <div class="data-tool">
      <el-button size="mini" @click="handleAddClick">添加</el-button>

      <el-input
        placeholder="请输入内容"
        v-model="keyword"
        style="width: 220px"
        @keypress.enter.native="handleSearch"
      >
        <el-button
          slot="append"
          icon="el-icon-search"
          @click="handleSearch"
        ></el-button>
      </el-input>
    </div>

    <!-- 表格 -->
    <DataTable
      class="data-table"
      :data="list"
      v-loading="loading"
      @on-success="getData"
      @on-edit-row="handleEditRow"
      @on-move-up="handleMoveUp"
      @on-move-down="handleMoveDown"
    ></DataTable>

    <!-- 分页 -->
    <mo-pagination
      :total="total"
      :page-size.sync="size"
      :current-page.sync="page"
      @change="getData"
    />

    <!-- 编辑 -->
    <el-dialog
      :title="currentRow ? '编辑': '添加'"
      :visible.sync="visible_eidt_dialog"
      width="350px"
      center
    >
      <DataForm
        v-if="visible_eidt_dialog"
        :row="currentRow"
        @on-success="handleEditSuccess"
        @on-cancel="handleEditCancel"
      ></DataForm>
    </el-dialog>
  </div>
</template>

<script>
/**
 * created {{time.fullYear}}-{{time.format_month}}-{{time.date}}
 */
import DataTable from './DataTable.vue';
import DataForm from '@/views/{{naming.hyphen}}-edit/DataForm.vue';

export default {
  name: '',

  components: { DataTable, DataForm },

  data() {
    return {
      list: [],
      loading: true,
      page: 1,
      size: 20,
      total: 0,
      keyword: '',

      visible_eidt_dialog: false,
      currentRow: null,
    };
  },

  created() {
    this.getData();
  },

  computed: {},

  methods: {
    resetData() {
      this.page = 1;
      this.getData();
    },

    handleSearch() {
      this.resetData();
    },

    async getData() {
      this.loading = true;

      const res = await this.$http.post('{{thinkphp.api.getList}}', {
        page: this.page,
        size: this.size,
        keyword: this.keyword,
      });

      this.list = res.data.list.map((item, index, arr) => {
        item.index = index;
        // 禁用首尾移动
        if (index == 0) {
          item.disabled_move_up = true;
        }
        if (index == arr.length - 1) {
          item.disabled_move_down = true;
        }

        return item;
      });
      this.total = res.data.total;

      this.loading = false;
    },

    handleEditRow(row) {
      // this.$router.push({
      //   name: '{{naming.hyphen}}-edit',
      //   query: { id: row.id },
      // });

      this.currentRow = row;
      this.visible_eidt_dialog = true;
    },

    handleAddClick() {
      // this.$router.push({
      //   name: '{{naming.hyphen}}-edit',
      // });

      this.currentRow = null;
      this.visible_eidt_dialog = true;
    },

    handleEditSuccess() {
      this.visible_eidt_dialog = false;
      this.getData();
    },

    handleEditCancel() {
      this.visible_eidt_dialog = false;
    },

    handleMoveDown(row) {
      let target = null;

      for (let i = row.index + 1; i < this.list.length; i++) {
        target = this.list[i];
        break;
      }

      this.handleMove(row, target);
    },

    handleMoveUp(row) {
      console.log(row);
      // let target = this.list[row.index - 1];

      let target = null;
      for (let i = row.index - 1; i >= 0; i--) {
        target = this.list[i];
        break;
      }

      this.handleMove(row, target);
    },

    async handleMove(from, to) {
      let loading = this.$loading({ fullscreen: true });

      await this.$http.post('{{thinkphp.api.updateById}}', {
        id: from.id,
        order_value: to.order_value,
      });

      await this.$http.post('{{thinkphp.api.updateById}}', {
        id: to.id,
        order_value: from.order_value,
      });

      this.$nextTick(() => {
        // 以服务的方式调用的 Loading 需要异步关闭
        loading.close();
      });

      this.getData();
    },
  },
};
</script>

<style lang="less"></style>

<style lang="less" scoped>
.data-tool{
  display: flex;
  justify-content: space-between;
}

.data-table {
  margin-top: 20px;
}
</style>

