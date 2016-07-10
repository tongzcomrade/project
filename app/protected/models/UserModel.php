<?php
  class UserModel extends CActiveRecord {
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }
 
    public function tableName() {
        return 'users';
    }

    public static function login($username, $password) {
        $sql = 'SELECT * 
                FROM users
                WHERE username = "'.$username.'" AND password = "'.md5($password).'" 
                ORDER BY id DESC
                LIMIT 0,1';
        $rs = Yii::app()->db->createCommand($sql)->queryAll();

        return $rs;
    }

      public static function findUserByQuestion($data) {
          $sql = 'SELECT * 
                  FROM users
                  WHERE username = "'.$data['username'].'" AND question = "'.$data['question'].'" AND answer = "'.$data['answer'].'" 
                  ORDER BY id DESC';
          $rs = Yii::app()->db->createCommand($sql)->queryAll();

          return $rs;
      }

      public static function findByToken($data) {
          
      }
  }