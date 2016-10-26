<?php namespace App\Services\Admin\Push\Validate;

use Validator, Lang;
use App\Services\Admin\BaseValidate;

/**
 * 增加文章推荐位表单验证
 *
 * @author jiang <mylampblog@163.com>
 */
class Push extends BaseValidate
{
    /**
     * 增加文章推荐位的时候的表单验证
     *
     * @access public
     */
    public function add(\App\Services\Admin\Push\Param\PushSave $data)
    {
        // 创建验证规则
        $rules = array(
            'user_id' => 'required',
            'data'=>'required',
            'status'=>'required',
            'create_time'=>'required'

        );
        
        // 自定义验证消息
        $messages = array(
            'user_id.required' => Lang::get('push.name_empty')

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
    public function edit(\App\Services\Admin\Push\Param\PushSave $data)
    {
        return $this->add($data);
    }
    
}
