<title>#BBF-权限管理【添加功能】</title>
<!-- Main Container Start -->
<div id="mws-container" class="clearfix">
    <!-- Inner Container Start -->
    <div class="container">
        <div class="mws-panel grid_6">
            <div class="mws-panel-header">
                <span><i class="icon-table"></i> 添加功能<a href="backend.php?r=rbac/node" style="cursor: pointer;padding-left: 75%;"><input type="button" value="返回功能列表"></a></span>
            </div>
            <div class="mws-panel-body no-padding">
                <form class="mws-form" action="backend.php?r=rbac/node/create" method="post" id="sub">
                    <div class="mws-form-inline">
                        <div class="mws-form-row bordered">
                            <label class="mws-form-label">功能名称</label>
                            <div class="mws-form-item">
                                <input type="text" class="large require" name="title" value="">
                            </div>
                        </div>
                    </div>
                    <div class="mws-form-inline">
                        <div class="mws-form-row bordered">
                            <label class="mws-form-label">功能标识</label>
                            <div class="mws-form-item">
                                <input type="text" class="large require" id="name" name="name" value="">
                            </div>
                        </div>
                    </div>
                    <div class="mws-form-inline">
                        <div class="mws-form-row bordered">
                            <label class="mws-form-label">功能描述</label>
                            <div class="mws-form-item">
                                <?php if($pid == 0){ ?>
                                    <input type="text" class="large require" readonly="true" name="remark" value="控制器">
                                <?php }else{ ?>
                                    <input type="text" class="large require" readonly="true" name="remark" value="动作">
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="pid" name="pid" value="<?php echo $pid; ?>">
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
        var name = $("#name").val();
        var pid = $("#pid").val();
        $.ajax({
            type: 'get',
            url: '<?php echo Yii::app()->baseUrl;?>/backend.php?r=rbac/node/verify',
            data: 'name='+name+'&pid='+pid,
            success:function(msg){
                if(msg == 2) {
                    $("#sub").submit();
                } else {
                    alert("该功能标识已经存在！");
                    return false;
                }
            }
        });
    }
</script>