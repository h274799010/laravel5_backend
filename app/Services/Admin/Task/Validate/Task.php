<?php namespace App\Services\Admin\Task\Validate;

use Validator, Lang;
use App\Services\Admin\BaseValidate;

/**
 * 增加文章推荐位表单验证
 *
 * @author jiang <mylampblog@163.com>
 */
class Task extends BaseValidate
{
    /**
     * 增加文章推荐位的时候的表单验证
     *
     * @access public
     */
    public function add(\App\Services\Admin\Task\Param\TaskSave $data)
    {
        // 创建验证规则
        $rules = array(
            'title' => 'required'

        );
        
        // 自定义验证消息
        $messages = array(
            'title.required' => Lang::get('task.name_empty')

        );
        
        //开始验证
        $validator = Validator::make($data->toArray(), $rules, $messages);
        if($validator->fails())
        {
            $this->errorMsg = $validator->messages()->first();
            return false;
        }
        return true;
    }
    
    /**
     * 编辑文章推荐位的时候的表单验证
     *
     * @access public
     */
    public function edit(\App\Services\Admin\Task\Param\TaskSave $data)
    {
        return $this->add($data);
    }
    
}
