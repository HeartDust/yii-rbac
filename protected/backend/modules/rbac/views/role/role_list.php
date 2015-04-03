<title>#BBF-权限管理【角色列表】</title>
<!-- Main Container Start -->
<div id="mws-container" class="clearfix">
    <!-- Inner Container Start -->
    <div class="container">
        <!-- Data Table with Numbered Pagination -->
        <div class="mws-panel grid_8">
            <div class="mws-panel-header">
                <span><i class="icon-table"></i> 角色权限管理<a at="create" href="backend.php?r=rbac/role/create" style="cursor: pointer;padding-left: 78%"><input type="button" value="添加角色"></a></span>
            </div>
            <div class="mws-panel-body no-padding">
                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper" role="grid">
                    <table class="mws-datatable mws-table">
                        <thead>
                        <tr>
                            <th>角色名称</th>
                            <th>权限管理</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($models as $key=>$val){ ?>
                            <tr>
                                <td><?php echo $val->attributes['name']; ?></td>
                                <td>
                                    <a href="<?php echo Yii::app()->baseUrl; ?>/backend.php?r=rbac/access&role_id=<?php echo $val->attributes['id']; ?>">授权</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="<?php echo Yii::app()->baseUrl; ?>/backend.php?r=rbac/adminuser&role_id=<?php echo $val->attributes['id']; ?>">用户列表</a>
                                </td>
                                <td>
                                    <a at="edit" href="<?php echo Yii::app()->baseUrl; ?>/backend.php?r=rbac/role/edit&role_id=<?php echo $val->attributes['id']; ?>">修改</a>
                                    <a at="del" href="javascript:void(0);" onclick="del(<?php echo $val->attributes['id']; ?>)">删除</a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Inner Container End -->
    <!-- Footer -->
    <div id="mws-footer">
        Copyright Your Website 2014. All Rights Reserved.
    </div>
</div>
<!-- Main Container End -->
<script type="text/javascript">
    function del(id) {
        $.ajax({
            type: 'get',
            url: '<?php echo Yii::app()->baseUrl; ?>/backend.php?r=rbac/role/del',
            data: 'id='+id,
            success:function(msg) {
                if(msg == 1) {
                    alert('该角色下有用户不能删除！');
                } else if(msg == 2) {
                    alert('删除成功');
                    location.reload();
                } else if(msg == 3) {
                    alert('删除失败');
                    location.reload();
                }
            }
        });
    }
</script>