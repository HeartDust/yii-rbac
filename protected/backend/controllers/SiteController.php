<?php
class SiteController extends CController
{
	/**
	 * 后台首页
	 */
	public function actionIndex()
	{
        if(empty($_SESSION['admin_uid'])){
            $this->redirect('backend.php?r=site/login');
        }else{
            $this->render('index');
        }
	}
	/**
	 * 登录
	 */
	public function actionLogin()
	{
        if($_SESSION['admin_uid']){
            $this->redirect('backend.php?r=site/index');
        }else{
            if($_POST){
                $username = $_POST['username'];
                $pwd = md5($_POST['pwd']);
                $command = Yii::app()->db->createCommand();
                $userInfo = $command->select('id,username')->from('basic_admin_user')->where('username=:username and password=:pwd',array(':username'=>$username,':pwd'=>$pwd))->queryRow();
                $_SESSION['admin_uid'] = $userInfo['id'];
                $_SESSION['username'] = $userInfo['username'];
                $this->redirect('backend.php?r=site/index');
            }else{
                $this->renderPartial('login');
            }
        }
	}

    /**
     * 登录验证
     */
    public function actionVerify()
    {
        $username = $_GET['username'];
        $pwd = md5($_GET['pwd']);

        $command = Yii::app()->db->createCommand();
        $id = $command->select('id')->from('basic_admin_user')->where('username = :username and password = :pwd',array(':username'=>$username,':pwd'=>$pwd))->queryScalar();
        if($id)
        {
            echo 1; // 用户存在
        }else
        {
            echo 2; // 用户不存在
        }
    }

    /**
     * 退出登录
     */
    public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect('backend.php?r=site/index');
	}

    /**
     * 修改密码
     */
    public function actionPwd() {
        $uid = $_SESSION['admin_uid'];
        if(isset($_POST['password'])) {
            $password = md5(trim($_POST['password']));
            $command = Yii::app()->db->createCommand();
            $command->update('basic_admin_user',array('password'=>$password),'id = :id',array(':id'=>$_SESSION['admin_uid']));
            $this->redirect(array('/tips/index','href'=>'backend.php?r=site/index','message'=>'修改成功'));
        } else {
            $command = Yii::app()->db->createCommand();
            $info = $command->select()->from('basic_admin_user')->where('id = :id',array(':id'=>$uid))->queryRow();
            $this->render('edit_pwd',array('user_info'=>$info));
        }
    }
}