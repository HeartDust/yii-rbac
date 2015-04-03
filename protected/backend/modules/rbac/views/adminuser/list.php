<title>#BBF-权限管理【后台用户列表】</title>
<!-- Main Container Start -->
<div id="mws-container" class="clearfix">
    <!-- Inner Container Start -->
    <div class="container">
        <!-- Data Table with Numbered Pagination -->
        <div class="mws-panel grid_8">
            <div class="mws-panel-header">
                <span><i class="icon-table"></i> 内部人员管理<a at="create" href="backend.php?r=rbac/adminuser/create" style="cursor: pointer;padding-left: 78%;"><input type="button" value="添加内部人员"></a></span>
            </div>
            <div class="mws-panel-body no-padding">
                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper" role="grid">
                    <table class="mws-datatable mws-table">
                        <thead>
                        <tr>
                            <th>用户ID</th>
                            <th>账户昵称</th>
                            <th>手机</th>
                            <th>角色</th>
                            <th>注册时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($models as $key=>$val){ ?>
                            <tr>
                                <td><?php echo $val['id']; ?></td>
                                <td><?php echo $val['username']; ?></td>
                                <td><?php echo $val['tel']; ?></td>
                                <td><?php echo $val['role_name']; ?></td>
                                <td><?php echo date('Y-m-d H:i:s',$val['create_time']); ?></td>
                                <td><a at="edit" href="backend.php?r=rbac/adminuser/edit&uid=<?php echo $val['id']; ?>">修改</a>&nbsp;&nbsp;<a at="del" href="backend.php?r=rbac/adminuser/del&uid=<?php echo $val['id']; ?>">删除</a></td>
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