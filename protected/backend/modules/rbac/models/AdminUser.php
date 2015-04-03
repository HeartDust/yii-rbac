<?php
class AdminUser extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return '{{admin_user}}';
    }

    public function rules() {
        return array(
            array('username,password,tel,create_time','safe'),
        );
    }

    public function relations() {
        return array(
        );
    }
}