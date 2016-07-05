<?php
  class Helper extends CActiveRecord {
    public static function ifAllow($name = null, $true = '', $false = '') {
      if (!empty($name)) {
        $attr['name'] = $name;
        $attr['user_id'] = Yii::app()->session['User']['id'];
        $attr['value'] = 1;
        $Permission = Permission::model()->findByAttributes($attr);

        if (!empty($Permission->id)) {
          return $true;
        }
      }

      return $false;
    }

    public static function ifAllowMenu($name = null) {
      if (!empty($name)) {
        $attr['name'] = $name;
        $attr['user_id'] = Yii::app()->session['User']['id'];
        $attr['value'] = 1;
        $Permission = Permission::model()->findByAttributes($attr);
        if (!empty($Permission->id)) {
          return true;
        }
      }

      return false;
    }
  }