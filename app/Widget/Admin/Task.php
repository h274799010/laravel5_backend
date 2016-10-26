<?php

namespace App\Widget\Admin;

use App\Widget\Admin\AbstractBase;
use App\Models\Admin\User as UserModel;
use App\Services\Admin\SC;

/**
 * 文章分类列表小组件
 *
 * @author jiang <mylampblog@163.com>
 */
class Task extends AbstractBase
{
    /**
     * 文章分类列表编辑操作
     *
     * @access public
     */
    public function index()
    {
        $this->setCurrentAction('task', 'index', 'foundation')->checkPermission();


        $url = R('common', $this->module.'.'.$this->class.'.'.$this->function);
        $html = $this->hasPermission ?
                '<a href="'.$url.'"><i class="fa fa-pencil">所有任务</i></a>'
                : '<i class="fa fa-pencil" style="color:#ccc"></i>';


        return $html;

    }

    public function forder($status)
    {

        $this->setCurrentAction('task', 'index', 'foundation')->checkPermission();


        $url = R('common', $this->module.'.'.$this->class.'.'.$this->function,['status' =>$status]);
        $html = $this->hasPermission ?
            '<a href="'.$url.'"><i class="fa fa-pencil">我的任务</i></a>'
            : '<i class="fa fa-pencil" style="color:#ccc"></i>';


        return $html;

    }


    public function edit($data)
    {
        $this->setCurrentAction('task', 'edit', 'foundation')->checkPermission();
        $url = R('common', $this->module.'.'.$this->class.'.'.$this->function, ['id' => $data['id']]);
        $html = $this->hasPermission ?
                    '<a href="'.$url.'"><i class="fa fa-pencil"></i></a>'
                        : '<i class="fa fa-pencil" style="color:#ccc"></i>';
        return $html;
    }

    /**
     * 文章分类列表删除操作
     *
     * @access public
     */
    public function delete($data)
    {
        $this->setCurrentAction('task', 'delete', 'foundation')->checkPermission();
        $url = R('common', $this->module.'.'.$this->class.'.'.$this->function, ['id' => $data['id']]);
        $html = $this->hasPermission ?
                    '<a href="javascript:ajaxDelete(\''.$url.'\', \'sys-list\', \'确定吗？\');"><i class="fa fa-trash-o"></i></a>'
                        : '<i class="fa fa-trash-o" style="color:#ccc"></i>';
        return $html;
    }

    /**
     * 面包屑中的按钮
     *
     * @access public
     */
    public function navBtn()
    {
        $this->setCurrentAction('task', 'add', 'foundation')->checkPermission();
        $url = R('common', $this->module.'.'.$this->class.'.'.$this->function);
        //dd($url);
        $html = $this->hasPermission ?
                    '<div class="btn-group" style="float:right;"><a href="'.$url.'" title="发布任务" class="btn btn-primary btn-xs"><span aria-hidden="true" class="glyphicon glyphicon-plus"></span>发布任务</a></div>'
                        : '';
        return $html;
    }

    private $son;



    public function deptlist(array $data,$prefix = false)
    {
        $html = '';

        if( ! $this->son) $this->son = \App\Services\Admin\Tree::getSonKey();

        foreach($data as $key => $value)
        {

            $line = ($prefix === false ? '' : $prefix).'┆┄';
            //
            $html .= view('admin.dept.list', compact('value', 'prefix'));
           // dd($line);
            if(isset($value[$this->son]) && is_array($value[$this->son]))
            {
                $html .= $this->deptlist($value[$this->son],$line);
            }
        }
        return $html;
    }

    public function taskDialogDept()
    {
        $id = Request::input('ids');

        //dd($id);
        $this->setCurrentAction('task', 'add1', 'foundation')->checkPermission();
        $list = with(new UserModel())->getAllUser();
        $html = $this->hasPermission ?
            view('admin.task.task_dialog_dept', compact('list'))->render()
            : '';
        return json_encode(['content' => $html]);
    }
}