<title>#BBF-权限管理【功能列表】</title>
<!-- Main Container Start -->
<div id="mws-container" class="clearfix">
    <!-- Inner Container Start -->
    <div class="container">
        <!-- Data Table with Numbered Pagination -->
        <div class="mws-panel grid_8">
            <div class="mws-panel-header">
                <span><i class="icon-table"></i> 修改权限--<a onclick="save_access()" href="javascript:void(0);">保存</a></span>
            </div>
            <div>
                <form class="mws-form" action="backend.php?r=rbac/access/update" method="post" id="sub">
                <?php foreach($models as $key=>$val){ ?>
                    <span>
                        <span>
                            <a id="first_<?php echo $val['first']['id']; ?>" href="javascript:void(0);" <?php if($val['first']['access_status'] == 1){ ?>onclick="first_check(<?php echo $val['first']['id']; ?>,2)"<?php }else{ ?>onclick="first_check(<?php echo $val['first']['id']; ?>,1)"<?php } ?> ><input id="first_check_<?php echo $val['first']['id']; ?>" name="first[]" type="checkbox" <?php if($val['first']['access_status'] == 1){ ?>checked<?php } ?> value="<?php echo $val['first']['id']; ?>" ></a>
                        </span>
                        <span><?php echo $val['first']['title']; ?></span>
                    </span>
                    <br/>
                    <?php if($val['two']){ ?>
                        <?php foreach($val['two'] as $kk=>$vv){ ?>
                            <span style="margin-left: 20px;">
                                <span>
                                    <?php if($vv['access_status'] == 1){ ?>
                                    <a id="two_<?php echo $vv['id']; ?>" href="javascript:void(0);" onclick="two_check(<?php echo $vv['id']; ?>,2,<?php echo $vv['pid']; ?>)">
                                    <?php }else{ ?>
                                    <a id="two_<?php echo $vv['id']; ?>" href="javascript:void(0);" onclick="two_check(<?php echo $vv['id']; ?>,1,<?php echo $vv['pid']; ?>)">
                                    <?php } ?>
                                        <input id="two_<?php echo $vv['pid']; ?>_<?php echo $kk; ?>" name="two[]" type="checkbox" <?php if($vv['access_status'] == 1){ ?>checked<?php } ?> value="<?php echo $vv['id']; ?>" >
                                    </a>
                                </span>
                                <input type="hidden" name="two_<?php echo $vv['pid']; ?>[]">
                                <span><?php echo $vv['title']; ?></span>
                            </span>
                            <br/>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
                <input type="hidden" name="role_id" value="<?php echo $role_id; ?>" >
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
    function save_access() {
        $('#sub').submit();
    }

    function first_check(id,state) {
        var module = document.getElementsByName('two_'+id+'[]');
        if(state == 1) {
            // 选中
            for(var i=0;i<module.length;i++)
            {
                $('#two_'+id+'_'+i).attr('checked','checked');
            }
            $('#first_'+id).attr('onclick','first_check('+id+',2)');
        } else {
            // 取消选中
            for(var j=0;j<module.length;j++)
            {
                $('#two_'+id+'_'+j).removeAttr('checked');
            }
            $('#first_'+id).attr('onclick','first_check('+id+',1)');
        }
    }

    function two_check(id,state,pid) {
        if(state == 1) {
            // 选中
            $('#first_check_'+pid).attr('checked','checked');
            $('#first_'+pid).attr('onclick','first_check('+pid+',2)');
            $('#two_'+id).attr('onclick','two_check('+id+',2,'+pid+')');
        } else {
            // 取消选中
            $('#two_'+id).attr('onclick','two_check('+id+',1,'+pid+')');
        }
    }
</script>