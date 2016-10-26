<?php namespace App\Models\Admin;

use App\Models\Admin\Base;

/**
 * 推荐位表模型
 *
 * @author jiang
 */
class Push extends Base
{
    /**
     * 推荐位数据表名
     *
     * @var string
     */
    protected $table = 'push';

    /**
     * 可以被集体附值的表的字段
     *
     * @var string
     */
    protected $fillable = array('id',  'user_id', 'data', 'status', 'create_time');

    /**
     * 推荐位未删除的标识
     */
    CONST STATUS = 0;

    //CONST IS_DELETE_YES = 0;

    //CONST IS_ACTIVE_YES = 1;
    
    /**
     * 取得未删除的推荐位信息
     *
     * @return array
     */
   // public function unDeletePosition()
    //{
        //$currentQuery = $this->orderBy('id', 'desc')->where('is_delete', self::IS_DELETE_NO)->paginate(15);
        //return $currentQuery;
    //}

    /**
     * 取得未删除，已激活的推荐位信息
     *
     * @return array
     */
    public function allPush()
    {
        $currentQuery = $this->orderBy('id', 'desc')->paginate(15);
        return $currentQuery;
    }

    /**
     * 增加文章推荐位
     * 
     * @param array $data 所需要插入的信息
     */
    public function addPush(array $data)
    {
        return $this->create($data);
    }



    /**
     * 修改文章推荐位
     * 
     * @param array $data 所需要插入的信息
     */
    public function editPush(array $data, $id)
    {
        return $this->where('id', '=', intval($id))->update($data);
    }

    /**
     * 取得指定ID信息
     * 
     * @param intval $id 用户组的ID
     * @return array
     */
    public function getOneById($id)
    {
        return $this->where('id', '=', intval($id))->first();
    }

    /**
     * 批量删除推荐位
     */
    public function deletePush(array $ids)
    {
        return $this->whereIn('id', $ids)->delete();
    }

}
