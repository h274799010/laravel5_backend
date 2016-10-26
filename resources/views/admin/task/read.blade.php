<?php echo widget('Admin.Common')->header(); ?>
    <?php echo widget('Admin.Common')->top(); ?>
    <?php echo widget('Admin.Menu')->leftMenu(); ?>
    <div class="content">
        <?php echo widget('Admin.Menu')->contentMenu(); ?>
        <?php echo widget('Admin.Common')->crumbs('Task'); ?>
        <div class="main-content">
        <div id="sys-list">
          <div class="row">
              <div class=" col-md-12">

                 <?php


                      if($info['exe_id']==null)
                      {
                         echo '<a href="';
                          echo R('common', 'foundation.task.letmedo',['id'=>$info['id']]);
                          echo '" class="btn btn-primary" title="我来处理">我来处理</a>';
                      }
                         ?>
                <div class="table-responsive">
                  <div class="panel panel-default">
                    <div class="table-responsive">

                      <table class="table table-bordered table-striped">
                       <tr><td><?php echo $info['title']; ?></td></tr>
                          <tr><td><?php echo $info['content']; ?></td></tr>
                      </table>
                      </div>
                      </div>
                  </div>
              </div>
          </div>
            <?php if($info['exe_id']==$user_id): ?>
            <div class="ibox task_todo">
                <div class="ibox-title">
                    <h5 class="smaller">我的执行情况</h5>
                    <div class="ibox-tools no-border">
                        <ul class="nav nav-tabs" id="myTab">
                            <li class="active">
                                <a href="#working" data-toggle="tab">执行情况</a>
                            </li>
                            <li>
                                <a href="#forword" data-toggle="tab">转交任务</a>
                            </li>
                            <li>
                                <a href="#reject" data-toggle="tab">拒绝接受</a>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
            <div class="ibox-content">
                <div class="tab-content">
                    <div class="tab-pane active" id="working">
                        <form method='post' id="form_data_working" name="form_data_working" enctype="multipart/form-data" class="well form-horizontal">

                            <div class="form-group col-sm-6">
                                <label class="col-sm-4 control-label" >计划完成时间：</label>
                                <div class="col-sm-8">
                                    <input class="input-date-time form-control" name="plan_time" value="" readonly="readonly">
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label class="col-sm-4 control-label" >完成率：</label>
                                <div class="col-sm-8">
                                    <div class="form-control-static" >
                                        <input type="hidden" id="finish_rate" name="finish_rate"/>
                                        <div  class="slider_box" >
                                            <div id="basic_slider"></div>
                                            <div class="right" id="basic_slider_val">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group panel-body">
                                <label class="col-sm-2 control-label" >执行内容：</label>
                                <div class="col-sm-10">
                                    <textarea id="feed_back" name="feed_back" class="col-xs-12 simple" style="height:120px"></textarea>
                                </div>
                            </div>



                    </form>
                </div>
                <div class="tab-pane" id="forword">
                    <form method='post' id="form_data_forword" name="form_data_forword" >

                        <div class="form-group col-sm-12">
                            <label class="col-sm-2 control-label" for="name">转交给：</label>
                            <div class="col-sm-10">
                                <div id="actor_wrap" class="inputbox">
                                    <a class="pull-right btn btn-link text-center" ><i class="fa fa-user"></i> </a>
                                    <div class="wrap" >
                                        <span class="address_list"></span>
											<span class="text" >
												<input class="letter" type="text"  >
											</span>
                                    </div>
                                    <div class="search dropdown ">
                                        <ul class="dropdown-menu"></ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group panel-body">
                            <label class="col-sm-2 control-label" >执行内容：</label>
                            <div class="col-sm-10">
                                <textarea id="feed_back" name="feed_back" class="col-xs-12 simple" style="height:120px" ></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane" id="reject">
                    <form method='post' id="form_data_reject" name="form_data_reject" >

                        <div class="form-group panel-body">
                            <label class="col-sm-2 control-label" >执行内容：</label>
                            <div class="col-sm-10">
                                <textarea id="feed_back" name="feed_back" class="col-xs-12 simple" style="height:120px" ></textarea>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


            <div class="widget-toolbox clearfix">
                <div class="pull-left col-sm-8 col-sm-offset-2">
                    <a onclick="save_log();" class="btn btn-sm btn-primary col-6">提交</a>
                    <a onclick="go_return_url();" class="btn btn-sm btn-default">取消</a>
                </div>
            </div>
        </div>
        </div>
            <?php endif; ?>

        <?php echo widget('Admin.Common')->footer(); ?>
            
        </div>
    </div>
<?php echo widget('Admin.Common')->htmlend(); ?>