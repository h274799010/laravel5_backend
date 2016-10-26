<?php namespace App\Http\Controllers\Admin\Foundation;

use Request, Lang, Session;
use App\Models\Admin\Push as PushModel;
//use App\Models\Admin\Dept as DeptModel;
use App\Models\Admin\User as UserModel;
//use App\Models\Admin\Content as ContentModel;
use App\Services\Admin\Push\Process as PushActionProcess;
use App\Libraries\Js;
use App\Http\Controllers\Admin\Controller;
use App\Services\Admin\Tree;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * 文章推荐位相关
 *
 * @author jiang <mylampblog@163.com>
 */
class PushController extends Controller
{
    /**
     * 显示推荐位列表
     */
    public function index()
    {
        Session::flashInput(['http_referer' => Request::fullUrl()]);
    	$list = (new PushModel())->allPush();
    	$page = $list->setPath('')->appends(Request::all())->render();
        return view('admin.task.index', compact('list', 'page'));
    }

    /**
     * 增加推荐位分类
     */
    public function add()
    {
    	if(Request::method() == 'POST') return $this->saveDatasToDatabase();
        $formUrl = R('common', 'foundation.task.add');
        $list=(new DeptModel())->allDept();
        $select= Tree::dropDownSelect(Tree::genTree($list));

        return view('admin.task.add', compact('formUrl','select'));
    }

    public function addreturn()
    {
        $ids=Request::input('ids');
        // $ids=31;
         $manager = new UserModel();
         $list1=$manager->getUserDept($ids);
        //dd($list1);
        //return responseJson($list1,人员,1);

        return responseJson($list1,1);

    }

    /**
     * 增加推荐位入库处理
     *
     * @access private
     */
    private function saveDatasToDatabase()
    {
        $data = (array) Request::input('data');
        $param = new \App\Services\Admin\Task\Param\TaskSave();
        $param->setAttributes($data);
        $manager = new TaskActionProcess();
        if($manager->addTask($param) !== false) {


            return Js::locate(R('common', 'foundation.task.index'), 'parent');

        }else {

            return Js::error($manager->getErrorMessage());
        }
    }

    /**
     * 编辑文章推荐位
     */
    public function edit()
    {
    	if(Request::method() == 'POST') return $this->updateDatasToDatabase();
        Session::flashInput(['http_referer' => Session::getOldInput('http_referer')]);
        $id = Request::input('id');
        if( ! $id or ! is_numeric($id)) return Js::error(Lang::get('common.illegal_operation'));
        $info = (new TaskModel())->getOneById($id);
        if(empty($info)) return Js::error(Lang::get('task.not_found'));
        $formUrl = R('common', 'foundation.task.edit');
        return view('admin.task.add', compact('info', 'formUrl', 'id'));
    }

    /**
     * 编辑推荐位入库处理
     *
     * @access private
     */
    private function updateDatasToDatabase()
    {
        $httpReferer = Session::getOldInput('http_referer');
        $data = Request::input('data');
        if( ! $data or ! is_array($data)) return Js::error(Lang::get('common.illegal_operation'));
        $param = new \App\Services\Admin\Task\Param\TaskSave();
        $param->setAttributes($data);
        $manager = new TaskActionProcess();
        if($manager->editTask($param))
        {
            $backUrl = ( ! empty($httpReferer)) ? $httpReferer : R('common', 'foundation.task.index');
            return Js::locate($backUrl, 'parent');
        }
        return Js::error($manager->getErrorMessage());
    }

    /**
     * 删除文章推荐位
     *
     * @access public
     */
    public function delete()
    {
        if( ! $id = Request::input('id')) return responseJson(Lang::get('common.action_error'));
        if( ! is_array($id)) $id = array($id);
        $manager = new TaskActionProcess();
        if($manager->detele($id)) return responseJson(Lang::get('common.action_success'), true);
        return responseJson($manager->getErrorMessage());
    }

    /**
     * 查看文章关联

    public function relation()
    {
        $positionId = (int) Request::input('position');
        $list = (new ContentModel())->positionArticle($positionId);
        $page = $list->setPath('')->appends(Request::all())->render();
        $positionInfo = (new PositionModel())->activePosition();
        return view('admin.content.positionarticle',
            compact('list', 'page', 'positionInfo', 'positionId')
        );
    }
     */
    /**
     * 删除推荐位关联文章

    public function delrelation()
    {
        if( ! $prid = Request::input('prid')) return responseJson(Lang::get('common.action_error'));
        if( ! is_array($prid)) $prid = array($prid);
        $manager = new PositionActionProcess();
        if($manager->delRelation($prid)) return responseJson(Lang::get('common.action_success'), true);
        return responseJson($manager->getErrorMessage());
    }
     */
    /**
     * 排序关联的文章

    public function sortrelation()
    {
        $data = (array) Request::input('data');
        foreach($data as $key => $value)
        {
            if(with(new PositionActionProcess())->sortRelation($value['prid'], $value['sort']) === false) $err = true;
        }
        if(isset($err)) return responseJson(Lang::get('common.action_error'));
        return responseJson(Lang::get('common.action_success'), true);
    }
     */
}