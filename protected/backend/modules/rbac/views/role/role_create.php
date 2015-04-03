<title>#BBF-权限管理【添加角色】</title>
<!-- Main Container Start -->
<div id="mws-container" class="clearfix">
    <!-- Inner Container Start -->
    <div class="container">
        <div class="mws-panel grid_6">
            <div class="mws-panel-header">
                <span><i class="icon-table"></i> 添加角色<a href="backend.php?r=rbac/role" style="cursor: pointer;padding-left: 78%;"><input type="button" value="返回角色列表"></a></span>
            </div>
            <div class="mws-panel-body no-padding">
                <form class="mws-form" action="backend.php?r=rbac/role/create" method="post" id="sub">
                    <div class="mws-form-inline">
                        <div class="mws-form-row bordered">
                            <label class="mws-form-label">角色名称</label>
                            <div class="mws-form-item">
                                <input type="text" class="large require" id="username" name="Role[name]" value="">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="Role[status]" value="1">
                    <div class="mws-button-row">
                        <a onclick="sub()" class="btn btn-danger">提交</a>
                        <input type="reset" value="重置" class="btn ">
                    </div>
                </form>
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
    function sub() {
        var username = $.trim($("#username").val());
        if(username == "") {
            alert('角色名不能为空！');
            return false;
        }
        $("#sub").submit();
    }
</script>