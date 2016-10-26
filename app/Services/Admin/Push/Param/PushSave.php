<?php namespace App\Services\Admin\Push\Param;

use App\Services\Admin\AbstractParam;

/**
 * 文章推荐位操作有关的参数容器，固定参数，方便分离处理。
 *
 * @author jiang <mylampblog@163.com>
 */
class PushSave extends AbstractParam
{

    protected $user_id;

    protected  $data;

    protected $create_time;
    protected $status;


    protected $id;

    public function setId($id)
    {
        $this->id = $this->attributes['id'] = $id;
        return $this;

    }


    public function setData($data)
    {
        $this->data = $this->attributes['data'] = $data;
        return $this;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $this->attributes['user_id'] = $user_id;
        return $this;
    }



    public function setCreateTime($create_time)
    {
        $this->create_time = $this->attributes['create_time'] = $create_time;
        return $this;
    }

    public function setStatus($status)
    {
        $this->status = $this->attributes['status'] = $status;
        return $this;
    }
}
