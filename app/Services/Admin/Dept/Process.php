<?php namespace App\Services\Admin\Dept;

use Lang;
use App\Models\Admin\Dept as DeptModel;

use App\Services\Admin\Dept\Validate\Dept as DeptValidate;
use App\Services\Admin\BaseProcess;

/**
 * 文章分类处理
 *
 * @author jiang <mylampblog@163.com>
 */
class Process extends BaseProcess
{
    /**
     * 分类模型
     * 
     * @var object
     */
    private $deptModel;

    /**
     * 分类表单验证对象
     * 
     * @var object
     */
    private $deptValidate;

    /**
     * 初始化
     *
     * @access public
     */
    public function __construct()
    {
        if( ! $this->deptModel) $this->deptModel = new DeptModel();
        if( ! $this->deptValidate) $this->deptValidate = new DeptValidate();
    }

    /**
     * 增加新的分类
     *
     * @param array $data
     * @access public
     * @return boolean true|false
     */
    public function addDept(\App\Services\Admin\Dept\Param\DeptSave $data)
    {
        if( ! $this->deptValidate->add($data)) return $this->setErrorMsg($this->deptValidate->getErrorMessage());
        $data = $data->toArray();
        $data['is_delete'] = DeptModel::IS_DELETE_NO;
        $data['time'] = time();
        if($this->deptModel->addDept($data) !== false) return true;
        return $this->setErrorMsg(Lang::get('common.action_error'));
    }

    /**
     * 删除分类
     * 
     * @param array $ids
     * @access public
     * @return boolean true|false
     */
    public function detele($ids)
    {
        if( ! is_array($ids)) return false;
        $data['is_delete'] = DeptModel::IS_DELETE_YES;
        //dd(11);
        if($this->deptModel->getSon($ids)) return $this->setErrorMsg(Lang::get('dept.dept_has_son'));
        if($this->deptModel->deleteDept($data, $ids) !== false) return true;
        return $this->setErrorMsg(Lang::get('common.action_error'));


    }

    /**
     * 编辑分类
     *
     * @param array $data
     * @access public
     * @return boolean true|false
     */
    public function editDept(\App\Services\Admin\Dept\Param\DeptSave $data)
    {
        if( ! isset($data['id'])) return $this->setErrorMsg(Lang::get('common.action_error'));
        $id = intval($data['id']); unset($data['id']);
        if( ! $this->deptValidate->edit($data)) return $this->setErrorMsg($this->deptValidate->getErrorMessage());
        if($this->deptModel->editDept($data->toArray(), $id) !== false) return true;
        return $this->setErrorMsg(Lang::get('common.action_error'));
    }

    /**
     * 取得分类列表信息
     */
    public function unDeleteDept()
    {
        //$category = $this->categoryModel->unDeleteCategory();
        $dept=$this->deptModel->unDeleteDept();
        $deptIds = [];
        foreach ($dept as $key => $value) {
            $deptIds[] = $value['id'];
        }
        /*
        $articleNums = with(new ClassifyRelationModel())->articleNumsGroupByClassifyId($categoryIds);
        foreach ($category as $key => $value) {
            foreach ($articleNums as $articleNum) {
                if($articleNum->classify_id == $value['id']) {
                    $category[$key]['articleNums'] = $articleNum->total;
                }
            }
        }
        */
        return $dept;
    }

}