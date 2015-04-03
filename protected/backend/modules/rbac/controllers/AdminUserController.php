<?php
class AdminUserController extends BackendController {
    public $defaultAction = 'index';
    // 后台用户列表
    public function actionIndex() {
        if($_REQUEST['role_id']) {
            $command = Yii::app()->db->createCommand();
            $info = $command->select()->from('basic_admin_user a')->leftJoin('basic_role_user b','b.user_id = a.id')->where('b.role_id = :id',array(':id'=>$_REQUEST['role_id']))->queryAll();
            $arr = array();
            foreach($info as $key=>$val){
                $command->reset();
                $arr[$key] = $val;
                $role_name = $command->select('b.name')->from('basic_role_user a')->leftJoin('basic_role b','b.id = a.role_id')->where('a.user_id = :id',array(':id'=>$val['id']))->queryScalar();
                $arr[$key]['role_name'] = $role_name;
            }
        } else {
            $models = AdminUser::model()->findAll('id != 1');
            $arr = array();
            foreach($models as $key=>$val){
                $command = Yii::app()->db->createCommand();
                $arr[$key] = $val->attributes;
                $role_name = $command->select('b.name')->from('basic_role_user a')->leftJoin('basic_role b','b.id = a.role_id')->where('a.user_id = :id',array(':id'=>$val->attributes['id']))->queryScalar();
                $arr[$key]['role_name'] = $role_name;
            }
        }
        $this->render('list',array('models'=>$arr));
    }

    // 添加用户
    public function actionCreate() {
        if (isset($_POST['username'])) {
            $model = new AdminUser;
            $model->attributes = array(
                'username' => trim($_POST['username']),
                'password' => md5($_POST['password']),
                'tel' => trim($_POST['tel']),
                'create_time' => time()
            );

            if ($model->save()) {
                $uid = Yii::app()->db->getLastInsertID();
                if(!empty($_POST['role_id'])) {
                    $role_user = new RoleUser;
                    $role_user->role_id = $_POST['role_id'];
                    $role_user->user_id = $uid;
                    $role_user->save();
                }

                $this->redirect(array('/tips/index','href'=>'backend.php?r=rbac/adminuser','message'=>'添加成功'));
            } else {
                $role_list = Role::model()->findAll();
                $this->render('create',array('role_list'=>$role_list));
            }
        } else {
            $role_list = Role::model()->findAll();
            $this->render('create',array('role_list'=>$role_list));
        }
    }

    // 修改用户信息
    public function actionEdit() {
        $id = $_REQUEST['uid'];
        if($id == 1) {
            $this->redirect(Yii::app()->baseUrl."/backend.php?r=rbac/adminuser");
            exit;
        }
        $command = Yii::app()->db->createCommand();
        $user_info = $command->select()->from('basic_admin_user a')->leftJoin('basic_role_user b','b.user_id = a.id')->where('a.id = :id',array(':id'=>$id))->queryRow();
        $role_list = Role::model()->findAll();
        $this->render('edit',array('user_info'=>$user_info,'role_list'=>$role_list));
    }

    // 更新用户信息
    public function actionUpdate() {
        $model = AdminUser::model()->findByPk($_POST['uid']);
        $password = trim($_POST['password']);
        if(!empty($password)) {
            $model->attributes = array(
                'password' => md5($password),
                'tel' => trim($_POST['tel']),
            );
        } else {
            $model->attributes = array(
                'tel' => trim($_POST['tel']),
            );
        }

        if($model->save()) {
            $command = Yii::app()->db->createCommand();
            if($_POST['role_id'] == 0) {
                $command->delete('basic_role_user','user_id = :user_id',array(':user_id'=>$_POST['uid']));
            } else {
                $command->update('basic_role_user',array('role_id'=>$_POST['role_id']),'user_id = :id',array(':id'=>$_POST['uid']));
            }
            $this->redirect(array('/tips/index','href'=>'backend.php?r=rbac/adminuser','message'=>'更新成功'));
        }
    }

    // 删除用户
    public function actionDel() {
        $id = $_REQUEST['uid'];
        $model = AdminUser::model()->findByPk($id);
        $result = $model->delete();
        if($result) {
            $command = Yii::app()->db->createCommand();
            $command->delete('basic_role_user','user_id = :id',array(':id'=>$id));
            $this->redirect(array('/tips/index','href'=>'backend.php?r=rbac/adminuser','message'=>'删除成功'));
        } else {
            $this->redirect(array('/tips/index','href'=>'backend.php?r=rbac/adminuser','message'=>'删除失败'));
        }
    }

    // 验证用户名
    public function actionVerifyName() {
        $username = $_REQUEST['username'];
        $criteria = new CDbCriteria;
        $criteria->condition = "username = '$username'";
        $result = AdminUser::model()->find($criteria);
        if($result) {
            echo 1; // 用户名重复
        } else {
            echo 2; // 可以使用该用户名
        }
    }
}