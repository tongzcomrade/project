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

    /**
     *
     */
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