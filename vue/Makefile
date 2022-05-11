# more-copy创建指令
.PHONY: list edit all

# 定义变量
name = ''

# make list name=
list:
	mcp template/list/index.vue src/views/$(name)-list/index.vue -p '{"name": "$(name)", "table": "tb_$(name)"}'
	mcp template/list/DataTable.vue src/views/$(name)-list/DataTable.vue -p '{"name": "$(name)", "table": "tb_$(name)"}'

# make edit name=
edit:
	mcp template/edit/index.vue src/views/$(name)-edit/index.vue -p '{"name": "$(name)", "table": "tb_$(name)"}'
	mcp template/edit/DataForm.vue src/views/$(name)-edit/DataForm.vue -p '{"name": "$(name)", "table": "tb_$(name)"}'

# make all name=
all:
	make list
	make edit
