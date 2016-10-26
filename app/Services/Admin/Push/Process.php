<?php namespace App\Services\Admin\Push;

use Lang;
use App\Models\Admin\Push as PushModel;
//use App\Models\Admin\PositionRelation as PositionRelationModel;
use App\Services\Admin\Push\Validate\Push as PushValidate;
use App\Services\Admin\BaseProcess;
use App\Services\Admin\SC;

/**
 * 推荐位处理
 *
 * @author jiang <mylampblog@163.com>
 */
class Process extends BaseProcess
{
    /**
     * 推荐位模型
     * 
     * @var object
     */
    private $pushModel;

    /**
     * 推荐位表单验证对象
     * 
     * @var object
     */
    private $pushValidate;

    /**
     * 初始化
     *
     * @access public
     */
    public function __construct()
    {
        if( ! $this->pushModel) $this->pushModel = new PushModel();
        if( ! $this->pushValidate) $this->pushValidate = new PushValidate();
    }

    /**
     * 增加新的推荐位
     *
     * @param string $data
     * @access public
     * @return boolean true|false
     */
    public function addPush(\App\Services\Admin\Push\Param\PushSave $data)
    {
        if( ! $this->pushValidate->add($data)) return $this->setErrorMsg($this->pushValidate->getErrorMessage());
        $data = $data->toArray();
        $data['status'] = 0;
        $data['create_time'] = time();
        //$data['user_id']=SC::getLoginSession()->id;
        //$data['user_name']=SC::getLoginSession()->name;
        if($this->pushModel->addPush($data) !== false) return true;
        return $this->setErrorMsg(Lang::get('common.action_error'));
    }

    /**
     * 删除推荐位
     * 
     * @param array $ids
     * @access public
     * @return boolean true|false
     */
    public function detele($ids)
    {
        if( ! is_array($ids)) return false;
        //$data['is_delete'] = TaskModel::IS_DELETE_YES;
        $result = with(new PushModel())->deletePush($ids);
        if($result !== false) return true;

        return $this->setErrorMsg(Lang::get('common.action_error'));
    }

    /**
     * 编辑推荐位
     *
     * @param string $data
     * @access public
     * @return boolean true|false
     */
    /**
    public function editTask(\App\Services\Admin\Task\Param\TaskSave $data)
    {
        if( ! isset($data['id'])) return $this->setErrorMsg(Lang::get('common.action_error'));
        $id = intval($data['id']); unset($data['id']);
        if( ! $this->taskValidate->edit($data)) return $this->setErrorMsg($this->taskValidate->getErrorMessage());
        if($this->taskModel->editTask($data->toArray(), $id) !== false) return true;
        return $this->setErrorMsg(Lang::get('common.action_error'));
    }


     * 删除推荐位
     * 
     * @param array $ids
     * @access public
     * @return boolean true|false
     */
    /*
    public function delRelation($prid)
    {
        if( ! is_array($prid)) return false;
        $result = with(new PositionRelationModel())->deletePositionRelationById($prid);
        if($result !== false) return true;
        return $this->setErrorMsg(Lang::get('common.action_error'));
    }
    */
    /**
     * 关联文章排序

    public function sortRelation($prid, $sort)
    {
        $prid = intval($prid); $sort = intval($sort);
        $result = with(new PositionRelationModel())->sortRelation($prid, $sort);
        if($result !== false) return true;
        return $this->setErrorMsg(Lang::get('common.action_error'));
    }
     */
}