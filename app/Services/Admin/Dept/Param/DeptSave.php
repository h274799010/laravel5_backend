<?php namespace App\Services\Admin\Dept\Param;

use App\Services\Admin\AbstractParam;

/**
 * 文章分类操作有关的参数容器，固定参数，方便分离处理。
 *
 * @author jiang <mylampblog@163.com>
 */
class DeptSave extends AbstractParam
{
    protected $name;

    protected $is_active;

    protected $id;

    protected $pid;

    public function setName($name)
    {
        $this->name = $this->attributes['name'] = $name;
        return $this;
    }

    public function setIsActive($is_active)
    {
        $this->is_active = $this->attributes['is_active'] = $is_active;
        return $this;
    }

    public function setId($id)
    {
        $this->id = $this->attributes['id'] = $id;
        return $this;
    }

    public function setPid($pid)
    {
        $this->id = $this->attributes['pid'] = $pid;
        return $this;
    }

}
