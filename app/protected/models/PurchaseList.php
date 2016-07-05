<?php
  class PurchaseList extends CActiveRecord {
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }
 
    public function tableName() {
        return 'purchase_lists';
    }
  }