<template>
  <mo-table
    v-bind="$attrs"
    v-on="$listeners"
  >
  {% raw %}
   <el-table-column label="ID" align="center" prop="id" width="60">
      <template slot-scope="scope">{{ scope.row.id || '-' }}</template>
    </el-table-column>
  {% endraw %}

    {% for item in table.columns %}
    <!-- {{item.comment}} -->
    <el-table-column
      label="{{item.comment or item.name }}"
      align="center"
      prop="{{ item.name }}"
    >
      <template slot-scope="scope">
        {% raw %} {{ scope.row.{% endraw %}{{ item.name }} {% raw %} || '-' }} {% endraw %}
      </template>
    </el-table-column>
    {% endfor %}

    <!-- 排序 -->
    <el-table-column label="上移" width="60" align="center">
      <template slot-scope="scope">
        <el-button
          :disabled="scope.row.disabled_move_up"
          type="text"
          size="mini"
          icon="el-icon-top"
          @click="$emit('on-move-up', scope.row)"
        ></el-button>
      </template>
    </el-table-column>

    <el-table-column label="下移" width="60" align="center">
      <template slot-scope="scope">
        <el-button
          :disabled="scope.row.disabled_move_down"
          type="text"
          size="mini"
          icon="el-icon-bottom"
          @click="$emit('on-move-down', scope.row)"
        ></el-button>
      </template>
    </el-table-column>

    <el-table-column
      label="状态"
      align="center"
      width="80"
    >
      <template slot-scope="scope">
        <mo-switch
          v-model="scope.row.status"
          @change="handleStatusChange(scope.row, $event)"
        ></mo-switch>
      </template>
    </el-table-column>

    <el-table-column
      label="编辑"
      width="60"
      align="center"
    >
      <template slot-scope="scope">
        <mo-edit-button @click="handleEditRow(scope.row)"></mo-edit-button>
      </template>
    </el-table-column>

    <el-table-column
      label="删除"
      width="60"
      align="center"
    >
      <template slot-scope="scope">
        <mo-delete-button
          @confirm="handleComfirmDelete(scope.row)"
          :disabled="scope.row.disabled_delete"
        ></mo-delete-button>
      </template>
    </el-table-column>

  </mo-table>
</template>

<script>
/**
 * created {{time.fullYear}}-{{time.format_month}}-{{time.date}}
 */
export default {
  name: '',

  props: [],

  components: {},

  data() {
    return {};
  },

  filters: {},

  computed: {},

  methods: {
    // 编辑
    handleEditRow(row) {
      this.$emit('on-edit-row', row);
    },

    // 删除
    async handleDeleteRow(row) {
      const res = await this.$http.post('{{vue.api.deleteById}}', {
        id: row.id,
      });

      if (res.code == 0) {
        this.$msg.success('操作成功');
        this.$emit('on-success');
      } else {
        this.$msg.error(res.msg);
      }
    },

    async handleStatusChange(row, status) {
      const res = await this.$http.post('{{vue.api.updateById}}', {
        id: row.id,
        status,
      });

      if (res.code == 0) {
        this.$msg.success('操作成功');
        // this.$emit('on-success');
      } else {
        this.$msg.error(res.msg);
      }
    },

    async handleComfirmDelete(row) {
      const res = await this.$http.post(
        '{{thinkphp.api.deleteById}}',
        {
          id: row.id,
        }
      );

      if (res.code == 0) {
        this.$msg.success('操作成功');
        this.$emit('on-success');
      } else {
        this.$msg.error(res.msg);
      }
    },
  },

  created() {

  },
};
</script>

<style lang="less" >
</style>

<style lang="less" scoped>
</style>
