<?php

namespace app\validate;

use think\Validate;

class {{thinkphp.validate}} extends Validate
{
    // 验证规则
    protected $rule = [
    {%- for item in table.columns %}
      // {{item.comment}}
     '{{item.name}}'      => ['require'],
    {%- endfor %}
    ];

    // 验证场景
    protected $scene = [
        // 添加
        'add' => [
            {%- for item in table.columns %}
             // {{item.comment}}
             '{{item.name}}',
            {%- endfor %}
            ],

        // 更新
        'update' => [
            {%- for item in table.columns %}
             // {{item.comment}}
             '{{item.name}}',
            {%- endfor %}
            ],
    ];

    // 错误信息
    protected $message = [
        {%- for item in table.columns %}
          // {{item.comment}}
         '{{item.name}}.require'      => ['{{item.comment}}不能为空'],
        {%- endfor %}
    ];

    // 自定义验证规则
    protected function checkDemo($value, $rule, $data = [])
    {
        return $rule == $value ? true : '名称错误';
    }

}