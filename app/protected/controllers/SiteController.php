<?php

class SiteController extends Controller {

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()	{
		$this->layout = 'frontLayout';
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	public function actionMainService()	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	public function actionWelcome() {
			$this->render('welcome');
	}

	/*
	 * user and member restful
	 */
	public function actionUsersList() {
		$condition = ' AND '. 1;

		if (!empty($_POST['role_id'])) {
			$condition .= ' AND users.role_id = '.$_POST['role_id'];
		}

		if (!empty($_POST['cols'])) {
			if ($_POST['cols'] == 'name') {
				$condition .= ' AND users.fname = "'.$_POST['search'].'" OR users.lname = "'.$_POST['search'].'"';
			}
			else {
				$condition .= ' AND users.'.$_POST['cols'].' = "'.$_POST['search'].'"';	
			}
		}

		$sql = 'SELECT users.*, roles.name as role 
						FROM users INNER JOIN roles ON users.role_id = roles.id 
						WHERE 1'.$condition.'
						ORDER BY users.status DESC , users.id ASC';

    $members = Yii::app()->db->createCommand($sql)->queryAll();

    $this->render('usersList', array('members' => $members, 'title' => 'รายการพนักงาน', 'is_employee' => true));
	}

	public function actionRegisterUser() {
		$sql = 'SELECT * FROM roles ORDER BY id ASC';
    $roles = Yii::app()->db->createCommand($sql)->queryAll();

		$this->render('registerUser', array('roles' => $roles, 'title' => 'ลงทะเบียนพนักงาน', 'is_employee' => true));
	}

	public function actionEditUser() {
		$id = $_GET['id'];
		$sql = 'SELECT * FROM users WHERE id = '.$id.' ORDER BY id ASC';
    $rs = Yii::app()->db->createCommand($sql)->queryAll();
    $member = $rs[0];

		$sql = 'SELECT * FROM roles ORDER BY id ASC';
    $roles = Yii::app()->db->createCommand($sql)->queryAll();

		$this->render('registerUser', array('member' => $member, 'roles' => $roles, 'title' => 'ลงทะเบียนพนักงาน', 'is_employee' => true));
	}

	public function actionMembersList() {
		$sql = 'SELECT users.*, roles.name as role FROM users INNER JOIN roles ON users.role_id = roles.id WHERE role_id = (6) ORDER BY id ASC';
    $members = Yii::app()->db->createCommand($sql)->queryAll();

    $this->render('usersList', array('members' => $members, 'title' => 'รายการสมาชิก', 'is_employee' => false));
	}

	public function actionPostUser() {
		$data = $_POST;

		if (empty($data)) {
			// return
		}

		if (empty($data['email']) || empty($data['password']) ||
				empty($data['re_password']) || empty($data['fname']) ||
				empty($data['lname']) || empty($data['address']) || 
				empty($data['tel'])) {
			// return
		}

		if ($data['re_password'] != $data['password']) {
			// return
		}

    if (empty($data['id'])) {
			$User = new User();

			$last_user_id = $this->actionGetLastUser() + 1;
	    $code = 'MB'.substr('000000'.$last_user_id, -6);
			$User->code = $code;
    }
    else {
    	$User = User::model()->findByPk($data['id']);
    }

		$User->email = $data['email'];
		$User->password = md5($data['password']);
		$User->fname = $data['fname'];
		$User->username = $data['username'];
		$User->lname = $data['lname'];
		$User->address = $data['address'];
		$User->tel = $data['tel'];
		$User->role_id = 6; // member
		$User->created = date('Y-m-d H:i:s');
		
		if ($User->save()) {
			$last_user_id = $this->actionGetLastUser();
			if (!empty($data['fromBackOffice'])) {
				$this->redirect('index.php?r=site/registerUser');				
			}
			else {
				$this->redirect('index.php');
			}
		}
	}

	public function actionPutPermission() {
		$id = $_GET['id'];
		
		$sql = 'SELECT *
						FROM users
						WHERE users.id = '.$id.' ORDER BY users.id ASC';
    $rs = Yii::app()->db->createCommand($sql)->queryAll();
    $member = $rs[0];

    $sql = 'SELECT *
						FROM permissions
						WHERE user_id = '.$id.' ORDER BY id ASC';
    $permissions = Yii::app()->db->createCommand($sql)->queryAll();

    $sql = 'SELECT *
						FROM roles ORDER BY id ASC';
    $roles = Yii::app()->db->createCommand($sql)->queryAll();

    $permission = array();
    foreach ($permissions as $key => $value) {
    	$permission[$value['name']] = $value['value'];
    }

		$this->render('addPermission', array('member' => $member, 'permission' => $permission, 'roles' => $roles));
	}

	public function actionDeleteUser() {
		if (!is_numeric($_POST['id'])) {
			echo json_encode(false);
			return;
		}
		
		if (User::model()->deleteByPk($_POST['id'])) {
			echo json_encode(true);
			return;
		}

		echo json_encode(false);
	}

	public function actionGetLastUser() {
		$sql = 'SELECT id FROM users ORDER BY id DESC LIMIT 1';
    $rs = Yii::app()->db->createCommand($sql)->queryAll();
    $last_user_id = $rs[0]['id'];

	 	return $last_user_id;   
	}

	public function actionAddPermission() {
		// clear all permission
		$attr['user_id'] = $_POST['user_id'];

		$User = User::model()->findByPk($_POST['user_id']);
		$User->status = $_POST['user_status'];
		$User->role_id = $_POST['user_type'];
		$User->save();

		Permission::model()->deleteAllByAttributes($attr);

		if (!empty($_POST['Permission'])) {
			$permissions = $_POST['Permission'];
			$user_id = $_POST['user_id'];

			foreach ($permissions as $key => $value) {
				$Permission = new Permission();
				$Permission->user_id = $user_id;
				$Permission->name = $key;
				$Permission->value = $value;
				$Permission->save();
			}
		}

		$this->redirect('index.php?r=site/usersList');
	}
	/*
	 * supplier restful
	 */
	public function actionSuppliersList() {
		$sql = 'SELECT * FROM suppliers ORDER BY id ASC';
    $suppliers = Yii::app()->db->createCommand($sql)->queryAll();

		$this->render('suppliersList', array('suppliers' => $suppliers));
	}

	public function actionRegisterSupplier() {
		$sql = 'SELECT * FROM suppliers ORDER BY id ASC';
    $suppliers = Yii::app()->db->createCommand($sql)->queryAll();

    $sql = 'SELECT * FROM items ORDER BY id ASC';
    $items = Yii::app()->db->createCommand($sql)->queryAll();

		$this->render('registerSupplier', array('suppliers' => $suppliers, 'items' => $items));	
	}

	public function actionEditSupplier() {
		$id = $_GET['id'];
		$supplier = Supplier::model()->findByPk($id);

		$this->render('registerSupplier', array('supplier' => $supplier));	
	}

	public function actionInsertSupplier() {
		if (empty($_POST)) {

		}

		$data = $_POST;

		if (empty($data['name']) || empty($data['tel']) || empty($data['address'])) {

		}

		if (empty($data['id'])) {
			$Supplier = new Supplier();
		}
		else {
			$Supplier = Supplier::model()->findByPk($data['id']);
		}

		$Supplier->name = $data['name'];
		$Supplier->tel = $data['tel'];
		$Supplier->address = $data['address'];
		
		if ($Supplier->save()) {
			$this->redirect('index.php?r=site/suppliersList');
		}
	}

	public function actionDeleteSupplier() {
		if (!is_numeric($_POST['id'])) {
			echo json_encode(false);
			return;
		}
		
		if (Supplier::model()->deleteByPk($_POST['id'])) {
			echo json_encode(true);
			return;
		}

		echo json_encode(false);
	}

	/*
	 * item type restful
	 */
	public function actionItemTypesList() {
		$sql = 'SELECT * FROM item_types ORDER BY id ASC';
    $item_types = Yii::app()->db->createCommand($sql)->queryAll();

    $sql = 'SELECT count(id) as count FROM items GROUP BY item_type_id ORDER BY id ASC';
    $counts = Yii::app()->db->createCommand($sql)->queryAll();

    foreach ($counts as $ind => $count) {
    	//$item_types[$ind]['count'] = $count['count'];
    }
		$this->render('itemTypesList', array('item_types' => $item_types));
	}

	public function actionRegisterItemType() {
		$this->render('registerItemType');	
	}
	
	public function actionEditItemType() {
		$id = $_GET['id'];
		$item_type = ItemType::model()->findByPk($id);

		$this->render('registerItemType', array('item_type' => $item_type));	
	}

	public function actionInsertItemType() {
		if (empty($_POST)) {

		}

		$data = $_POST;

		if (empty($data['name']) || empty($data['description'])) {

		}

		if (empty($data['id'])) {
			$ItemType = new ItemType();
		}
		else {
			$ItemType = ItemType::model()->findByPk($data['id']);
		}

		$ItemType->name = $data['name'];
		$ItemType->description = $data['description'];
		
		if ($ItemType->save()) {
			$this->redirect('index.php?r=site/itemTypesList');
		}
	}

	public function actionDeleteItemType() {
		if (!is_numeric($_POST['id'])) {
			echo json_encode(false);
			return;
		}
		
		if (ItemType ::model()->deleteByPk($_POST['id'])) {
			echo json_encode(true);
			return;
		}

		echo json_encode(false);
	}

	/*
	 * item restful
	 */
	public function actionItemsList() {

		$id = $_GET['item_type_id'];

		$sql = 'SELECT items.*
						FROM items
						WHERE item_type_id = '.$id.' ORDER BY id ASC';
    $items = Yii::app()->db->createCommand($sql)->queryAll();

    $sql = 'SELECT * FROM item_types WHERE id = '.$id.' ORDER BY id ASC';
    $item_type = Yii::app()->db->createCommand($sql)->queryAll();
    $item_type = $item_type[0]['name'];

		$this->render('itemsList', array('items' => $items, 'item_type' => $item_type, 'item_type_id' => $id));
	}
	
	public function actionRegisterItem() {
		$sql = 'SELECT * FROM item_types ORDER BY id ASC';
    $item_types = Yii::app()->db->createCommand($sql)->queryAll();

		$this->render('registerItem', array('item_types' => $item_types));	
	}

	public function actionEditItem() {
		$id = $_GET['id'];
		$item = Item::model()->findByPk($id);
		$sql = 'SELECT * FROM item_types ORDER BY id ASC';
    $item_types = Yii::app()->db->createCommand($sql)->queryAll();

		$this->render('registerItem', array('item' => $item, 'item_types' => $item_types));	
	}

	public function actionInsertItem() {
		if (empty($_POST)) {
		}

		$data = $_POST;

		if (empty($data['name']) || !is_numeric($data['supplier_id']) || !is_numeric($data['item_type_id']) ||
			  empty($data['price'])) {

		}

		if (empty($data['id'])) {
			$Item = new Item();
		}
		else {
			$Item = Item::model()->findByPk($data['id']);
		}

		$sql = 'SELECT max(id) as max FROM items';
    $rs = Yii::app()->db->createCommand($sql)->queryAll();
    $max = $rs[0]['max'] + 1;

    $code = 'IT'.substr('000000'.$max, -6);

		$Item->name = $data['name'];
		$Item->supplier_id = $data['supplier_id'];
		$Item->code = $code;
		$Item->item_type_id = $data['item_type_id'];
		$Item->price = $data['price'];

		if ($Item->save()) {
			$this->redirect('index.php?r=site/itemTypesList');
		}
	}

	public function actionDeleteItem() {
		if (!is_numeric($_POST['id'])) {
			echo json_encode(false);
			return;
		}
		
		if (Item::model()->deleteByPk($_POST['id'])) {
			echo json_encode(true);
			return;
		}

		echo json_encode(false);
	}

	/*
	 * purchase restful
	 */
	
	public function actionAddItemToCart() {
		$id = $_POST['id'];
		$type_id = $_POST['type'];


		$sql = 'SELECT * FROM items WHERE id = '.$id;
    $supplier = Yii::app()->db->createCommand($sql)->queryAll();
    $supplier_id = $supplier[0]['supplier_id'];

		$session = new CHttpSession;
		$session->open();

		$cart = Yii::app()->session['_cart'];
		$cart[$supplier_id][] = $id;
		$session->add('_cart', $cart);
	}

	public function actionPurchasesList() {
		$sql = 'SELECT a.*, b.name as name FROM purchases a INNER JOIN suppliers b ON a.supplier_id = b.id ORDER BY a.id, a.status DESC';
    $lists = Yii::app()->db->createCommand($sql)->queryAll();

		$this->render('purchasesList', array('lists' => $lists));
	}

	public function actionRegisterPurchase() {
		if (empty($_GET['id'])) {
			$sql = 'SELECT * FROM suppliers ORDER BY id ASC';
	    $supplier = Yii::app()->db->createCommand($sql)->queryAll();

	    $supplier_id = $supplier[0]['id'];
		}
		else {
			$supplier_id = $_GET['id'];

			$sql = 'SELECT * FROM suppliers WHERE id = '.$supplier_id.' ORDER BY id ASC';
	    $supplier = Yii::app()->db->createCommand($sql)->queryAll();
		}

		$sql = 'SELECT * FROM suppliers ORDER BY id ASC';
	  $suppliers = Yii::app()->db->createCommand($sql)->queryAll();

	  $sql = 'SELECT items.id as id, items.code as code, items.name as name, item_of_suppliers.price as price
	  				FROM item_of_suppliers LEFT JOIN items ON item_of_suppliers.item_id = items.id
	  				WHERE item_of_suppliers.supplier_id = '.$supplier_id.' ORDER BY item_of_suppliers.id ASC';
    $items = Yii::app()->db->createCommand($sql)->queryAll();

		$this->render('registerPurchase', array('suppliers' => $suppliers, 'supplier' => $supplier[0], 'items' => $items));	
	}

	public function actionInsertPurchase() {
		$data = $_POST;
		/*echo '<pre>';
		print_r($data);
		echo '</pre>';
		die();*/

		$sql = 'SELECT max(id) as max FROM purchases LIMIT 1';
    $rs = Yii::app()->db->createCommand($sql)->queryAll();
    $max = $rs[0]['max'] + 1;
    $doc = 'PR'.substr('000000'.$max, -6);

		$Purchase = new Purchase();
		$Purchase->supplier_id = $data['supplier_id'];
		$Purchase->tax = $data['tax'];
		$Purchase->create_by = Yii::app()->session['User']['id'];
		$Purchase->status = 'รอการอนุมัติ';
		$Purchase->created = date('Y-m-d H:i:s');
		$Purchase->net = $data['net'];
		$Purchase->doc_no = $doc;

		if ($Purchase->save()) {
			$sql = 'SELECT max(id) as max FROM purchases LIMIT 1';
	    $rs = Yii::app()->db->createCommand($sql)->queryAll();
	    $purchase_id = $rs[0]['max'];

			$purchase_lists = $data['data'];
			foreach ($purchase_lists as $ind => $list) {
				if ($list['quantity'] <= 0) continue;
				$List = new PurchaseList();
				$List->purchase_id = $purchase_id;
				$List->quantity = $list['quantity'];
				$List->item_id = $list['id'];
				$List->save();
			}
		}

		$session = new CHttpSession;
		$session->open();

		$cart = Yii::app()->session['_cart'];
		$cart[$data['supplier_id']] = null;
		$session->add('_cart', $cart);

		$this->redirect('index.php?r=site/purchasesList');
	}

	public function actionApprovePurchase() {
		$Purchase = Purchase::model()->findByPk($_GET['id']);

		$Purchase->status = 'อนุมัติ';
		$Purchase->save();

		$this->redirect('index.php?r=site/purchasesList');
	}

	public function actionCancelApprove() {
		$Purchase = Purchase::model()->findByPk($_GET['id']);

		$Purchase->status = 'รอการอนุมัติ';
		$Purchase->save();

		$this->redirect('index.php?r=site/purchasesList');
	}

	public function actionUnApprove() {
		$Purchase = Purchase::model()->findByPk($_GET['id']);

		$Purchase->status = 'รายการไม่อนุมัติ';
		$Purchase->save();

		$this->redirect('index.php?r=site/purchasesList');
	}

	public function actionReceiveProduct() {
		$purchase_id = $_GET['id'];

		$sql = 'SELECT 
							a.id as purchase_id,
							a.net as net,
							a.doc_no as doc_no,
							a.tax as tax,
							b.code as code,
							b.name as supplier_name,
							b.address as supplier_address,
							b.tel as supplier_tel,
							c.item_id as item_id,
							c.quantity,
							d.code as item_code,
							d.name,
							e.price
						FROM purchases a LEFT JOIN suppliers b ON a.supplier_id = b.id
						LEFT JOIN purchase_lists c ON a.id = c.purchase_id
						LEFT JOIN items d ON c.item_id = d.id
						LEFT JOIN item_of_suppliers e ON b.id = e.supplier_id AND c.item_id = e.item_id
						WHERE c.quantity > 0 AND a.id = '.$purchase_id.' 
						ORDER BY a.id ASC';
    $purchases = Yii::app()->db->createCommand($sql)->queryAll();

    $this->render('itemReceive', array('purchases' => $purchases));
	}

	public function actionConfirmReceive() {
		$items = $_POST['data'];
		$purchase_id = $_POST['purchase_id'];

		foreach ($items as $k => $item) {
			$item_id = $item['item_id'];
			$quantity = $item['quantity'];

			for($i = 0; $i < $quantity; $i++) {
				$sql = 'SELECT max(ranking) as max FROM item_copies WHERE item_id = '.$item_id.' ORDER BY id ASC';
    		$ranking = Yii::app()->db->createCommand($sql)->queryAll();
    		$ranking = !empty($ranking[0]['max']) ? $ranking[0]['max'] + 1 : 1;

    		$ItemCopy = new ItemCopy();
    		$ItemCopy->ranking = $ranking;
    		$ItemCopy->item_id = $item_id;
    		$ItemCopy->status = 1;
    		$ItemCopy->save();
			}
		}

		$Purchase = Purchase::model()->findByPk($purchase_id);
		$Purchase->status = 'รับสินค้าแล้ว';
		$Purchase->save();

		$this->redirect('index.php?r=site/purchasesList');
	}

	public function actionDeletePurchaseList() {
		if (!is_numeric($_POST['id'])) {
			echo json_encode(false);
			return;
		}
		
		if (Purchase::model()->deleteByPk($_POST['id'])) {
			echo json_encode(true);
			return;
		}

		echo json_encode(false);
	}

	public function actionItemReceive() {
		$sql = 'SELECT * FROM purchases ORDER BY id ASC';
    $purchases = Yii::app()->db->createCommand($sql)->queryAll();
		
		$this->render('itemReceive', array('purchases' => $purchases));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError() {
		if($error=Yii::app()->errorHandler->error) {
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/* 
	 * item copies
	 */

	public function actionItemCopiesList() {
		$id = $_GET['id'];
		$sql = 'SELECT * 
						FROM item_copies a INNER JOIN items b ON a.item_id = b.id 
						WHERE a.item_id = '.$id.' ORDER BY a.id ASC';
    $copies = Yii::app()->db->createCommand($sql)->queryAll();

		$this->render('itemCopiesList', array('copies' => $copies));
	}

	/**
	 * Login, set Session User Data & Logout
	 */
	public function actionLogin() {
		if (empty($_POST['username']) || empty($_POST['password'])) {
			//Yii::app()->session['errorMsg'] = ['message' => 'Incorret Information'];
			return $this->actionIndex();
		}

		$username = $_POST['username'];
		$password = md5($_POST['password']);

		$sql = 'SELECT users.*, roles.name as role_name						
						FROM users LEFT JOIN roles ON users.role_id = roles.id
						LEFT JOIN permissions ON users.id = permissions.user_id
						WHERE username = "'.$username.'" AND password = "'.$password.'"';

		$member = Yii::app()->db->createCommand($sql)->queryAll();

		if (empty($member)) {
			//Yii::app()->session['errorMsg'] = ['message' => 'Incorret Information'];
			//Yii::app()->session['tempData'] = ['username' => $_POST['username']];
			$this->redirect('index.php');
		}

		$this->actionSetLogin($member[0]);
		

		if ($member[0]['role_id'] == 1 ) {
			$this->redirect('index.php?r=site/usersList');
		}
		else if ($member[0]['role_id'] == 2) {
			$this->redirect('index.php?r=site/reportsList');	
		}
		else if ($member[0]['role_id'] == 3) {
			$this->redirect('index.php?r=site/welcome');
		}
		else {
			$this->redirect('index.php');
		}
		
	}

	private function actionSetLogin($data) {
		Yii::app()->session['User'] = array(
																		'id' => $data['id'],
																		'email' => $data['email'],
																		'name' => ucwords($data['fname']).' '.ucwords($data['lname']),
																		'tel' => $data['tel'],
																		'address' => $data['address'],
																		'role_id' => $data['role_id'],
																		'role' => $data['role_name'],
																		'backOffice' => $data['backOffice']
																	);
	/*
		Yii::app()->session['Permission'] = array(
																		'cashier' => $data['cashier'],
																		'refill_credit' => $data['refill_credit'],
																		'register_member' => $data['register_member'],
																		'edit_member' => $data['edit_member'],
																		'permission' => $data['permission'],
																		'create_purchase' => $data['create_purchase'],
																		'approve_purchase' => $data['approve_purchase'],
																		'receive_item' => $data['receive_item'],
																		'print_purchase' => $data['print_purchase'],
																		'fix_item' => $data['fix_item'],
																		'checkout_item' => $data['checkout_item'],
																		'report' => $data['report'],
																		'managing_supplier' => $data['managing_supplier'],
																		'managing_item' => $data['managing_item'],
																	);*/
	}

	public function actionLogout() {
		unset(Yii::app()->session['errorMsg']);
		unset(Yii::app()->session['User']);
		unset(Yii::app()->session['Permission']);
		
		$this->actionIndex();
	}

	// external function
	public function actionGetSupplierById() {
		$id = $_POST['id'];

		$sql = 'SELECT * FROM suppliers where id = '.$id;
		$supplier = Yii::app()->db->createCommand($sql)->queryAll();

		echo json_encode($supplier);
	}

	public function actionGetUserByCode() {
		$code = strtolower($_POST['code']);

		$sql = 'SELECT * FROM users where lower(code) = "'.$code.'"';
		$user = Yii::app()->db->createCommand($sql)->queryAll();

		if (empty($user)) {
			echo json_encode(array('completed' => false));
			return;
		}

		echo json_encode(array('completed' => true, 'user' => $user));
	}

	public function actionPaymentService() {
		$User = User::model()->findByPk($_POST['id']);

		$User->credit -= 50;

		if ($User->save()) {
			$Service = New Service();
			$Service->type = 'ชำระเงิน';
			$Service->user_id = $_POST['id'];
			$Service->by_id = Yii::app()->session['User']['id'];
			$Service->created = date("Y-m-d H:i:s");
			$Service->save();

			Yii::app()->session['successMsg'] = ['message' => 'ทำรายการสำเร็จแล้ว'];
			$this->redirect('index.php');
		}
	}

	public function actionRefillCredit() {
		$data = $_POST;
		$User = User::model()->findByPk($data['id']);
		$User->credit += $data['credit'];

		if ($User->save()) {
			$Service = New Service();
			$Service->type = 'เติมเงิน';
			$Service->user_id = $_POST['id'];
			$Service->by_id = Yii::app()->session['User']['id'];
			$Service->created = date("Y-m-d H:i:s");
			$Service->save();

			echo json_encode(array('completed' => true));
		}
	}

	public function actionGetPurchaseById() {
		$id = $_POST['id'];

		$sql = 'SELECT * 
						FROM purchases INNER JOIN suppliers ON purchases.supplier_id = suppliers.id 
						WHERE purchases.id = '.$id;
		$purchases = Yii::app()->db->createCommand($sql)->queryAll();

		$sql = 'SELECT * 
						FROM purchase_lists INNER JOIN purchases ON purchase_lists.purchase_id = purchases.id
						INNER JOIN items ON purchase_lists.item_id = items.id 
						WHERE purchase_lists.purchase_id = '.$id;
		$purchase_lists = Yii::app()->db->createCommand($sql)->queryAll();

		$purchases['item_list'][] = $purchase_lists; 
		echo json_encode($purchases);
	}

	public function actionPutRoleById() {
		$user = User::model()->findByPk($_POST['user_id']);

		$user->role_id = $_POST['role_id'];
		if ($user->save()) {
			echo json_encode(array('completed' => true));
			return;
		}

		echo json_encode(array('completed' => false));
		return;
	}

	public function actionActiveUser() {
		$id = $_GET['id'];
		$status = $_GET['status'];
	}

	public function actionPostItems() {
		$post = $_POST;

		if (empty($post['Item'])) {
			echo json_encode(array('completed' => false, 'msg' => 'ข้อมูลไม่ถูกต้อง'));
			return;
		}

		if (empty($post['item_type_id'])) {
			if (empty($post['type_name']) || empty($post['description']) || empty($post['code'])) {
				echo json_encode(array('completed' => false, 'msg' => 'ข้อมูลไม่ถูกต้อง'));
				return;
			}

			$ItemType = new ItemType();
			$ItemType->code = $post['code'];
			$ItemType->name = $post['type_name'];
			$ItemType->description = $post['description'];
			$ItemType->save();

			$type_name = $post['code'];
			$type_id = $ItemType->id;
		}
		else {
			$type_id = $post['item_type_id'];
			$sql = 'SELECT code FROM item_types WHERE id = '.$type_id;
    	$rs = Yii::app()->db->createCommand($sql)->queryAll();
    	$type_name = $rs[0]['code'];
		}

		foreach ($post['Item'] as $item) {
			if (empty($item['name'])) continue;

			$sql = 'SELECT max(id) as max FROM items WHERE item_type_id = '.$type_id;
    	$rs = Yii::app()->db->createCommand($sql)->queryAll();
    	$max = $rs[0]['max'] + 1;
    	$code = $type_name.substr('000000'.$max, -6);

			$Item = new Item();
			$Item->name = $item['name'];
			$Item->item_type_id = $type_id;
			$Item->code = $code;
			$Item->save();
		}

		echo json_encode(array('completed' => true));
		return;
	}

	public function actionPostSupplier() {
		$post = $_POST;

		if (empty($post['Item'])) {
			echo json_encode(array('completed' => false, 'msg' => 'ข้อมูลไม่ถูกต้อง'));
			return;
		}

		if (empty($post['supplier_name']) || empty($post['address']) || empty($post['tel'])) {
			echo json_encode(array('completed' => false, 'msg' => 'ข้อมูลไม่ถูกต้อง'));
			return;
		}
		
		$sql = 'SELECT max(id) as max FROM suppliers';
    $rs = Yii::app()->db->createCommand($sql)->queryAll();
    $max = $rs[0]['max'] + 1;
    $code = 'SUP'.substr('000000'.$max, -6);

		$Supplier = new Supplier();
		$Supplier->code = $code;
		$Supplier->name = $post['supplier_name'];
		$Supplier->address = $post['address'];
		$Supplier->tel = $post['tel'];
		$Supplier->save();

		$supplier_id = $Supplier->id;

		foreach ($post['Item'] as $item) {
			if (empty($item['item']) || empty($item['price'])) continue;

			$ItemOfSupplier = new ItemOfSupplier();
			$ItemOfSupplier->item_id = $item['item'];
			$ItemOfSupplier->supplier_id = $supplier_id;
			$ItemOfSupplier->price = $item['price'];
			$ItemOfSupplier->save();
		}

		echo json_encode(array('completed' => true));
		return;	
	}

	public function actionViewSupplier() {
		$supplier_id = $_GET['id'];

		$sql = 'SELECT a.*
						FROM suppliers a 
						WHERE a.id = '.$supplier_id;
    $supplier = Yii::app()->db->createCommand($sql)->queryAll();


		$sql = 'SELECT b.price, b.id as iop_id, c.*
						FROM suppliers a LEFT JOIN item_of_suppliers b ON a.id = b.supplier_id
						LEFT JOIN items c ON b.item_id = c.id
						WHERE a.id = '.$supplier_id;
    $list_item = Yii::app()->db->createCommand($sql)->queryAll();

    $sql = 'SELECT * FROM items ORDER BY id ASC';
    $items = Yii::app()->db->createCommand($sql)->queryAll();

    $this->render('viewSupplier', array('list_item' => $list_item, 'supplier' => $supplier, 'items' => $items));
	}

	public function actionAddItemOfSupplier() {
		$post = $_POST;

		if (empty($post['item_id']) || empty($post['price']) || empty($post['supplier_id'])) {
			echo json_encode(array('completed' => false, 'msg' => 'ข้อมูลไม่ถูกต้อง'));
		}

		$ItemOfSupplier = new ItemOfSupplier();
		$ItemOfSupplier->item_id = $post['item_id'];
		$ItemOfSupplier->supplier_id = $post['supplier_id'];
		$ItemOfSupplier->price = $post['price'];
		$ItemOfSupplier->save();

		echo json_encode(array('completed' => true, 'data' => $post));
	}
	
	public function actionDeleteItemOfSupplier() {
		$id = $_POST['id'];
		ItemOfSupplier::model()->deleteByPk($id);

		echo json_encode(array('completed' => true));
	}

	public function actionAllItem() {
		$sql = 'SELECT a.*, b.name as item_type
						FROM items a INNER JOIN item_types b ON a.item_type_id = b.id
						ORDER BY code asc';

    $list_item = Yii::app()->db->createCommand($sql)->queryAll();

    foreach ($list_item as $key => $value) {
    	$sql = 'SELECT count(*) as count
							FROM item_copies
							WHERE item_id = '.$value['id'];

	    $count = Yii::app()->db->createCommand($sql)->queryAll();

	    $list_item[$key]['count'] = $count[0]['count'];
    }

    $this->render('viewAllItem', array('list_items' => $list_item));
	}
}