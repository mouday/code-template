<?php


namespace {{thinkphp.namespace}};


use think\Model;

/**
 * {{table.table_comment}}
 * Class {{thinkphp.model}}
 * @package {{thinkphp.namespace}}
 * @method $this queryWhere(array|null $where) static 条件查询
 * @see {{thinkphp.model}}::scopeQueryWhere()
 * @created {{time.date}}
 */
class {{thinkphp.model}} extends Model
{
    protected $name = '{{thinkphp.table}}';

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
            $query->whereLike('title', "%{$keyword}%");
        }
    }
}
