<?php
class TipsController extends CController {
    public function actionIndex(){
        $arr['href'] = $_GET['href'];
        $arr['message'] = $_GET['message'];
        $arr['waitSecond'] = '3';
        $this->render('tips',array('info'=>$arr));
    }
}