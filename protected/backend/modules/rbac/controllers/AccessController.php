<?php
class AccessController extends BackendController {
    public $defaultAction = 'index';
    // 权限修改
    public function actionIndex() {
        $role_id = empty($_REQUEST['role_id']) ? 0 : $_REQUEST['role_id'];
        if(empty($role_id)){
            $this->redirect('backend.php?r=rbac/role');
            exit;
        }
        $command = Yii::app()->db->createCommand();
        $access_info = $command->select()->from('basic_access')->where('role_id = :role_id',array(':role_id'=>$role_id))->queryAll();

        $command->reset();
        $node_info = $command->select()->from('basic_node')->queryAll();

        $new_node_info = array();
        foreach($node_info as $node_key=>$node_val) {
            $new_node_info[$node_key] = $node_val;
            // 判断是否已经授权
            foreach($access_info as $a_key=>$a_val) {
                if($a_val['node_id'] == $node_val['id']) {
                    $new_node_info[$node_key]['access_status'] = 1; // 已经分配了权限
                }
            }
        }

        $arr = array();
        foreach($new_node_info as $key=>$val) {
            if($val['level'] == 1){
                $arr[$val['name']]['first'] = $val;
                foreach($new_node_info as $kk=>$vv){
                    if($vv['pid'] == $val['id']){
                        $arr[$val['name']]['two'][] = $vv;
                    }
                }
            }
        }
        $this->render('list',array('models'=>$arr,'role_id'=>$role_id));
    }

    // 更新权限
    public function actionUpdate() {
        $role_id = $_POST['role_id'];
        $first_arr = $_POST['first']; // 控制器权限
        $two_arr = $_POST['two']; // 动作权限

        $command = Yii::app()->db->createCommand();
        // 清空该角色所有权限
        if(empty($first_arr)) {
            $command->reset();
            $command->delete('basic_access','role_id = :role_id',array(':role_id'=>$role_id));
        } else {
            // 该角色已有控制器权限
            $command->reset();
            $first_access = $command->select()->from('basic_access')->where('role_id = :role_id and level = :level',array(':role_id'=>$role_id,':level'=>1))->queryAll();
            if($first_access) {
                $arr = array();
                foreach($first_access as $val) {
                    $arr[] = $val['node_id'];
                }
            }

            $new_arr = array();
            if($arr) {
                // 该角色已有控制器权限情况
                $new_arr = array_merge(array_diff($first_arr, array_intersect($first_arr, $arr)), array_diff($arr, array_intersect($first_arr, $arr)));
                foreach($new_arr as $vv) {
                    $command->reset();
                    $role_access = $command->select('role_id')->from('basic_access')->where('role_id = :role_id and node_id = :node_id and level = :level',array(':role_id'=>$role_id,':node_id'=>$vv,':level'=>1))->queryScalar();
                    if($role_access) {
                        // 有权限,删除该权限
                        $command->reset();
                        $command->delete('basic_access','role_id = :role_id and node_id = :node_id and level = :level',array(':role_id'=>$role_id,':node_id'=>$vv,':level'=>1));
                    } else {
                        // 没有权限,插入该权限
                        $command->reset();
                        $command->insert('basic_access',array('role_id'=>$role_id,'node_id'=>$vv,'level'=>1,'pid'=>0));
                    }
                }
            } else {
                // 该角色一个控制器权限没有情况
                $new_arr = $first_arr;
                foreach($new_arr as $vv) {
                    $command->reset();
                    $command->insert('basic_access',array('role_id'=>$role_id,'node_id'=>$vv,'level'=>1,'pid'=>0));
                }
            }


            // 该角色已有动作权限
            $command->reset();
            $two_access = $command->select()->from('basic_access')->where('role_id = :role_id and level = :level',array(':role_id'=>$role_id,':level'=>2))->queryAll();
            if($two_access) {
                $action_arr = array();
                foreach($two_access as $val) {
                    $action_arr[] = $val['node_id'];
                }
            }

            $new_arr = array();
            if($action_arr) {
                // 该角色已有动作权限情况
                if(empty($two_arr)) {
                    // 清空该角色所有的动作权限
                    $command->reset();
                    $command->delete('basic_access','role_id = :role_id and level = :level',array(':role_id'=>$role_id,':level'=>2));
                } else {
                    $new_arr = array_merge(array_diff($two_arr, array_intersect($two_arr, $action_arr)), array_diff($action_arr, array_intersect($two_arr, $action_arr)));
                    foreach($new_arr as $vv) {
                        $command->reset();
                        $role_access = $command->select('role_id')->from('basic_access')->where('role_id = :role_id and node_id = :node_id and level = :level',array(':role_id'=>$role_id,':node_id'=>$vv,':level'=>2))->queryScalar();
                        if($role_access) {
                            // 有权限,删除该权限
                            $command->reset();
                            $command->delete('basic_access','role_id = :role_id and node_id = :node_id and level = :level',array(':role_id'=>$role_id,':node_id'=>$vv,':level'=>2));
                        } else {
                            // 没有权限,插入该权限
                            $command->reset();
                            $pid = $command->select('pid')->from('basic_node')->where('id = :id',array(':id'=>$vv))->queryScalar();
                            $command->reset();
                            $command->insert('basic_access',array('role_id'=>$role_id,'node_id'=>$vv,'level'=>2,'pid'=>$pid));
                        }
                    }
                }
            } else {
                // 该角色一个动作权限没有情况
                if(!empty($two_arr)) {
                    $new_arr = $two_arr;
                    foreach($new_arr as $vv) {
                        $command->reset();
                        $pid = $command->select('pid')->from('basic_node')->where('id = :id',array(':id'=>$vv))->queryScalar();
                        $command->reset();
                        $command->insert('basic_access',array('role_id'=>$role_id,'node_id'=>$vv,'level'=>2,'pid'=>$pid));
                    }
                }
            }
        }
        unset($_SESSION['access_list']);
        $this->redirect(array('/tips/index','href'=>'backend.php?r=rbac/access&role_id='.$role_id,'message'=>'更新成功'));
    }
}