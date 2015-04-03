<?php
class BackendController extends CController {
    public $layout = '//layouts/main';
    public function init()
    {
        if(empty($_SESSION['admin_uid']))
        {
            $this->initLogin();
        } else {
            $moduleName = $this->getId();
            $str = str_replace('r=','',$_SERVER['QUERY_STRING']);
            $new_arr = explode('&',$str);
            $new_str = $new_arr[0];
            $arr = explode('/',$new_str);
            if($arr[0] == 'rbac') {
                $actionName = $arr[2];
            } else {
                $actionName = $arr[1];
            }
            if(empty($actionName)) {
                $actionName = 'index';
            }

            $result = Rbac::checkAccess($moduleName,$actionName);
            if(empty($result)) {
                $this->redirect(array('/tips/index','href'=>'backend.php?r=site/index','message'=>'没有权限'));
            }
        }
        parent::init();
    }

    // 初始化登陆
    public function initLogin()
    {
        $this->redirect('backend.php?r=site/login');
    }
}
