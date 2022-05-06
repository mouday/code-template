# more-copy创建指令
.PHONY: model validate controller-mini controller-admin model service service-test create-all

# 定义变量
name = ''

# make controller-api name=
controller-api:
	mcp template/Controller-api.php app/api/controller/$(name)_controller.php -p '{"name": "$(name)", "table": "tb_$(name)"}'
	mcp template/Controller.http tests/http/api/$(name)_controller.http -p '{"name": "$(name)",  "table": "tb_$(name)"}'

# make controller-admin name=
controller-admin:
	mcp template/Controller-admin.php app/admin/controller/$(name)_controller.php -p '{"name": "$(name)", "table": "tb_$(name)"}'

# make model name=
model:
	mcp template/Model.php app/model/$(name)_model.php -p '{"name": "$(name)"}'

# make service name=
service:
	mcp template/Service.php app/service/$(name)_service.php -p '{"name": "$(name)", "table": "tb_$(name)"}'

# make service-test name=
service-test:
	mcp template/ServiceTest.php tests/service/$(name)_service_test.php -p '{"name": "$(name)", "table": "tb_$(name)"}'

# make validate name=user_name
validate:
	mcp template/Validate.php app/validate/$(name)_validate.php -p '{"name": "$(name)", "table": "tb_$(name)"}'


# make create-all name=
create-all:
	make model
	make service
	make service-test
	make controller-admin
	make controller-api
	make validate
