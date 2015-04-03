<?php

class Role extends CActiveRecord {

  public static function model($className=__CLASS__) {
    return parent::model($className);
  }

  public function tableName() {
    return '{{role}}';
  }

  public function rules() {
    return array(
    array('name,pid,status,remark','safe'),
    );
  }

  public function relations() {
    return array(
    );
  }
}