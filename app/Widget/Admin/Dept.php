<?php

namespace App\Widget\Admin;

use App\Widget\Admin\AbstractBase;

/**
 * 文章分类列表小组件
 *
 * @author jiang <mylampblog@163.com>
 */
class Dept extends AbstractBase
{
    /**
     * 文章分类列表编辑操作
     *
     * @access public
     */
    public function edit($data)
    {
        $this->setCurrentAction('dept', 'edit', 'foundation')->checkPermission();
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
        $this->setCurrentAction('dept', 'delete', 'foundation')->checkPermission();
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
        $this->setCurrentAction('dept', 'add', 'foundation')->checkPermission();
        $url = R('common', $this->module.'.'.$this->class.'.'.$this->function);
        //dd($url);
        $html = $this->hasPermission ?
                    '<div class="btn-group" style="float:right;"><a href="'.$url.'" title="增加部门" class="btn btn-primary btn-xs"><span aria-hidden="true" class="glyphicon glyphicon-plus"></span>增加部门</a></div>'
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


}