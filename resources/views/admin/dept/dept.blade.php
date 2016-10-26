<?php echo widget('Admin.Common')->header(); ?>
    <?php echo widget('Admin.Common')->top(); ?>
    <?php echo widget('Admin.Menu')->leftMenu(); ?>
    <div class="content">
        <?php echo widget('Admin.Menu')->contentMenu(); ?>
        <?php echo widget('Admin.Common')->crumbs('Dept'); ?>
        <div class="main-content">
        <div id="sys-list">
          <div class="row">
              <div class=" col-md-12">
                  <div class="panel panel-default">
                    <div class="table-responsive">
                      <table class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th>部门名字</th>
                            <th>状态</th>
                            <th>部门人数</th>
                            <th>增加时间</th>
                            <th width="80">操作</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php echo widget('Admin.Dept')->deptlist($list); ?>
                        </tbody>
                      </table>
                      </div>
                  </div>
              </div>
          </div>

        </div>
        <?php echo widget('Admin.Common')->footer(); ?>
            
        </div>
    </div>
<?php echo widget('Admin.Common')->htmlend(); ?>