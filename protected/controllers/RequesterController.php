<?php

class RequesterController extends Controller {
	
	public function actionIndex() {
		$this->renderPartial('index');
	}
//------------------------------------------------------------------------------------------------------------------------------
	public function actionLoadapp(){
		$this->renderPartial('app/index');
	}
//------------------------------------------------------------------------------------------------------------------------------
	public function actionLoadapplist(){
		$st = $_POST['st'];
		$this->renderPartial('app/app',array('st'=>$st));
	}
//------------------------------------------------------------------------------------------------------------------------------
	public function actionLoadrequesterindex(){
		$this->renderPartial('request/index');
	}
//------------------------------------------------------------------------------------------------------------------------------
	public function actionLoadrequester(){
		$status = $_POST['status'];
		$this->renderPartial('request/request',array('status'=>$status));
	}
//------------------------------------------------------------------------------------------------------------------------------
	public function actionLoadmodalapp(){
		$app = $_POST["app"];
		$req_id = $_POST['req_id'];
		$req_status = $_POST['req_status'];
		$this->renderPartial('modal/modal-request',array('app'=>$app,'req_id'=>$req_id,'req_status'=>$req_status));
	}
//------------------------------------------------------------------------------------------------------------------------------
	public function actionLoadmodalrequested(){
		$req_id = $_POST['req_id'];
		$req_status = $_POST['req_status'];
		$this->renderPartial('modal/modal-requested',array('req_id'=>$req_id,'req_status'=>$req_status));
	}
//------------------------------------------------------------------------------------------------------------------------------
	public function actionGetconrole() {
		$rol_id = $_POST['rol_id'];
		$data = MasRequest::getcontrolrol($rol_id);
		
		echo CJSON::encode(array(
			'status' => 'success',
			'msg' => '',
			'datarol'=>$data,
		));
	}
//------------------------------------------------------------------------------------------------------------------------------
	public function actionGetoconrole() {
		$req_code = $_POST['req_code'];
		$mod_id = $_POST['mod_id'];
		$data = MasRequest::getconrole($req_code,$mod_id,"");
		
		echo CJSON::encode(array(
			'status' => 'success',
			'msg' => '',
			'datarol2'=>$data,
		));
	}
//------------------------------------------------------------------------------------------------------------------------------
	public function actionGetrunid() {
		$app = $_POST["app"];
		$data = MasRequest::getrunid($app);
		foreach($data as $dataitem){
			$runid = $dataitem['runid'];
		}
		echo CJSON::encode(array(
			'status' => 'success',
			'msg' => '',
			'runid'=>$runid,
		));
	}
//------------------------------------------------------------------------------------------------------------------------------
	public function actionSaveform() {
		if(Yii::app()->request->isPostRequest){
			$oreq_code = $_POST['oreq_code'];
			$req_code = $_POST['req_code'];
			$app = $_POST['app'];
			$obj = $_POST['obj'];
			$req_type = $_POST['req_type'];
			$req_type_val = $_POST['req_type_val'];
			$mod_array = $_POST['mod_array'];
			$level_array = $_POST['level_array'];
			
			$model=new MasRequest;
			$model->oreq_code = $oreq_code;
			$model->req_code = $req_code;
			$model->app = $app;
			$model->obj = $obj;
			$model->req_type = $req_type;
			$model->req_type_val = $req_type_val;
			$model->mod_array = $mod_array;
			$model->level_array = $level_array;
			
			if($model->saveform()){
				echo json_encode(array('msg' => 'success')); 
			}else{
				$msg = Yii::app()->session['errmsg_content'];
				echo json_encode(array('msg' => $msg));
				Yii::app()->session->remove('errmsg_content');
			}
		}
	}
//------------------------------------------------------------------------------------------------------------------------------
	public function actionSwitchform() {
		if(Yii::app()->request->isPostRequest){
			$req_id = $_POST['req_id'];
			$status = $_POST['status'];
			
			$model = new MasRequest;
			$model->req_id = $req_id;
			$model->status = $status;
			
			if($model->switchform()){
				echo json_encode(array('msg' => 'success')); 
			}else{
				$msg = Yii::app()->session['errmsg_content'];
				echo json_encode(array('msg' => $msg));
				Yii::app()->session->remove('errmsg_content');
			}
		}
	}
//------------------------------------------------------------------------------------------------------------------------------
	public function actionLoadcustom(){
		$rol = $_POST['rol'];
		$req_code = $_POST['req_code'];
		$this->renderPartial('modal/tab-custom-request',array('rol'=>$rol,'req_code'=>$req_code));
	}
//------------------------------------------------------------------------------------------------------------------------------
	public function actionGetrelaposition() {
		$posi = $_POST["posi"];
		$data = MasRequest::getrelaposition($posi);
		if(count($data)!=0){
			foreach($data as $dataitem){
				$rol_id = $dataitem['rol_id'];
			}
		}else{
			$rol_id = "";
		}
		
		echo CJSON::encode(array(
			'status' => 'success',
			'msg' => '',
			'rol_id'=>$rol_id,
		));
	}
}