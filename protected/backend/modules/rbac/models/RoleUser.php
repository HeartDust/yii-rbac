<?php

class RoleUser extends CActiveRecord {

  public static function model($className=__CLASS__) {
    return parent::model($className);
  }

  public function tableName() {
    return '{{role_user}}';
  }

  public function relations() {
    return array(
    );
  }
}