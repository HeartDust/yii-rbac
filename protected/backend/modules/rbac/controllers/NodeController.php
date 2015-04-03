<?php
class NodeController extends BackendController {
    public $defaultAction = 'index';
    // 功能列表
    public function actionIndex() {
        $models = Node::model()->findAll();
        $arr = array();
        foreach($models as $key=>$val){
            if($val->attributes['level'] == 1){
                $arr[$val->attributes['name']]['first'] = $val->attributes;
                foreach($models as $kk=>$vv){
                    if($vv->attributes['pid'] == $val->attributes['id']){
                        $arr[$val->attributes['name']]['two'][] = $vv->attributes;
                    }
                }
            }
        }
        $this->render('list',array('models'=>$arr));
    }

    // 添加功能
    public function actionCreate() {
        if (isset($_POST['title'])) {
            $model = new Node;
            if($_POST['remark'] == "控制器"){
                $level = 1;
            }elseif($_POST['remark'] == "动作"){
                $level = 2;
            }
            $model->attributes = array(
                'name' => strtolower(trim($_POST['name'])),
                'title' => trim($_POST['title']),
                'status' => 1,
                'remark' => $_POST['remark'],
                'pid' => $_POST['pid'],
                'level' => $level
            );
            if ($model->save()) {
                $this->redirect(array('/tips/index','href'=>'backend.php?r=rbac/node','message'=>'添加成功'));
            }
        } else {
            $pid = empty($_REQUEST['pid']) ? 0 : $_REQUEST['pid'];
            $this->render('create',array('pid'=>$pid));
        }
    }

    // 编辑功能
    public function actionEdit() {
        if(isset($_POST['title'])) {
            $model = Node::model()->findByPk($_POST['id']);
            $model->attributes = array(
                'name' => strtolower(trim($_POST['name'])),
                'title' => trim($_POST['title']),
            );
            if($model->save()) {
                unset($_SESSION['access_list']);
                $this->redirect(array('/tips/index','href'=>'backend.php?r=rbac/node','message'=>'更新成功'));
            }
        } else {
            $id = $_REQUEST['id'];
            if(empty($id)) {
                $this->redirect(Yii::app()->baseUrl.'/backend.php?r=rbac/node');
                exit;
            }
            $criteria = new CDbCriteria;
            $criteria->condition = "id = {$id}";
            $node_info = Node::model()->find($criteria);
            $this->render('edit',array('node_info'=>$node_info));
        }
    }

    // 删除功能
    public function actionDel() {
        $id = $_REQUEST['id'];
        $criteria = new CDbCriteria;
        $criteria->condition = "id = {$id}";
        $node_info = Node::model()->find($criteria);
        $node_info = $node_info->attributes;
        if($node_info) {
            if($node_info['pid'] == 0) {
                // 删除控制器功能
                $where = "id = {$id} or (pid = {$id} and level = 2)";
                $node_result = Node::model()->deleteAll($where);
                if($node_result) {
                    // 删除对应的权限
                    $command = Yii::app()->db->createCommand();
                    $command->delete("basic_access","(node_id = :node_id and level = :level) or (pid = :pid and level = :lev)",array(":node_id"=>$id,":level"=>1,":pid"=>$id,":lev"=>2));
                    unset($_SESSION['access_list']);
                    $this->redirect(array('/tips/index','href'=>'backend.php?r=rbac/node','message'=>'删除成功'));
                } else {
                    $this->redirect(array('/tips/index','href'=>'backend.php?r=rbac/node','message'=>'功能删除失败'));
                }
            } else {
                // 删除动作功能
                $node_model = Node::model()->findByPk($id);
                $node_result = $node_model->delete();
                if($node_result) {
                    // 删除对应的权限
                    $command = Yii::app()->db->createCommand();
                    $command->delete("basic_access","node_id = :node_id and level = :level",array(":node_id"=>$id,":level"=>2));
                    unset($_SESSION['access_list']);
                    $this->redirect(array('/tips/index','href'=>'backend.php?r=rbac/node','message'=>'删除成功'));
                } else {
                    $this->redirect(array('/tips/index','href'=>'backend.php?r=rbac/node','message'=>'功能删除失败'));
                }
            }
        } else {
            $this->redirect(array('/tips/index','href'=>'backend.php?r=rbac/node','message'=>'链接错误'));
        }
    }

    // 验证功能标识是否存在
    function actionVerify() {
        $name = strtolower(trim($_REQUEST['name']));
        $pid = $_REQUEST['pid'];
        $id = $_REQUEST['id'];
        $criteria = new CDbCriteria;
        if(empty($id)) {
            // 添加页的验证
            $criteria->condition = "name = '$name' and pid = '$pid'";
        } else {
            // 编辑页的验证
            $criteria->condition = "name = '$name' and pid = '$pid' and id != '$id'";
        }
        $result = Node::model()->find($criteria);
        if($result) {
            echo 1; // 已经存在
        } else {
            echo 2; // 可以使用
        }
    }
}