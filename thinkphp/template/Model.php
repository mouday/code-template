<?php


namespace {{thinkphp.namespace}};


use think\Model;

/**
 * {{table.table_comment}}
 * Class {{thinkphp.model}}
 * @package {{thinkphp.namespace}}
 * @created {{time.fullYear}}-{{time.format_month}}-{{time.date}}
 */
class {{thinkphp.model}} extends Model
{
    protected $name = 'tb_{{thinkphp.table}}';

    // 多对一
    public function user()
    {
        return $this->belongsTo(UserModel::class, 'user_id');
    }

    /**
     * @param $query
     * @param null $where
     */
    public function scopeQueryWhere($query, $where = null)
    {

        $status  = array_get($where, 'status');
        $keyword = array_get($where, 'keyword');

        if (is_numeric($status)) {
            $query->where('status', '=', $status);
        }

        if ($keyword) {
            $query->where('title', 'like', "%${$keyword}%");
        }
    }
}
