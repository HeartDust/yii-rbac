<?php
class RoleController extends BackendController {
    public $defaultAction = 'index';
    // 角色列表
    public function actionIndex() {
        $models = Role::model()->findAll();
        $this->render('role_list',array('models'=>$models));
    }

    // 添加角色
    public function actionCreate() {
        if (isset($_POST['Role'])) {
            $model = new Role;
            $model->attributes = $_POST['Role'];
            if ($model->save()) {
                $this->redirect(array('/tips/index','href'=>'backend.php?r=rbac/role','message'=>'添加成功'));
            } else {
                $this->renderPartial('role_list');
            }
        } else {
            $this->render('role_create');
        }
    }

    // 修改角色名
    public function actionEdit() {
        if(isset($_POST['name'])) {
            $model = Role::model()->findByPk($_POST['id']);
            $model->attributes = array(
                'name' => trim($_POST['name']),
            );
            if($model->save()){
                $this->redirect(array('/tips/index','href'=>'backend.php?r=rbac/role','message'=>'更新成功'));
            }
        } else {
            $id = $_REQUEST['role_id'];
            if(empty($id)) {
                $this->redirect(Yii::app()->baseUrl.'/backend.php?r=rbac/role');
                exit;
            }
            $criteria = new CDbCriteria;
            $criteria->condition = "id = {$id}";
            $model = Role::model()->find($criteria);
            $this->render('edit',array('role_info'=>$model));
        }
    }

    // 删除角色
    public function actionDel() {
        $id = $_REQUEST['id'];
        $criteria = new CDbCriteria;
        $criteria->condition = "role_id= {$id}";
        $model = RoleUser::model()->findAll($criteria);
        if($model[0]->attributes) {
            echo 1; // 该角色下有用户不能删除
            exit;
        } else {
            $role_model = Role::model()->findByPk($id);
            $role_result = $role_model->delete();
            if($role_result) {
                // 删除该角色对应的权限
                $command = Yii::app()->db->createCommand();
                $command->delete("basic_access","role_id = :role_id",array(":role_id"=>$id));
                unset($_SESSION['access_list']);
                echo 2; // 删除成功
            } else {
                echo 3; // 删除失败
            }
        }
    }
}