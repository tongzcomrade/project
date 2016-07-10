<?php
class FrontendController extends Controller {
    public function actionIndex() {
        $this->layout = 'frontLayout';
        $this->render('index');
    }

    public function actionRegister() {
        $this->layout = 'frontLayout';

        $this->render('register');
    }

    public function actionGallery() {
        $this->layout = 'frontLayout';

        $this->render('gallery');
    }

    public function actionRecommend() {
        $this->layout = 'frontLayout';

        $this->render('recommend');
    }

    public function actionLogin() {
        $this->layout = 'frontLayout';

        $this->render('login');
    }

    public function actionForgotPassword() {
        $this->layout = 'frontLayout';

        $this->render('forgotPassword');
    }

    public function actionSaveMember() {
        $post = $_POST;

        if (empty($post['first_name']) || empty($post['last_name']) || empty($post['email']) ||
            empty($post['username']) || empty($post['password']) || empty($post['re_password']) ||
            empty($post['address']) || !isset($post['question']) || !isset($post['answer'])) {
            echo CJSON::encode(['status' => 'error', 'msg' => 'กรอกข้อมูลไม่ครบ']);
            return;
        }

        if ($post['password'] != $post['re_password']) {
            echo CJSON::encode(['status' => 'error', 'msg' => 'รหัสผ่านไม่ตรงกัน']);
            return;
        }

        $attributes['email'] = $post['email'];
        $userModel = UserModel::model()->findByAttributes($attributes);
        if (!empty($userModel)) {
            echo CJSON::encode(['status' => 'error', 'msg' => 'อีเมล์นี้ถูกใช้งานแล้ว']);
            return;
        }

        $userModel = new UserModel();
        $userModel->email = $post['email'];
        $userModel->password = md5($post['password']);
        $userModel->fname = $post['first_name'];
        $userModel->lname = $post['last_name'];
        $userModel->role_id = 6; // member
        $userModel->tel = $post['tel'];
        $userModel->code = $this->generateCode();
        $userModel->created = date('Y-m-d H:i:s');
        $userModel->credit = 0;
        $userModel->username = $post['username'];
        $userModel->status = 0;
        $userModel->question = $post['question'];
        $userModel->answer = $post['answer'];
        if ($userModel->save()) {
            echo CJSON::encode(['status' => 'ok', 'msg' => 'ลงทะเบียนสำเร็จ','data' => []]);
            return;
        }

        echo CJSON::encode(['status' => 'error', 'msg' => 'การลงทะเบียนมีปัญหากรุณาติดต่อพนักงานคะ']);
        return;
    }

    public function actionLoginSystem() {
        $post = $_POST;

        if (empty($post['username']) || empty($post['password'])) {
            echo CJSON::encode(['status' => 'error', 'msg' => 'กรุณากรอกข้อมูลให้ครบ']);
            return;
        }

        $rs = UserModel::login($post['username'], $post['password']);

        if (empty($rs)) {
            echo CJSON::encode(['status' => 'error', 'msg' => 'กรอกข้อมูลไม่ถูกต้อง']);
            return;
        }

        if ($rs[0]['status'] == 0) {
            echo CJSON::encode(['status' => 'error', 'msg' => 'กรุณายืนยันข้อมูลกับพนักงานคะ']);
            return;
        }
        
        // TODO Login
        echo CJSON::encode(['status' => 'ok', 'msg' => 'login', 'data' => $rs]);
        return;
    }

    public function actionResetPassword() {
        $post = $_POST;

        if (empty($post['username']) || empty($post['question']) || empty($post['answer'])) {
            echo CJSON::encode(['status' => 'error', 'msg' => 'กรอกข้อมูลไม่ครบ']);
            return;
        }

        $rs = UserModel::findUserByQuestion($post);

        if (empty($rs)) {
            echo CJSON::encode(['status' => 'error', 'msg' => 'กรอกข้อมูลไม่ถูกต้อง']);
            return;
        }

        $token = md5($rs[0]['id']);
        echo CJSON::encode(['status' => 'ok', 'msg' => '', 'data' => $rs[0]['id']]);
        return;
    }

    public function actionResetNewPassword() {
        $this->layout = 'frontLayout';

        $this->render('resetPassword', array('token' => $_GET['token']));
    }
    
    public function actionReset() {
        $post = $_POST;
        
        $userModel = UserModel::model()->findByPk($post['token']);
        $userModel->password = md5($post['password']);
        $userModel->save();

        echo CJSON::encode(['status' => 'ok', 'msg' => 'แก้ไขรหัสผ่านเสร็จสิ้น', 'data' => []]);
        return;
    }
    
    public function generateCode() {
        $sql = 'SELECT id + 1 as max
                FROM users 
                ORDER BY id DESC
                LIMIT 0,1';
        $rs = Yii::app()->db->createCommand($sql)->queryAll();
        $max_id = $rs[0]['max'];
        if (empty($max_id)) {
            $max_id = 1;
        }
        $code = 'MB'.substr('000000'.$max_id, -6);
        
        return $code;
    }
}