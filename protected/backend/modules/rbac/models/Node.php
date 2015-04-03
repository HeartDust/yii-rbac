<?php

class Node extends CActiveRecord {

  public static function model($className=__CLASS__) {
    return parent::model($className);
  }

  public function tableName() {
    return '{{node}}';
  }

  public function rules() {
    return array(
    array('name,title,status,remark,sort,pid,level','safe'),
    );
  }

  public function relations() {
    return array(
    );
  }
}