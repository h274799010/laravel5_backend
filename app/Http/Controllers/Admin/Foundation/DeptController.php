<?php namespace App\Http\Controllers\Admin\Foundation;

use Request, Lang, Session;
use App\Models\Admin\Dept as DeptModel;
use App\Services\Admin\Dept\Process as DeptActionProcess;
use App\Libraries\Js;
use App\Http\Controllers\Admin\Controller;
use App\Services\Admin\Tree;

/**
 * 文章分类相关
 *
 * @author jiang <mylampblog@163.com>
 */
class DeptController extends Controller
{
    /**
     * 显示分类列表
     */
    public function index()
    {
        Session::flashInput(['http_referer' => Request::fullUrl()]);
        $manager = new DeptActionProcess();

        $list = $manager->unDeleteDept();
        //$list = $manager->
        $list=Tree::genTree($list);
    	//$page = $list->setPath('')->appends(Request::all())->render();
        //return view('admin.content.classify', compact('list', 'page'));
        return view('admin.dept.dept', compact('list'));
    }

    /**
     * 增加文章分类
     */
    public function add()
    {

    	if(Request::method() == 'POST') return $this->saveDatasToDatabase();
        $formUrl = R('common', 'foundation.dept.add');
        $list=(new DeptModel())->allDept();
        $select= Tree::dropDownSelect(Tree::genTree($list));
        return view('admin.dept.deptadd', compact('formUrl','select'));

    }

    /**
     * 增加文章分类入库处理
     *
     * @access private
     */
    private function saveDatasToDatabase()
    {
        $data = (array) Request::input('data');

        $param = new \App\Services\Admin\Dept\Param\DeptSave();
        $param->setAttributes($data);
        $manager = new DeptActionProcess();
        if($manager->addDept($param) !== false) return Js::locate(R('common', 'foundation.dept.index'), 'parent');
        return Js::error($manager->getErrorMessage());
    }

    /**
     * 编辑文章分类
     */
    public function edit()
    {
    	if(Request::method() == 'POST') return $this->updateDatasToDatabase();
        Session::flashInput(['http_referer' => Session::getOldInput('http_referer')]);
        $id = Request::input('id');
        if( ! $id or ! is_numeric($id)) return Js::error(Lang::get('common.illegal_operation'));
        $info = (new DeptModel())->getOneById($id);
        if(empty($info)) return Js::error(Lang::get('dept.not_found'));
        $formUrl = R('common', 'foundation.dept.edit');
        $list=(new DeptModel())->allDept();
        $select= Tree::dropDownSelect(Tree::genTree($list),$info['pid']);
        return view('admin.dept.deptadd', compact('info', 'formUrl', 'id','select'));
    }

    /**
     * 编辑文章分类入库处理
     *
     * @access private
     */
    private function updateDatasToDatabase()
    {
        $httpReferer = Session::getOldInput('http_referer');
        $data = Request::input('data');
        if( ! $data or ! is_array($data)) return Js::error(Lang::get('common.illegal_operation'));
        $param = new \App\Services\Admin\Dept\Param\DeptSave();
        $param->setAttributes($data);
        $manager = new DeptActionProcess();
        if($manager->editDept($param))
        {
            $backUrl = ( ! empty($httpReferer)) ? $httpReferer : R('common', 'foundation.dept.index');
            return Js::locate($backUrl, 'parent');
        }
        return Js::error($manager->getErrorMessage());
    }

    /**
     * 删除文章分类
     *
     * @access public
     */
    public function delete()
    {
        if( ! $id = Request::input('id')) return responseJson(Lang::get('common.action_error'));
        if( ! is_array($id)) $id = array($id);

        $manager = new DeptActionProcess();
        
        if($manager->detele($id)) return responseJson(Lang::get('common.action_success'), true);
        return responseJson($manager->getErrorMessage());
    }

}