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
                  <?php echo widget('Admin.Task')->index(); ?> <?php echo widget('Admin.Task')->forder(0); ?>
                 <br>
                      <br>
                <div class="table-responsive">
                  <div class="panel panel-default">
                    <div class="table-responsive">

                      <table class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th>任务名字</th>
                            <th>状态</th>
                            <th>增加时间</th>
                            <th width="70">操作</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach($list as $key => $value): ?>
                            <tr>
                              <td>
                                 <a href="<?php echo R('common', 'foundation.task.read',['id'=>$value['id']]); ?>" ><?php echo $value['title']; ?></a></td>
                              <td>
                                <?php echo $value['status'] == 1 ? '<i class="fa fa-check" style="color:green;"></i>' : '<i class="fa fa-times" style="color:red;"></i>'; ?>
                              </td>
                              <td><?php echo date('Y-m-d H:i', $value['create_time']); ?></td>
                              <td>

                                <?php echo widget('Admin.Task')->edit($value); ?>
                                <?php echo widget('Admin.Task')->delete($value); ?>
                              </td>
                            </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                      </div>
                      </div>
                  </div>
              </div>
          </div>
          <?php echo $page; ?>
        </div>
        <?php echo widget('Admin.Common')->footer(); ?>
            
        </div>
    </div>
<?php echo widget('Admin.Common')->htmlend(); ?>