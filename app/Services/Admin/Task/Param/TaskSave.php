<?php namespace App\Services\Admin\Task\Param;

use App\Services\Admin\AbstractParam;

/**
 * 文章推荐位操作有关的参数容器，固定参数，方便分离处理。
 *
 * @author jiang <mylampblog@163.com>
 */
class TaskSave extends AbstractParam
{
    protected $title;

    protected $user_id;

    protected  $user_name;
    protected  $content;

    protected $exe_id;
    protected $exe_name;
    protected $add_pic;
    protected $status;


    protected $id;

    public function setContent($content)
    {
        $this->content = $this->attributes['content'] = $content;
        return $this;

    }


    public function setTitle($title)
    {
        $this->title = $this->attributes['title'] = $title;
        return $this;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $this->attributes['user_id'] = $user_id;
        return $this;
    }

    public function setUserName($user_name)
    {
        $this->user_name = $this->attributes['user_name'] = $user_name;
        return $this;
    }

    public function setExeId($exe_id)
    {
        $this->exe_id = $this->attributes['exe_id'] = $exe_id;
        return $this;
    }
    public function setExeName($exe_name)
    {
        $this->exe_name = $this->attributes['exe_name'] = $exe_name;
        return $this;
    }

    public function setAddPic($add_pic)
    {
        $this->add_pic = $this->attributes['add_pic'] = $add_pic;
        return $this;
    }

    public function setStatus($status)
    {
        $this->status = $this->attributes['status'] = $status;
        return $this;
    }
}
