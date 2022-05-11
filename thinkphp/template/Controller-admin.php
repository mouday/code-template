<?php

namespace {{thinkphp.namespace}};

use app\BaseController;
use app\common\StatusEnum;
use app\exception\AppException;
use app\exception\NotFoundException;
use app\model\{{thinkphp.model}};
use app\service\{{thinkphp.service}};
use app\middleware\PermissionMiddleware;
use app\middleware\TokenRequireMiddleware;
use app\validate\{{thinkphp.validate}};


/**
 * Class {{thinkphp.controller}}
 * @package {{thinkphp.namespace}}
 * @created {{time.fullYear}}-{{time.format_month}}-{{time.format_date}}
 */
class {{thinkphp.controller}} extends BaseController
{

    protected $middleware = [
        TokenRequireMiddleware::class => [
            'except' => [
            ]
        ],
        PermissionMiddleware::class => [
            'except' => [
            ]
        ]
    ];
    /**
     * 获取列表
     */
    public function get{{thinkphp.pascal_name}}List()
    {
        $current_user_id = request()->userId;

        $params = [
            'keyword' => input('keyword'),
            'page'    => input('page', 1),
            'size'    => input('size', 20)
        ];

        $total = {{thinkphp.model}}::queryWhere($params)->count();

        $list = {{thinkphp.model}}::queryWhere($params)
            ->order([
                'order_value' => 'desc',
                'create_time' => 'desc'
            ])
            ->page($params['page'], $params['size'])
            ->select();

        return [
            'list'  => $list,
            'total' => $total
        ];
    }

    /**
     * 获取详情
     */
    public function get{{thinkphp.pascal_name}}ById() {
        $id              = input('id');
        $current_user_id = request()->userId;

        $result = {{thinkphp.model}}::where([
                'id'=> $id,
            ])->find();

        if (!$result) {
            throw new NotFoundException();
        }

        return $result;
    }

    /**
     * 更新数据
     */
    public function update{{thinkphp.pascal_name}}ById()
   {
        $current_user_id = request()->userId;

        $params          = input('');

        validate({{thinkphp.validate}}::class)
            ->scene('update')
            ->check($params);

        $result = {{thinkphp.model}}::where([
            'id'=> $params['id']
        ])->find();

        if (!$result) {
            throw new NotFoundException();
        }

         $where = [
             'id' => $result['id']
         ];

         $allowField = [
            {%- for item in table.columns %}
            // {{item.comment}}
            '{{item.name}}',
            {%- endfor %}
        ];

         {{thinkphp.model}}::update($params, $where, $allowField);
    }

    /**
     * 删除数据
     */
    public function delete{{thinkphp.pascal_name}}ById()
    {
        $id      = input('id');
        $current_user_id = request()->userId;

         $result = {{thinkphp.model}}::where([
            'id'=> $id
        ])->find();

        if (!$result) {
            throw new NotFoundException();
        }

        {{thinkphp.model}}::where('id', '=', $id)->delete();
    }

    /**
     * 添加数据
     */
    public function add{{thinkphp.pascal_name}}()
    {

        $current_user_id = request()->userId;

        $params = [
            {%- for item in table.columns %}
              // {{item.comment}}
              "{{item.name}}"=> input("{{item.name}}", ''),
            {%- endfor %}
            'user_id'        => $current_user_id,
            // 状态：0不显示/1显示
            "status"        => input("status", StatusEnum::PUBLIC),
            // 分类排序
            "order_value"   => time()
        ];

        validate({{thinkphp.validate}}::class)
            ->scene('add')
            ->check($params);

        $result = {{thinkphp.model}}::create($params);

        return $result;
    }
}
