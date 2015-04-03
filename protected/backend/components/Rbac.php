<?php
class Rbac {
    public static function checkAccess($module,$action='') {
        $user_id = $_SESSION['admin_uid'];
        // 系统管理员登陆
        if($user_id == 1) {
            return true;
        }

        $accessList = self::getAccessList($user_id);
        if(empty($action)) {
            if(!empty($accessList[strtoupper($module)])) {
                return true;
            } else {
                return false;
            }
        } else {
            if(!isset($accessList[strtoupper($module)][strtoupper($action)])) {
                return false;
            } else {
                return true;
            }
        }
    }

    public static function getAccessList($user_id) {
        $command = Yii::app()->db->createCommand();
        $role_id = $command->select('role_id')->from('basic_role_user')->where('user_id = :uid',array(':uid'=>$user_id))->queryScalar();
        if(empty($role_id)) {
            return false;
        }
        if($_SESSION['access_list'][$role_id]) {
            return $_SESSION['access_list'][$role_id];
        } else {
            $access =  array();
            $command = Yii::app()->db->createCommand();
            $where = "b.user_id = {$user_id} and a.status = 1 and d.level = 1 and d.status = 1";
            $modules = $command->select('d.id,d.name')->from('basic_role a')
                   ->leftJoin('basic_role_user b','b.role_id = a.id')
                   ->leftJoin('basic_access c','c.role_id = b.role_id')
                   ->leftJoin('basic_node d','d.id = c.node_id')
                   ->where($where)->queryAll();

            foreach($modules as $key=>$val) {
                $moduleId = $val['id'];
                $moduleName = $val['name'];
                $where_action = "b.user_id = {$user_id} and a.status = 1 and d.level = 2 and d.status = 1 and d.pid = {$moduleId}";
                $command->reset();
                $action = $command->select('d.id,d.name')->from('basic_role a')
                    ->leftJoin('basic_role_user b','b.role_id = a.id')
                    ->leftJoin('basic_access c','c.role_id = b.role_id')
                    ->leftJoin('basic_node d','d.id = c.node_id')
                    ->where($where_action)->queryAll();

                $new_action = array();
                foreach($action as $kk=>$vv) {
                    $new_action[$vv['name']] = $vv['id'];
                }
                $access[strtoupper($moduleName)] = array_change_key_case($new_action,CASE_UPPER);
            }
            $_SESSION['access_list'][$role_id] = $access;
            return $access;
        }
    }
}