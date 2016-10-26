<?php echo widget('Admin.Common')->header(); ?>
    <?php echo widget('Admin.Common')->top(); ?>
    <?php echo widget('Admin.Menu')->leftMenu(); ?>
    <div class="content">
        <?php echo widget('Admin.Menu')->contentMenu(); ?>
        <?php echo widget('Admin.Common')->crumbs(); ?>
        <div class="main-content">

          <ul class="nav nav-tabs">
            <li class="active"><a href="#home" data-toggle="tab">填写任务信息</a></li>
          </ul>

          <div class="row">
            <div class="col-md-12">
              <br>
              <div id="myTabContent" class="tab-content">
                <div class="tab-pane active in" id="home">
                  <form id="tab" target="hiddenwin" method="post" action="<?php echo $formUrl; ?>">
                    <div class="form-group input-group-sm">
                      <label>任务名称</label>
                      <input type="text" value="<?php if(isset($info['title'])) echo $info['title']; ?>" name="data[title]" class="form-control">
                    </div>

                  <div class="col-lg-pull-12">
                      <label>指派给：</label>
                      <div> <label>部门：<span><select class="form-control" name="data[dept]" id="dept">
                          <option value="0">无部门</option>
                          <?php echo $select;?>
                      </select></span></label>
                      <label>人员：<span><select class="form-control" name="data[exe_id]" id="exe_id">
                                  <option value="0">无人员</option>

                              </select></span></label><input type="hidden" value="data[exe_name]" name="data[exe_name]" id="exe_name"></div>

                  </div>
                  <br>
                  <br>
                      <div class="form-group input-group-sm">
                          <label>任务内容</label>
                          <script id="container" name="data[content]" type="text/plain"><?php if(isset($info['content'])) echo $info['content']; ?></script>
                      </div>

                    <div class="btn-toolbar list-toolbar">
                      <a class="btn btn-sm btn-primary sys-btn-submit" data-loading="发布中..." ><i class="fa fa-save"></i> <span class="sys-btn-submit-str">发布</span></a>
                    </div>
                    <?php if(isset($id)): ?>
                      <input name="data[id]" type="hidden" value="<?php echo $id;?>" />
                    <?php endif; ?>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <?php echo widget('Admin.Common')->footer(); ?>
        </div>
    </div>
<link rel="stylesheet" type="text/css" href="/lib/chosen/min.css">
<script src="/lib/chosen/min.js" type="text/javascript"></script>
<script src="/lib/ueditor/ueditor.config.js" type="text/javascript"></script>
<script src="/lib/ueditor/ueditor.all.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo loadStatic('/lib/datepicker/bootstrap-datetimepicker.min.css'); ?>">
<script src="<?php echo loadStatic('/lib/datepicker/bootstrap-datetimepicker.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo loadStatic('/lib/datepicker/locales/bootstrap-datetimepicker.zh-CN.js'); ?>" type="text/javascript"></script>

<script type="text/javascript">
    var config = {
        '.chosen-select'           : {},
        '.chosen-select-deselect'  : {allow_single_deselect:true},
        '.chosen-select-no-single' : {disable_search_threshold:10},
        '.chosen-select-no-results': {no_results_text:'没有找到！'},
        '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
        $(selector).chosen(config[selector]);
    }

    var ue = UE.getEditor('container', {
        autoHeight: false,
        initialFrameHeight: 300,
        autoFloatEnabled: true
    });

    $(document).keydown(function(e){
        // ctrl + s
        if( e.ctrlKey  == true && e.keyCode == 83 ){
            $('#save-buttom').trigger('click');
            return false; // 截取返回false就不会保存网页了
        }
    });

    $(function(){
        $('#dept').change(function(){


            var did=$('#dept').val();

            var url = '<?php echo R('common', 'foundation.task.addreturn'); ?>';

            var params = {ids:did};
            //alert(url);

            $.getJSON(url,params,function(data){
                //回调函数
                //alert(data);
                if (data.result == 'success'){
                    //alert(111);
                    //首先清除子类中值不为空的，如果没有这句话你会发现子类的显示会这个增加，二不是你想要的结果
                    $("#exe_id option[value!='']").remove();
                    //计算返回数组的数目，并循环显示
                    for (var i=0;i<=data.message.length;i++) {
                        //定义html标签，和显示的值，id和type_name为数据库中的字段名
                        var option ="<option value="+data.message[i].id+">"+data.message[i].name+"</option>";
                        //显示的位置
                        $(option).appendTo('#exe_id');
                        $('#exe_name').val(data.message[i].name);
                    }
                }
            });
        });
    });




</script>

<?php echo widget('Admin.Common')->htmlend(); ?>