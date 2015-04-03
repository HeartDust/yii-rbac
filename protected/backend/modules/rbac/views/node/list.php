<title>#BBF-权限管理【功能列表】</title>
<!-- Main Container Start -->
<div id="mws-container" class="clearfix">
    <!-- Inner Container Start -->
    <div class="container">
        <!-- Data Table with Numbered Pagination -->
        <div class="mws-panel grid_8">
            <div class="mws-panel-header">
                <span><i class="icon-table"></i> 功能管理<a at="create" href="<?php echo Yii::app()->baseUrl; ?>/backend.php?r=rbac/node/create" style="cursor: pointer;padding-left: 78%;"><input type="button" value="添加功能"></a></span>
            </div>
            <div>
                <?php foreach($models as $key=>$val){ ?>
                    <span style="line-height: 30px;">
                        <span><?php echo $val['first']['title']; ?>(<?php echo $val['first']['name']; ?>)</span>
                        <span at="create" ><a style="color: #008000;" href="<?php echo Yii::app()->baseUrl; ?>/backend.php?r=rbac/node/create&pid=<?php echo $val['first']['id']; ?>">添加</a></span>
                        <span at="edit" ><a style="color: #008000;" href="<?php echo Yii::app()->baseUrl; ?>/backend.php?r=rbac/node/edit&id=<?php echo $val['first']['id']; ?>">编辑</a></span>
                        <span at="del" ><a style="color: #008000;" href="<?php echo Yii::app()->baseUrl; ?>/backend.php?r=rbac/node/del&id=<?php echo $val['first']['id']; ?>">删除</a></span>
                    </span>
                    <br/>
                    <?php if($val['two']){ ?>
                        <?php foreach($val['two'] as $kk=>$vv){ ?>
                            <span style="margin-left: 20px;line-height: 30px;">
                                <span><?php echo $vv['title']; ?>(<?php echo $vv['name']; ?>)</span>
                                <span at="edit" ><a style="color: #008000;" href="<?php echo Yii::app()->baseUrl; ?>/backend.php?r=rbac/node/edit&id=<?php echo $vv['id']; ?>">编辑</a></span>
                                <span at="del" ><a style="color: #008000;" href="<?php echo Yii::app()->baseUrl; ?>/backend.php?r=rbac/node/del&id=<?php echo $vv['id']; ?>">删除</a></span>
                            </span>
                            <br/>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
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